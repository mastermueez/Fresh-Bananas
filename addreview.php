<?php
include_once('./includes/database.php'); 
 // If pending button is clicked ...
if(isset($_REQUEST['movieid'])){
    $movie_id = $_REQUEST['movieid'];
    $query = "SELECT title FROM movies WHERE movie_id = $movie_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
}
else{
    $title="";
}
if (isset($_REQUEST['save'])) {

    $heading = $_POST['heading'];    
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    // image file directory
    $target = "reviews/".basename($image);
    //$oldimage = $_POST['oldimage'];
    //unlink("posters/".$oldimage);
    //exit();
    
    $query = "INSERT INTO reviews (Movie_ID, Heading, Description, image) VALUES ('$movie_id', '$heading', '$description', '$image')";
    //print_r($query);exit();

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
        <title>Add Review - Fresh Bananas</title>
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
                    Review Details
                </h1>
            </div> <!-- end s-content__header -->



            <h3><?php echo $title ?></h3>
            <!-- <a href="movielist.php" class="btn btn-info">Movie List</a> -->
            <form name="cForm" id="cForm" method="post" enctype="multipart/form-data" action="">
                <fieldset>
                    <div class="row">
                        <div class="col-six tab-full">
                            <div class="form-field">
                                <input name="heading" type="text" id="heading" class="full-width" placeholder="Review Title" value="" required>
                            </div>
                        </div>
                        <div class="col-six tab-full">
                         <div align = "right">
                          <label for="image" class="btn" "full">Select Image</label>
                          <input name="image" type="file" id="image" style="visibility:hidden;" required/>
                      </div>
                  </div>
              </div>                  
              <textarea name="description" class="full-width" placeholder="Description" id="description" required></textarea>



              <!-- <button type="submit" class="submit btn btn--primary full-width">Submit</button> -->
              <input type="submit" name = "save" value="Save" class="submit btn btn--primary full-width" />
          </fieldset>
      </form> <!-- end form -->




  </div> <!-- end row -->

</section> <!-- s-content -->

<?php include_once('./includes/footer.php'); ?>