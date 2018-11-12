<?php include_once('./includes/database.php'); 

 // If save button is clicked ...
if(isset($_REQUEST['aboutid'])){
    $about_id = $_REQUEST['aboutid'];
    $query = "SELECT * FROM about WHERE about_id = $about_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    $about_us = $row['about_us'];
    $who_we_are = $row['who_we_are'];
    $our_name = $row['our_name'];
    //$image = $row['image'];

} else {

    $about_us = "";
    $who_we_are = "";
    $our_name = "";
    $image = "";
}


if (isset($_REQUEST['update'])) {
    $about_us = $_POST['about_us'];
    $who_we_are = $_POST['who_we_are'];
    $our_name = $_POST['our_name'];
    /*$image = $_FILES['image']['name'];
    // image file directory
   
    $oldimage = $_POST['oldimage'];

    if($image !=""){
        $target = "about/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        unlink("about/".$oldimage);
    } else{
         $image = $oldimage;
    }
    */
//exit();
   
  $query = "UPDATE about SET about_us='$about_us', who_we_are='$who_we_are', our_name='$our_name' WHERE about_id= $about_id";

    $last= mysqli_query($conn,$query);
    if ($last) {
        echo "<script>window.location='about.php'</script>";
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
        <title>Edit About - Fresh Bananas</title>
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
                    About Details
                </h1>
            </div> <!-- end s-content__header -->



            <!--<h3>Movie Details</h3>-->
            <!-- <a href="movielist.php" class="btn btn-info">Movie List</a> --> <!--   -->
            <form name="cForm" id="cForm" method="post" enctype="multipart/form-data" action="">
                
                <fieldset>

                    <div class="form-field">
                        <h5> Learn More About Us </h5>
                        <input name="about_us" type="text" id="about_us" class="full-width"  value="<?php echo $about_us ?>" />
                    </div>

                    <div class="form-field">
                        <!-- <label style="color: grey; font-family: open sans; font-weight: 420; font-size: 115%;" for = "release_date">Release date</label> -->
                        <h5> Who We Are </h5>
                        <input name="who_we_are" type="text" id="who_we_are" class="full-width" value="<?php echo $who_we_are ?>" />
                    </div>

                    <div class="form-field">
                        <h5> Our Name </h5>
                        <input name="our_name" type="text" id="our_name" class="full-width" value="<?php echo $our_name ?>" />
                    </div> 



                  <!-- <button type="submit" class="submit btn btn--primary full-width">Submit</button> -->
                  <input type="submit" name = "update" value="Update" class="submit btn btn--primary full-width" />
              </fieldset>
          </form> <!-- end form -->


          

      </div> <!-- end row -->

  </section> <!-- s-content -->

<?php include_once('./includes/footer.php'); ?>