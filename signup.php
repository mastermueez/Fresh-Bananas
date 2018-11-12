<?php 
include_once('./includes/database.php');
if(isset($_POST['save'])){
    $name =$_POST['name'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    
    $checkQuery = "SELECT * FROM users";
    $checkLast = mysqli_query($conn,$checkQuery);
    $duplicateEmailFound=false;
    while($checkRow = mysqli_fetch_assoc($checkLast)){
        if($checkRow['email'] == $email){
            $duplicateEmailFound = true;
            echo "<script> alert('$email is already taken. Please try another email address.')</script>";
            break;
        }
    }
    $checkQuery = "SELECT * FROM admins";
    $checkLast = mysqli_query($conn,$checkQuery);
    while($checkRow = mysqli_fetch_assoc($checkLast)){
        if($checkRow['email'] == $email){
            $duplicateEmailFound = true;
            echo "<script> alert('$email is already taken. Please try another email address.')</script>";
            break;
        }
    }
    if(!$duplicateEmailFound){
    $query= "INSERT INTO users(name, email, password) VALUES ('$name','$email', '$password')";
  // exit();
    $last= mysqli_query($conn,$query);
    if($last){
        echo "<script>alert('Signed up successfully. Please sign in now.');window.location.href='signin.php';</script>";
    } else{
        echo "Sign up failed!";
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
    <title>Sign Up - Fresh Bananas</title>
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

            <h2>Sign Up</h2>

            <form name="cForm" id="cForm" method="post" action="">
                <fieldset>

                    <div class="form-field">
                        <input name="name" type="text" id="name" class="full-width" placeholder="Your Name" value="" required>
                    </div>

                    <div class="form-field">
                        <input name="email" type="email" id="email" class="full-width" placeholder="Your Email" value="" required>
                    </div>

                    <div class="form-field">
                        <input name="password" type="password" id="password" class="full-width" placeholder="Your Password"  value="" required>
                    </div>

                    <button name="save" type="submit" class="submit btn btn--primary full-width">Submit</button>

                </fieldset>
            </form> <!-- end form -->
        </div> 
    </section> <!-- s-content -->


    <!-- s-extra
    ================================================== -->


     <!-- end s-extra -->


    <!-- s-footer
    ================================================== -->

    <?php include_once('./includes/footer.php'); ?>