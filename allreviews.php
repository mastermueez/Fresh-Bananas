<?php include_once('./includes/database.php');?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>All Reviews - Fresh Bananas</title>
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



    <!-- pageheader
        ================================================== -->
        <?php include_once('./includes/header.php'); ?>

    <!-- s-content
        ================================================== -->
        <section class="s-content">

            <div class="row narrow">
                <div class="col-full s-content__header" data-aos="fade-up">
                    <h1>Reviews</h1>

                    <!-- <p class="lead">Dolor similique vitae. Exercitationem quidem occaecati iusto. Id non vitae enim quas error dolor maiores ut. Exercitationem earum ut repudiandae optio veritatis animi nulla qui dolores.</p> -->
                </div>
            </div>

            <div class="row masonry-wrap">
                <div class="masonry">

                    <div class="grid-sizer"></div>

                    <?php 

                    $reviewQuery="SELECT * FROM reviews ";
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

                                <div class="entry__date">
                                    <!-- <a href="single-standard.php">December 15, 2017</a> -->
                                </div>
                                <h1 class="entry__title"><a href="review.php?reviewid=<?php echo $reviewRow['Review_ID'] ?>"><?php echo $reviewRow['heading']; ?></a></h1>

                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    <?php echo substr($reviewRow['description'],0,200); ?>....
                                </p>
                            </div>

                        </div>

                    </article> <!-- end article -->
                    <?php } ?>

                </div> <!-- end masonry -->
            </div> <!-- end masonry-wrap -->

            

        </section> <!-- s-content -->


    <!-- s-extra
        ================================================== -->
        



        <?php include_once('./includes/footer.php');
        ?>