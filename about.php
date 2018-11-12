<?php include_once('./includes/database.php');
$aboutQuery="SELECT * FROM about";
$aboutResult = mysqli_query($conn, $aboutQuery);
$aboutRow = mysqli_fetch_assoc($aboutResult);
$about_id = $aboutRow['about_id'];

//If a comment is deleted
if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $comment_id = $_REQUEST['commentid'];
    $aboutIdQuery = "SELECT about_id from aboutcomments WHERE aboutcomment_id=$comment_id";
    $aboutIdResult = mysqli_query($conn, $aboutIdQuery);
    $aboutIdRow = mysqli_fetch_assoc($aboutIdResult);
    $about_id = $aboutIdRow['about_id'];


    $deleteCommentQuery = "DELETE FROM aboutcomments WHERE aboutcomment_id = $comment_id";
    $deleteCommentResult = mysqli_query($conn, $deleteCommentQuery);
    if ($deleteCommentResult) {
        echo "<script> window.location='about.php?aboutid=$about_id'</script>";
    } else {
        echo "Error occured with editing/deleting";
    }
}


 // If user posts a comment:
if(isset($_POST['save'])){
    date_default_timezone_set('Asia/Dhaka');
    $currentDate = date('Y-m-d H:i:s');
    //$date_posted = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['release_date'])));
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

  $insertCommentQuery= "INSERT INTO aboutcomments(user_id, about_id, comment, date_posted) VALUES('$user_id', '$about_id','$comment', '$currentDate')";

    //executing query
    $insertCommentLast= mysqli_query($conn,$insertCommentQuery);


    if($insertCommentLast){
        echo "<script> window.location='about.php'</script>";
    } else{
        echo "Error: Databse storing FAILED!";
    }
}   

$commentQuery = "SELECT * FROM aboutcomments WHERE about_id ='$about_id'"; 
//print_r($commentQuery); exit();       
$commentLast = mysqli_query($conn,$commentQuery);
$commentCount = mysqli_num_rows($commentLast);
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>About - Fresh Bananas</title>
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
     <!-- end s-pageheader -->
</head>
    <?php include_once('./includes/header.php'); ?>

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    Learn More About Us.
                </h1>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img align="center" src="images/thumbs/about/about-1000lq.jpg">
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <p class="lead"><?php echo $aboutRow['about_us'] ?></p>
                

                <div class="row block-1-2 block-tab-full">
                    <div class="col-block">
                        <h3 class="quarter-top-margin">Who We Are.</h3>
                        <p><?php echo $aboutRow['who_we_are'] ?></p>
                    </div>

                    <div class="col-block">
                        <h3 class="quarter-top-margin">Our Name.</h3>
                        <p><?php echo $aboutRow['our_name'] ?></p>
                    </div>
                </div><br>
                    <?php //WHEN ADMIN IS SIGNED IN
                    if ((isset($_SESSION['admin_id']) == true)) { ?>
                    <div class="col-twelve tab-full" align="center">
                        <a class="btn btn--primary full-width" href="editabout.php?aboutid=<?php echo $aboutRow['about_id']?>" class="edit"
                                >Edit</a>
                    </div>

                    <?php } ?>
            </div> <!-- end s-content__main -->

        </div> <!-- end row -->


<?php
$commentQuery = "SELECT * FROM aboutcomments WHERE about_id ='$about_id'"; 
//print_r($commentQuery); exit();       
$commentLast = mysqli_query($conn,$commentQuery);
$commentCount = mysqli_num_rows($commentLast);
?>


        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">

                    <h3 class="h2"><?php echo $commentCount ?> Comments</h3>
                    <?php if($commentCount >0 ){
                    while($commentRow = mysqli_fetch_assoc($commentLast)){
                        $user_id = $commentRow['user_id'];

                        $userQuery = "SELECT name FROM users WHERE user_id ='$user_id'";
                        $userLast = mysqli_query($conn,$userQuery);
                        $userRow = mysqli_fetch_assoc($userLast)
                    ?>
                    <!-- commentlist -->
                    <ol class="commentlist">

                        <li class="depth-1 comment">

                            <div class="comment__avatar">
                                <img width="50" height="50" class="avatar" src="images/avatars/generalAvatar.jpg" alt="">
                            </div>

                            <div class="comment__content">

                                <div class="comment__info">
                                    <cite><?php echo $userRow['name'] ?></cite>

                                    <div class="comment__meta">
                                        <time class="comment__time"><?php echo $commentRow['date_posted'] ?></time>
<?php //WHEN ADMIN IS SIGNED IN
if ((isset($_SESSION['admin_id']) == true)) { ?>
                                        <a class="reply" href="about.php?commentid=<?php echo $commentRow['aboutcomment_id']?>&act=del">Delete</a>
<?php }?>

<?php //WHEN USER IS SIGNED IN
if ((isset($_SESSION['user_id']) == true)) {
    if($_SESSION['user_id'] == $user_id){ ?>
                                        <a class="reply" href="about.php?commentid=<?php echo $commentRow['aboutcomment_id']?>&act=del">Delete</a>
    <?php }?>
<?php }?>
                                    </div>
                                </div>

                                <div class="comment__text">
                                <p><?php echo $commentRow['comment'] ?></p>
                                </div>

                            </div>

                        </li> <!-- end comment level 1 -->

                    </ol> <!-- end commentlist -->
                    <?php } } ?>

<?php if ((isset($_SESSION['user_id']) == true)) { ?>
                    <!-- respond
                    ================================================== -->
                    <div class="respond">

                        <h3 class="h2">Add Comment</h3>

                        <form name="contactForm" id="contactForm" method="post" action="">
                            <fieldset>

                                <div class="message form-field">
                                    <textarea name="comment" id="comment" class="full-width" placeholder="Your Comment" required></textarea>
                                </div>

                                <input type="submit" name = "save" value="Post" class="submit btn btn--primary full-width" />

                            </fieldset>
                        </form> <!-- end form -->

                    </div> <!-- end respond -->
<?php } ?>
                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

    </section> <!-- s-content -->


    <!-- s-extra
    ================================================== -->


     <!-- end s-extra -->


    <!-- s-footer
    ================================================== -->

    <?php include_once('./includes/footer.php'); ?>