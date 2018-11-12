<?php include_once('./includes/database.php'); 

 // If save button is clicked ...
if(isset($_REQUEST['reviewid'])){
    $review_id = $_REQUEST['reviewid'];
    $query = "SELECT * FROM reviews WHERE review_id = $review_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    $review_id = $row['Review_ID'];
    $heading = $row['heading'];
    $description = $row['description'];
    $image = $row['image'];

} else {
    $review_id = "";
    $heading="";
    $description = "";
    $image = "";
}


if (isset($_REQUEST['update'])) {
   // $id = $_POST['movie_id'];
    $heading = $_POST['heading'];    
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
       // image file directory
   
    $oldimage = $_POST['oldimage'];

    if($image !=""){
        $target = "reviews/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        unlink("reviews/".$oldimage);
    } else{
         $image = $oldimage;
    }
//exit();
   
   $query = "UPDATE reviews SET heading='$heading', description='$description', image='$image' WHERE review_id= $review_id";


    $last= mysqli_query($conn,$query);
    if ($last) {
        echo "<script>window.location='allreviews.php'</script>";
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
        <title>Edit <?php echo $heading; ?> - Fresh Bananas</title>
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



            <!--<h3>Movie Details</h3>-->
            <!-- <a href="movielist.php" class="btn btn-info">Movie List</a> --> <!--   -->
            <form name="cForm" id="cForm" method="post" enctype="multipart/form-data" action="">
                
                <fieldset>

                    <div class="form-field">
                        <h5> Heading </h5>
                        <input name="heading" type="text" id="heading" class="full-width"  value="<?php echo $heading ?>" />
                    </div>


                    <div class="form-field">
                        <h5> Description </h5>
                        <input name="description" type="text" id="description" class="full-width" value="<?php echo $description ?>" />
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