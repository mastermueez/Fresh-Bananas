<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $servername ='localhost';
    $username   ='root';
    $password   = 'root';
    $dbname     = 'freshbananas';
/*  

    //online site link and details 
    //http://demo5g.lictproject.com
    
    $servername ='localhost';
    $username   ='demo5gli_fbanana';
    $password   = 'freshbananas@123';
    $dbname     = 'demo5gli_freshbananas';*/

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>