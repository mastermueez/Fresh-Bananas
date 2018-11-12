<?php
include_once('./includes/database.php'); 
 // If save button is clicked ...
if(isset($_POST['save'])){
    $title=$_POST['title'];
    date_default_timezone_set('Asia/Dhaka');
    $release_date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['release_date'])));
    $runtime = $_POST['runtime'];
    $link = $_POST['link'];
    //get image name
    $image = $_FILES['image']['name'];
    // image file directory
  $target = "posters/".basename($image);


  $query= "INSERT INTO movies(title, release_date, runtime, link, image) VALUES('$title', '$release_date','$runtime', '$link', '$image')";
    //executing query
    $last= mysqli_query($conn,$query);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    if($last){
        echo "<script> window.location='movielist.php'</script>";
    } else{
        echo "Error: Databse storing FAILED!";
    }
}   
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Add Movie - Fresh Bananas</title>
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
            <!-- <a href="movielist.php" class="btn btn-info">Movie List</a> -->
            <form name="cForm" id="cForm" method="post" enctype="multipart/form-data" action="">
                <fieldset>
                    <div class="row">
                        <div class="col-six tab-full">
                            <input name="title" type="text" id="title" class="full-width" placeholder="Movie Title" value="" required>
                        </div>

                        <div class="col-six tab-full" align="right">
                            <!--
                            <label style="color: grey; font-family: open sans; font-weight: 420; font-size: 115%;" for = "release_date">Release date</label>
                            <input name="release_date" type="date" id="release_date" class="full-width" value="">
                        -->
                        <input name="link" type="text" id="link" class="full-width" placeholder="Trailer Link" value="" required>
                        
                    </div>

                </div>
                <div class="row">
                    <div class="col-four tab-full">
                                                    <!--
                            <label style="color: grey; font-family: open sans; font-weight: 420; font-size: 115%;" for = "release_date">Release date</label>
                            <input name="release_date" type="date" id="release_date" class="full-width" value="">
                        -->
                        
                        <input name="runtime" type="number" id="runtime" class="full-width" placeholder="Runtime"  value="" required>
                        
                    </div>
                    <div class="col-four tab-full" align="right">
                        <input name="release_date" placeholder="Release Date" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="release_date" required>
                    </div>
                    <div class="col-four tab-full" align="right">
                      <label for="image" class="btn" "full">Select Image</label>
                      <input name="image" type="file" id="image" style="visibility:hidden;" required/>
                  </div>

              </div>
              <div class="row">
                  <!-- <button type="submit" class="submit btn btn--primary full-width">Submit</button> -->
                  <input type="submit" name = "save" value="Save" class="submit btn btn--primary full-width" />
              </div>
          </fieldset>
      </form> <!-- end form -->




  </div> <!-- end row -->

</section> <!-- s-content -->


<?php include_once('./includes/footer.php'); ?>