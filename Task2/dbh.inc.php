<?php

$serverName = "localhost";
$DBUserName = "root";
$DBPassword = "";
$DBName = "kcsc-training";

$conn = mysqli_connect($serverName, $DBUserName, $DBPassword, $DBName);

if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>