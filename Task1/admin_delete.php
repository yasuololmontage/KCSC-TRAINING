<?php 
    include "dbh.inc.php";
    $username = $_GET['username'];
    $sqli = "DELETE FROM `task 1` WHERE `username`='$username'";
    $query = mysqli_query($conn, $sqli);
    if($query != 0)
    {
        session_destroy();
        header("Location:admin_panel.php");
    }
    else
    {
        echo "Delete Failed";
    } 