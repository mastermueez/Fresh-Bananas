<?php
include_once('./includes/database.php');

function hasCommented($conn, $user_id){
    $result = mysqli_query($conn,"SELECT COUNT(user_id) AS commentCount FROM comments WHERE user_id = '$user_id' ");
    $row = mysqli_fetch_array($result);
    if($row['commentCount'] > 0){
       return true;         
    }
    else{ 
        return false;
    }
}

if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $user_id = $_REQUEST['userid'];
    if(hasCommented($conn, $user_id)){
        $rec = mysqli_query($conn, "DELETE FROM comments WHERE user_id = $user_id");
    }
    $query = "DELETE FROM users WHERE user_id = $user_id";
    $rec = mysqli_query($conn, $query);
    if ($rec) {
        echo "<script>window.location='allusers.php'</script>";
    } else {
        echo "Error occured with editing/deleting";
    }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>User List - Fresh Bananas</title>
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
                        User List
                    </h1>
                </div> <!-- end s-content__header -->

                <div class="col-twelve">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>User Name</th>
                                    <th>Comments Made</th>
<?php //WHEN ADMIN IS SIGNED IN
if ((isset($_SESSION['admin_id']) == true)) { ?>
                                    <th>Email</th>
                                    <th>Action</th>
<?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                $uerQuery="SELECT * FROM users";
                                $userResult = mysqli_query($conn, $uerQuery);
                                while ($userRow = mysqli_fetch_assoc($userResult)) { ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $userRow['name']; ?></td>
                                    <td>
<?php
$user_id = $userRow['user_id'];
$commentQuery = "SELECT comment_id FROM comments WHERE user_id ='$user_id'";     
$commentResult = mysqli_query($conn,$commentQuery);
$commentCount = mysqli_num_rows($commentResult);

$aboutcommentQuery = "SELECT aboutcomment_id FROM aboutcomments WHERE user_id ='$user_id'";     
$aboutcommentResult = mysqli_query($conn,$aboutcommentQuery);
$commentCount = mysqli_num_rows($aboutcommentResult) + $commentCount;

echo $commentCount;
?>                                       
                                    </td>
<?php //WHEN ADMIN IS SIGNED IN
if ((isset($_SESSION['admin_id']) == true)) { ?>
                                    <td><?php echo $userRow['email']; ?></td>
                                    <td><a href="allusers.php?userid=<?php echo $userRow['user_id']?>&act=del" class="delete">Delete</a></td>
<?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end row -->

</section> <!-- s-content -->

<?php include_once('./includes/footer.php'); ?>