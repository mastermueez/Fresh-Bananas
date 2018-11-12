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
    $title = "";
    $release_date = "";
    $runtime = "";
    $image="";
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title> <?php echo $title ?> - Fresh Bananas</title>
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

            <article class="row format-video">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        <?php echo $title ?>
                    </h1>
                    <ul class="s-content__header-meta">
                        <li class="date">Release Date: <?php echo $release_date ?></li>
                        <!--<li class="cat">
                            In
                            <a href="#0">Lifestyle</a>
                            <a href="#0">Travel</a>
                        </li> -->
                    </ul>
                </div> <!-- end s-content__header -->

                <div class="s-content__media col-full">                 
                    <div class="video-container">
                        <!-- <iframe src="https://player.vimeo.com/video/117310401?color=01aef0&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->

                        <iframe src="<?php echo $link ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                    </div> 
                </div> <!-- end s-content__media -->
                <div class="s-content__media col-full">
                </div>

            </div> <!-- end s-content__media -->



            </article>
        </section> <!-- s-content -->

        <?php include_once('./includes/footer.php'); ?>