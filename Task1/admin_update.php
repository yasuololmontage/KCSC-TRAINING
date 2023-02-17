<?php
    session_start();
    include 'dbh.inc.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['pwd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sex = $_POST['sex'];
        $pass_reapeat = $_POST['pwdrepeat'];
        $admin = 0;
        if($username == "" || $password == "" || $email == "" || $phone == "" || $sex == "" || $pass_reapeat == "")
        {
            echo "Please fullfill your information!!!";
        } 
        else if($password !== $pass_reapeat)
        {
            echo "Password is not reapeated correctly!!!";
        }
        else
        {
            $username = $_SESSION['username'];
            $sqli = "UPDATE `task 1` SET `password`='$password',`email`='$email',`phone`='$phone',`address`='$address',`sex`='$sex' WHERE `username`='$username'";
            $query = mysqli_query($conn, $sqli);
            if($query != 0)
            {
                echo "Update User Success";
            }
            else
            {
                echo "Update User Failed";
            }
        }       
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
    <title>PHP Project 01</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
<section class="singup-form">
    <h2>Edit User</h2>
    <tr>
            <td><a href="admin_panel.php">Admin Panel</a></td>
            <td><a href="logout.php">Log Out</a></td>
    </tr>
    <form action="admin_update.php" method="post">
        <?php 
            $usrname = $_SESSION['username'];
            $sqli = "SELECT * FROM `task 1` WHERE `username` = '$usrname'";
            $query = mysqli_query($conn, $sqli);
            $row = mysqli_fetch_assoc($query);
        ?>
        <table>
            <tr>
                <td>Email: </td>
                <td>
                    <input type="text" name="email" placeholder="Email..." value="<?php echo $row['email'] ?>">
                </td>
            </tr>            
            <td>Phone Number: </td>
                <td>
                    <input type="text" name="phone" placeholder="Phone Number..." value="<?php echo $row['phone'] ?>">
                </td>
            </tr>           
            <td>Address: </td>
                <td>
                    <input type="text" name="address" placeholder="Address..." value="<?php echo $row['address'] ?>">
                </td>
            </tr>            
            <td>Sex: </td>
                <td>
                    <input type="text" name="sex" placeholder="Sex..." value="<?php echo $row['sex'] ?>">
                </td>
            </tr>            
            <td>Password: </td>
                <td>
                    <input type="password" name="pwd" placeholder="Password..." value="<?php echo $row['password'] ?>">
                </td>
            </tr>            
            <td>Repeat Password: </td>
                <td>
                    <input type="password" name="pwdrepeat" placeholder="Repeat password..." value="<?php echo $row['password'] ?>">
                </td>
            <tr>
                        <td>
                            <button type="submit" name="submit">Update</button>
                        </td>
            </tr>
        </table>
    </form>
</section>
</div>
</body>
</html>