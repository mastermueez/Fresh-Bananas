<?php
include_once('./includes/database.php'); 
$query = "SELECT * FROM movies ORDER by RAND()";
$result = mysqli_query($conn, $query);
$movieid_arr=array();
$releasedate_arr=array();
$img_arr=array();
$title_arr=array();
for($i=0; $i<3; $i++){
    $row = mysqli_fetch_assoc($result);
    array_push($movieid_arr, $row['movie_id']);
    date_default_timezone_set('Asia/Dhaka');
    $originalDate = $row['release_date'];
    $newDate = date("d F, Y", strtotime($originalDate));
    array_push($releasedate_arr, $newDate); 
    $disp ='posters/'.$row['image'];
    array_push($img_arr, $disp);
    array_push($title_arr, $row['title']);    
}

/*$reviewImage_arr=array();
$reviewHeading_arr=array();
$reviewDescription_arr=array();

$reviewQuery="SELECT * FROM reviews";
$reviewResult = mysqli_query($conn, $reviewQuery);
$c=0;
while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
    //print_r($reviewRow['heading']);exit();
    array_push($reviewImage_arr, $reviewRow['image']);
    $trimmedDescription = $reviewRow['description'];
    $trimmedDescription = substr($trimmedDescription,0,200).'...';
    array_push($reviewHeading_arr, $reviewRow['heading']);
    array_push($reviewDescription_arr, $trimmedDescription);
    array_unique($reviewHeading_arr);
   
    /*
    print_r($c); echo"<br>";    
    print_r($reviewHeading_arr[$c]); echo "<br>";    
    print_r($reviewDescription_arr[$c++]);
   
}*/
//exit();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Fresh Bananas</title>
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
    <?php
    include_once('./includes/header.php'); ?>

    <div class="pageheader-content row">
        <div class="col-full">

            <div class="featured">

                <div class="featured__column featured__column--big">
                    <!--    <div class="entry" style="background-image:url('images/thumbs/featured/featured-guitarman.jpg');"> -->                           
                        <div class="entry" style="background-image:url('<?php echo $img_arr[0]; ?>');">

                            <div class="entry__content">
                                <!--<span class="entry__category"><a href="#0">Action</a></span>-->

                                <h1><a href="movie.php?movieid= <?php echo $movieid_arr[0] ?> &title= <?php echo $title_arr[0]; ?>" > <?php echo $title_arr[0] ?> </a></h1>

                                <div class="entry__info">
                                   <!-- <a href="#0" class="entry__profile-pic">
                                        <img class="avatar" src="images/avatars/user-07.jpg" alt="">
                                    </a> -->

                                    <ul class="entry__meta">
                                      <!--  <li> Abdul Mueez </li> -->
                                        <li><?php echo $releasedate_arr[0] ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->
                    </div> <!-- end featured__big -->

                    <div class="featured__column featured__column--small">

                        <div class="entry" style="background-image:url('<?php echo $img_arr[1]; ?>');">

                            <div class="entry__content">
                                <!--<span class="entry__category"><a href="#0">Thriller</a></span>-->

                                <h1><a href="movie.php?movieid= <?php echo $movieid_arr[1] ?> &title= <?php echo $title_arr[1]; ?>" > <?php echo $title_arr[1] ?> </a></h1>

                                <div class="entry__info">
                                    <a href="#0" class="entry__profile-pic">
                                        <img class="avatar" src="images/avatars/user-03.jpg" alt="">
                                    </a>

                                    <ul class="entry__meta">
                                        <li><?php echo $releasedate_arr[1] ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->

                        <div class="entry" style="background-image:url('<?php echo $img_arr[2]; ?>');">

                            <div class="entry__content">
                                <!--<span class="entry__category"><a href="#0">Drama</a></span>-->

                                <h1><a href="movie.php?movieid= <?php echo $movieid_arr[2] ?> &title= <?php echo $title_arr[2]; ?>" > <?php echo $title_arr[2] ?> </a></h1>

                                <div class="entry__info">
                                    <a href="#0" class="entry__profile-pic">
                                        <img class="avatar" src="images/avatars/user-03.jpg" alt="">
                                    </a>

                                    <ul class="entry__meta">
                                        <li><?php echo $releasedate_arr[2] ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->

                    </div> <!-- end featured__small -->
                </div> <!-- end featured -->

            </div> <!-- end col-full -->
        </div> <!-- end pageheader-content row -->

    </section> <!-- end s-pageheader -->


    <!-- s-content
        ================================================== -->
        <section class="s-content">

            <div class="row masonry-wrap">
                <div class="masonry">

                    <div class="grid-sizer"></div>

<?php 

$reviewQuery="SELECT * FROM reviews ORDER BY RAND() DESC LIMIT 6";
$reviewResult = mysqli_query($conn, $reviewQuery);
$c=0;
    while ($reviewRow = mysqli_fetch_assoc($reviewResult)) { ?>

                    <article class="masonry__brick entry format-standard" data-aos="fade-up">

                        <div class="entry__thumb">
                            <!--<a href="single-standard.php" class="entry__thumb-link"> -->

                              <!--  <img src="images/thumbs/masonry/lamp-400.jpg" 
                                srcset="images/thumbs/masonry/lamp-400.jpg 1x, images/thumbs/masonry/lamp-800.jpg 2x" alt=""> -->

                                <?php
                                echo "<div id='img_div'>";
                                echo "<img src='reviews/".$reviewRow['image']."'>";
                                echo "</div>";
                                ?>  

                            </a>
                        </div>

                        <div class="entry__text">
                            <div class="entry__header">
<!-- 
                                <div class="entry__date">
                                    <a href="single-standard.php">December 15, 2017</a> 
                                </div>
                                -->
                                <h1 class="entry__title"><a href="review.php?reviewid=<?php echo $reviewRow['Review_ID'] ?>&title=<?php echo $reviewRow['heading'];?>"><?php echo $reviewRow['heading']; ?></a></h1>

                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    <?php echo substr($reviewRow['description'],0,200); ?>....
                                </p>
                            </div>
                            <div class="entry__meta">
                                <!--
                                <span class="entry__meta-links">
                                    <a href="category.php">Design</a> 
                                    <a href="category.php">Photography</a>
                                </span> -->
                            </div>
                        </div>

                    </article> <!-- end article -->
<?php } ?>
                   
                </div> <!-- end masonry -->
            </div> <!-- end masonry-wrap -->

<?php
$reviewCountQuery="SELECT review_id FROM reviews";
$reviewCountResult = mysqli_query($conn, $reviewCountQuery);
$userCountQuery="SELECT user_id FROM users";
$userCountResult = mysqli_query($conn, $userCountQuery);

$commentCountQuery="SELECT comment_id FROM comments";
$commentCountResult = mysqli_query($conn, $commentCountQuery);

$aboutcommentQuery = "SELECT aboutcomment_id FROM aboutcomments";     
$aboutcommentResult = mysqli_query($conn,$aboutcommentQuery);
$commentCount = mysqli_num_rows($aboutcommentResult) + mysqli_num_rows($commentCountResult);
?>

                <h3 align="center">Stats Tab</h3>

                <ul class="stats-tabs" align="center">
                    <li><a href="movielist.php"><?php echo mysqli_num_rows($result) ?> <em>Movies</em></a></li>
                    <li><a href="allreviews.php"><?php echo mysqli_num_rows($reviewCountResult) ?> <em>Reviews</em></a></li>
                    <li><a href="allusers.php"><?php echo mysqli_num_rows($userCountResult) ?> <em>Registered Users</em></a></li>
                    <li><a href="#0"><?php echo $commentCount ?> <em>Comments</em></a></li>
                </ul>

        </section> <!-- s-content -->


    <!-- s-extra
        ================================================== -->
        



        <?php include_once('./includes/footer.php');
        ?>