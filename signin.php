<?php
//ob_start();
include_once('./includes/database.php'); 
if(isset($_SESSION['user_id']) == true || isset($_SESSION['admin_id']) == true){
    echo "<script>window.location='index.php'</script>";
}

if (isset($_POST['save'])) {
    $query ="";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE email = '$email' AND password='$password'";
    $last = mysqli_query($conn,$query);
    $count = mysqli_num_rows($last);
        if($count>0){ //An admin has signed in
            $row = mysqli_fetch_assoc($last);
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_name'] = $row['name'];
            echo "<script>window.location='index.php'</script>";
        }
        else{ //Not an admin
            $query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
            $last = mysqli_query($conn,$query);
            $count = mysqli_num_rows($last);
            if($count>0){ //A user has signed in
                $row = mysqli_fetch_assoc($last);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['name'];
                echo "<script>window.location='index.php'</script>";
            }
            else{ //Neither user nor admin/incorrect info
                echo "<script> alert('Incorrect email/password inserted. Please try again.')</script>";
            }
        }
    } 
    ?>


    <!DOCTYPE html>
    <html class="no-js" lang="en">
    <head>

    <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Sign In - Fresh Bananas</title>
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
    <?php
    include_once('./includes/header.php'); ?>

    <!-- s-content
        ================================================== -->
        <section class="s-content s-content--narrow">
            <div class="row">
                <h3 style="text-align:center">Sign In</h3>
                <form name="cForm" id="cForm" method="post" action="">
                    <fieldset>
                        <div class="form-field">
                            <input name="email" type="text" id="email" class="full-width" placeholder="Enter Email" value="" required>
                        </div>

                        <div class="form-field">
                            <input name="password" type="password" id="password" class="full-width" placeholder="Enter Password" value="" required>
                        </div>                   
                        <button name="save" type="submit" class="submit btn btn--primary full-width">Submit</button>
                    </fieldset>
                </form> <!-- end form -->
            </div> <!-- end s-content__main -->
            <br><br>
        </section> <!-- s-content -->


    <!-- s-extra
        ================================================== -->


        <!-- end s-extra -->


    <!-- s-footer
        ================================================== -->

        <?php include_once('./includes/footer.php'); ?>