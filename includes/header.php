<?php
if ((isset($_SESSION['admin_id']) == true)) {
    $admin_id=$_SESSION['admin_id'];
    $adminQuery = "SELECT * FROM admins WHERE admin_id = '$admin_id'";
    $adminLast = mysqli_query($conn,$adminQuery);
    $adminRow = mysqli_fetch_assoc($adminLast);
    $admin_name = $adminRow['name'];
}
else if ((isset($_SESSION['user_id']) == true)) {
    $user_id=$_SESSION['user_id'];
    $userQuery = "SELECT * FROM users WHERE user_id = '$user_id'";
    $userLast = mysqli_query($conn,$userQuery);
    $useRow = mysqli_fetch_assoc($userLast);
    $user_name = $useRow['name'];
}

?>
<body id="top">
<div class="s-pageheader">
    <header class="header">
        <div class="header__content row">
            <div class="header__logo">
                <a class="logo" href="index.php">
                    <img src="images/logo.png" alt="Homepage">
                </a>
            </div> <!-- end header__logo -->
        <!--
                <ul class="header__social">
                    <li>
                        <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li>
                </ul> 
                <!-- end header__social -->
        <!--
                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="get" class="header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>
        
                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div> --> 
                <!-- end header__search -->


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                            <ul class="header__nav">
                                <li><a href="index.php" title="">Home</a></li>
                                 <?php //WHEN ADMIN IS SIGNED IN
                                 if ((isset($_SESSION['admin_id']) == true)) { ?>
                                 <li class="has-children">
                                    <a href="#0" title="">Movies</a>
                                    <ul class="sub-menu">
                                        <li><a href="addnew.php">Add New</a></li>
                                        <li><a href="movielist.php">All Movies</a></li>
                                        <!--<li><a href="index.php">All Genres</a></li> -->                           
                                    </ul>
                                </li>
                                <?php
                            } else { ?>
                            <li><a href="movielist.php" title="">Movies</a></li>
                            <?php } ?>
                            <li><a href="allreviews.php" title="">Reviews</a></li>
                            <li><a href="about.php" title="">About</a></li>

                            <?php //WHEN NO ONE IS SIGNED IN
                            if ((isset($_SESSION['admin_id']) == false) && (isset($_SESSION['user_id']) == false)) { ?>
                            <li><a href="signup.php" title="">Sign Up</a></li>
                            <li><a href="signin.php" title="">Sign In</a></li>
                            <?php } ?>

                            <?php //WHEN SOMEONE (ADMIN/USER) IS SIGNED IN
                            if ((isset($_SESSION['admin_id']) == true) || (isset($_SESSION['user_id']) == true)) {
                                //if ((isset($_SESSION['admin_id']) == true)){
                                ?>
                                    <!-- <li><a href="#0" title=""> <?php echo $admin_name ?> </a></li> -->
                                <?php // }
                               // else{ ?>
                                  <!--  <li><a href="#0" title=""> <?php echo $user_name ?> </a></li> -->
                                <?php // }
                            ?>

                            <li><a href="signout.php" title="">Sign Out (<?php if ((isset($_SESSION['admin_id']) == true)){ echo $admin_name; } else { echo $user_name; } ?>) </a></li>
                            <?php } ?>
                        </ul> <!-- end header__nav -->

                        <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                    </nav> <!-- end header__nav-wrap -->

                </div> <!-- header-content -->
            </header> <!-- header -->

    </div> <!-- end s-pageheader -->
</body>