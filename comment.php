<?php

//If admin deletes a comment
if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    include_once('./includes/database.php'); 
    $comment_id = $_REQUEST['commentid'];
    $reviewIdQuery = "SELECT review_id from comments WHERE comment_id=$comment_id";
    $reviewIdResult = mysqli_query($conn, $reviewIdQuery);
    $reviewIdRow = mysqli_fetch_assoc($reviewIdResult);
    $review_id = $reviewIdRow['review_id'];


    $deleteCommentQuery = "DELETE FROM comments WHERE comment_id = $comment_id";
    $deleteCommentResult = mysqli_query($conn, $deleteCommentQuery);
    if ($deleteCommentResult) {
        echo "<script> window.location='review.php?reviewid=$review_id'</script>";
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

  $insertCommentQuery= "INSERT INTO comments(user_id, review_id, comment, date_posted) VALUES('$user_id', '$review_id','$comment', '$currentDate')";

    //executing query
    $insertCommentLast= mysqli_query($conn,$insertCommentQuery);


    if($insertCommentLast){
        echo "<script> window.location='review.php?reviewid=$review_id'</script>";
    } else{
        echo "Error: Databse storing FAILED!";
    }
}   

$commentQuery = "SELECT * FROM comments WHERE review_id ='$review_id'"; 
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
                                        <a class="reply" href="comment.php?commentid=<?php echo $commentRow['comment_id']?>&act=del">Delete</a>
<?php }?>

<?php //WHEN USER IS SIGNED IN
if ((isset($_SESSION['user_id']) == true)) {
    if($_SESSION['user_id'] == $user_id){ ?>
                                        <a class="reply" href="comment.php?commentid=<?php echo $commentRow['comment_id']?>&act=del">Delete</a>
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