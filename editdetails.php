<?php include_once('./includes/database.php'); 

 // If save button is clicked ...
if(isset($_REQUEST['movieid'])){
    $movie_id = $_REQUEST['movieid'];
    $query = "SELECT * FROM movies WHERE movie_id = $movie_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    $movie_id = $row['movie_id'];
    $title = $row['title'];
    $release_date = $row['release_date'];
    $runtime = $row['runtime'];
    $link = $row['link'];
    $image = $row['image'];

} else {
    $movie_id = "";
    $link="";
    $title = "";
    $release_date = "";
    $runtime = "";
    $image="";
}


if (isset($_REQUEST['update'])) {
    date_default_timezone_set('Asia/Dhaka');
   // $id = $_POST['movie_id'];
    $title = $_POST['title'];    
    $release_date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['release_date'])));
    $runtime = $_POST['runtime'];
    $link=$_POST['link'];
    $image = $_FILES['image']['name'];
       // image file directory
   
    $oldimage = $_POST['oldimage'];

    if($image !=""){
        $target = "posters/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        unlink("posters/".$oldimage);
    } else{
         $image = $oldimage;
    }
//exit();
   
   $query = "UPDATE movies SET title='$title', release_date='$release_date', runtime='$runtime', link='$link',image='$image' WHERE movie_id= $movie_id";

    $last= mysqli_query($conn,$query);
    if ($last) {
        echo "<script>window.location='movielist.php'</script>";
    } else {
        echo "FAAAIL";
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Edit <?php echo $title; ?> - Fresh Bananas</title>
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
                    Movie Details
                </h1>
            </div> <!-- end s-content__header -->



            <!--<h3>Movie Details</h3>-->
            <!-- <a href="movielist.php" class="btn btn-info">Movie List</a> --> <!--   -->
            <form name="cForm" id="cForm" method="post" enctype="multipart/form-data" action="">
                
                <fieldset>

                    <div class="form-field">
                        <h5> Title </h5>
                        <input name="title" type="text" id="title" class="full-width"  value="<?php echo $title ?>" />
                    </div>

                    <div class="form-field">
                        <!-- <label style="color: grey; font-family: open sans; font-weight: 420; font-size: 115%;" for = "release_date">Release date</label> -->
                        <h5> Release Date </h5>
                        <input name="release_date" type="date" id="release_date" class="full-width" value="<?php echo $release_date ?>" />
                    </div>

                    <div class="form-field">
                        <h5> Runtime </h5>
                        <input name="runtime" type="number" id="runtime" class="full-width" value="<?php echo $runtime ?>" />
                    </div> 

                    <h5> Trailer Link </h5>
                    <div class="form-field">
                        <input name="link" type="text" id="link" class="full-width" value="<?php echo $link ?>" />
                    </div>

                    <div>
                      <label for="image" class="btn" "full">Change Image</label>
                      <input type="hidden" name="oldimage" value="<?php echo $image ?>">
                      <input name="image" type="file" id="image" style="visibility:hidden;" value="<?php echo $image ?>"/>
                  </div>

                  <!-- <button type="submit" class="submit btn btn--primary full-width">Submit</button> -->
                  <input type="submit" name = "update" value="Update" class="submit btn btn--primary full-width" />
              </fieldset>
          </form> <!-- end form -->


          

      </div> <!-- end row -->

  </section> <!-- s-content -->

<?php include_once('./includes/footer.php'); ?>