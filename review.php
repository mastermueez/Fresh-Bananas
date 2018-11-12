<?php include_once('./includes/database.php'); 

 // If save button is clicked ...
$review_id=0;
if(isset($_REQUEST['reviewid'])){
    $review_id = $_REQUEST['reviewid'];
    $query = "SELECT * FROM reviews WHERE Review_ID = $review_id";
    //print_r($query);exit();
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    $movie_id = $row['Movie_ID'];
    $heading = $row['heading'];
    $description = $row['description'];
    //print_r($description);exit();
    $image = $row['image'];

} else {
    $movie_id = "";
    $heading = "";
    $description = "";
    $image = "";
}

//For DELETING
if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $review_id = $_REQUEST['reviewid'];

    $query = "DELETE FROM reviews WHERE Review_ID = $review_id";
    $rec = mysqli_query($conn, $query);
    if ($rec) {
        echo "<script>window.location='allreviews.php'</script>";
    } else {
        echo "Error occured with editing/deleting";
    }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title><?php echo $heading; ?> - Fresh Bananas</title>
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

        <section class="s-content s-content--narrow s-content--no-padding-bottom">

            <article class="row format-gallery">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        <?php echo $heading; ?>
                    </h1>
                    <ul class="s-content__header-meta">
                        <!-- <li class="date">December 16, 2017</li> 
                        <li class="cat">
                            In
                            <a href="#0">Lifestyle</a>
                            <a href="#0">Travel</a>
                        </li>
                    </ul> -->
                </div> <!-- end s-content__header -->


                    <div class="s-content__media col-full" align="center">
                        <div class="s-content__slider slider">
                            <div class="slider__slides">
                                <div class="slider__slide">
                                    <?php
                                    echo "<div id='img_div'>";
                                    echo "<img src='reviews/".$image."' >";
                                    echo "</div>";
                                    ?>   
                                </div>
                            </div>
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="col-full s-content__main">

                        <p class="drop-cap"><?php echo $description ?></p>
                    </div>

                </div> <!-- end row comments -->
            </div> <!-- end comments-wrap -->
                    <?php //WHEN ADMIN IS SIGNED IN
                    if ((isset($_SESSION['admin_id']) == true)) { ?>
                    <div class="col-six tab-full">
                        <a class="btn btn--primary full-width" href="editreview.php?reviewid=<?php echo $row['Review_ID']?>&title=<?php echo $row['heading'];?>" class="edit"
                                >Edit</a>
                    </div>

                    <div class="col-six tab-full">
                        <a class="btn btn--stroke full-width" href="review.php?reviewid= <?php echo $row['Review_ID']?>&act=del" class="delete"
                            >Delete</a>                    
                    </div>
                    <?php } ?>
                

        </article>
        <?php include_once('comment.php'); ?>
    </section> <!-- s-content -->


    <?php include_once('./includes/footer.php'); ?>