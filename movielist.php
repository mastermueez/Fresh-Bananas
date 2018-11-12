<?php
include_once('./includes/database.php');

function checkReviewStatus($conn, $movie_id){
    $result = mysqli_query($conn,"SELECT COUNT(Movie_ID) AS reviewCount FROM reviews WHERE Movie_ID = '$movie_id' ");

    $row = mysqli_fetch_array($result);

    if($row['reviewCount'] > 0){
       return true;         
   }
   else{ 
    return false;
}
}

//For DELETING
if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $movie_id = $_REQUEST['movieid'];
    if(checkReviewStatus($conn, $movie_id)){
        $rec = mysqli_query($conn, "DELETE FROM reviews WHERE movie_id = $movie_id");
    }
    $query = "DELETE FROM movies WHERE movie_id = $movie_id";
    $rec = mysqli_query($conn, $query);
    if ($rec) {
        echo "<script>window.location='movielist.php'</script>";
    } else {
        echo "Error occured with editing/deleting";
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <style>
    a.delete:link {
        color: red;
        background-color: transparent;
        text-decoration: none;
    }

    a.delete:hover {
        color: #cc0000;
        background-color: transparent;
        text-decoration: underline;
    }
    a.edit:hover {
        text-decoration: underline;
    }
    a.completed:link {
        color:#26ad61;
    }

    a.pending:link {
        color: #2b64bf;
    }
</style>
    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Movie List - Fresh Bananas</title>
        <meta name="description" content="">
        <meta name="author" content="">

    <!-- mobile specific metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/main.css">

    <!-- script
        ================================================== -->
        <script src="js/modernizr.js"></script>
        <script src="js/pace.min.js"></script>

    <!-- favicons
        ================================================== -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

    </head>

    <body id="top">

    <!-- pageheader
        ================================================== -->
        <?php include_once('./includes/header.php'); ?>


    <!-- s-content
        ================================================== -->
        <section class="s-content s-content--narrow">

            <div class="row">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        Movie List
                    </h1><h3></h3>
                </div> <!-- end s-content__header -->

                <!-- ORDERING MOVIES -->
                <form name="cForm" id="cForm" method="post" action="">
                    <fieldset>
                        <div class="row">
                            <div class="col-six tab-full">
                              <button name="save" type="submit" class="submit btn btn--primary full-width">Order by:</button>
                          </div>                               
                          <div class="col-six tab-full" align="right">  
                            <div class="form-field">
                                <select class="full-width" name="sortingOrder">
                                    <option value="title">Title</option>
                                    <option value="release_date">Release Date</option>
                                    <option value="runtime">Runtime (Shortest First)</option>
                                </select>
                            </div>  
                        </div>   
                    </fieldset>
                </form> <!-- end form -->

                <div class="col-twelve">
                <div class="table-responsive">
                    <!--<a href="addnew.php" class="btn btn-info">Add New </a><br/> -->
                    <table>
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Poster</th>
                                <th>Name</th>
                                <th>Release Date</th>
                                <th>Runtime</th>
                                <?php //WHEN ADMIN IS SIGNED IN
                                if ((isset($_SESSION['admin_id']) == true)) { ?>
                                <th colspan="2" style = "text-align:center;"</th> Action </th>
                                <?php } ?>
                                <th>Review Status</th>
                            </tr>
                        </thead>
                        <?php
                //echo "<pre/>";
                        $query = "SELECT * FROM movies";
                        if (isset($_POST['save']) && isset($_POST['sortingOrder'])) {
                            switch ($_POST['sortingOrder']) {
                                case 'title':
                                $query = "SELECT * FROM movies ORDER BY title";
                                break;
                                case 'release_date':
                                $query = "SELECT * FROM movies ORDER BY release_date DESC";
                                break;
                                case 'runtime':
                                $query = "SELECT * FROM movies ORDER BY runtime";
                                break;
                                default:
                            }
                        }     
                        $result = mysqli_query($conn, $query);
                    /*
                    $reviewQuery = "SELECT * FROM reviews ORDER BY movie_id";
                    $reviewResult = mysqli_query($conn, $reviewQuery);
                    $reviewRow = mysqli_fetch_assoc($reviewResult); */

                //$student = mysqli_fetch_assoc($result);
                //print_r(mysqli_fetch_assoc($result));
                    $sn=1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    //print_r($student);
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td>
                                <a href="movie.php?movieid= <?php echo $row['movie_id'] ?> &title= <?php echo $row['title']; ?>" >
                                    <?php
                                    echo "<div id='img_div'>";
                                    echo "<img src='posters/".$row['image']."' >";
                                    echo "</div>";
                                    ?>                                      
                                </a> 
                            </td>
                            <!--<td><?php echo $student['id']; ?></td> -->
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['release_date']; ?></td>
                            <td><?php echo $row['runtime']; ?></td>
                            <!-- EDIT/DELETE -->
                            <?php //WHEN ADMIN IS SIGNED IN
                            if ((isset($_SESSION['admin_id']) == true)) { ?>
                            <td>
                                <!-- FORMAT: <a href="url">link text</a> -->
                                <a
                                href="editdetails.php?movieid=<?php echo $row['movie_id']?> &title= <?php echo $row['title'];?>" class="edit"
                                >Edit
                            </a>
                        </td>
                        <td>
                            <a
                            href="movielist.php?movieid= <?php echo $row['movie_id'] ?> &act=del" class="delete"
                            >Delete
                        </a>
                    </td>
                    <?php } ?>
                    <td>  
                        <?php
                        //Finding review_id of reviews of movies (completed)



                        $sts =  checkReviewStatus($conn, $row['movie_id']); 
                        if($sts){ 
                            $currentMovieID=$row['movie_id'];
                            $reviewQuery="SELECT * FROM reviews WHERE movie_id = '$currentMovieID' ";
                            $reviewResult = mysqli_query($conn, $reviewQuery);
                            $reviewRow = mysqli_fetch_assoc($reviewResult);
                            $currentReviewID=$reviewRow['Review_ID'];
                            //print_r($currentReviewID);exit();
                            ?>
                            <a href="review.php?reviewid=<?php echo $currentReviewID ?>&title=<?php echo $reviewRow['heading'];?>" class="completed">Completed</a> 
                            <?php } else {?>
                            <?php //WHEN ADMIN IS SIGNED IN
                            if ((isset($_SESSION['admin_id']) == true)) { ?>
                            <a href="addreview.php?movieid=<?php echo $row['movie_id'] ?> &title=<?php echo $row['title'];?>" class="pending">Pending</a>
                            <?php } else{ ?>
                            <a class="pending">Coming Soon</a>
                            <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    </div> <!-- end row -->


</section> <!-- s-content -->

<?php include_once('./includes/footer.php'); ?>