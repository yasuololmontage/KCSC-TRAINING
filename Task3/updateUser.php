<?php
session_start();
include 'dbh.inc.php';
if(isset($_POST['submit']))
    {
        $password = $_POST['pwd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sex = $_POST['sex'];
        $pass_reapeat = $_POST['pwdrepeat'];
        $admin = $_POST['admin'];

        if($address == "" || $password == "" || $email == "" || $phone == "" || $sex == "" || $pass_reapeat == "" )
        {
            echo "Please fullfill your information!!!";
        } 
        else if($password !== $pass_reapeat)
        {
            echo "Password is not reapeated correctly!!!";
        }
        else
        {
            $username = $_POST['username'];
            $sqli = "UPDATE `task2` 
                     SET `password`='$password',`email`='$email',`phone`='$phone',`address`='$address',`sex`='$sex', `admin`='$admin'
                     WHERE `username`='$username'";
            $query = mysqli_query($conn, $sqli);
            if($query != 0)
            {
                header("Location: admin_panel.php");
            }
            else
            {
                header("Location: admin_update.php");
            }
        }       
    }
?>