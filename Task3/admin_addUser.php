<?php
include 'dbh.inc.php'; 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['pwd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sex = $_POST['sex'];
        $pass_reapeat = $_POST['pwdrepeat'];
        $admin = $_POST['admin'];
        if($username == "" || $password == "" || $email == "" || $phone == "" || $sex == "" || $pass_reapeat == "" || $admin == "")
        {
            echo "Please fullfill your information!!!";
        } 
        else if($password !== $pass_reapeat)
        {
            echo "Password is not reapeated correctly!!!";
        }
        else
        {
            $sqli = "SELECT * FROM `task2` WHERE `username` = '$username'";
            $query = mysqli_query($conn, $sqli);
            if(mysqli_num_rows($query) == 1)
            {
                echo "Username exists!!!";
            }
            else
            {
                $sqli = "INSERT INTO `task2`(`id`, `username`, `password`, `email`, `phone`, `address`, `sex`,`admin`) 
                         VALUES (null,'$username','$password','$email','$phone','$address','$sex','$admin')";
                $query = mysqli_query($conn, $sqli);
                if($query != 0)
                {
                    echo "Add User Success";
                    header("Location:admin_panel.php");
                }
                else
                {
                    echo "Add User Failed";
                }
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
    <h2>Add User</h2>
    <div>
        <tr>
            <td><a href="admin_panel.php">Admin Panel</a></td>
            <td><a href="logout.php">Log Out</a></td>
        </tr>
        <section class="singup-form">
            <form action="admin_addUser.php" method="post">
                <table>
                    <tr>
                        <td>Email: </td>
                        <td>
                            <input type="text" name="email" placeholder="Email...">
                        </td>
                    </tr>

                    <td>Phone Number: </td>
                    <td>
                        <input type="text" name="phone" placeholder="Phone Number...">
                    </td>
                    </tr>

                    <td>Address: </td>
                    <td>
                        <input type="text" name="address" placeholder="Address...">
                    </td>
                    </tr>

                    <td>Sex: </td>
                    <td>
                        <input type="text" name="sex" placeholder="Sex...">
                    </td>
                    </tr>

                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Username...">
                    </td>
                    </tr>

                    <td>Password: </td>
                    <td>
                        <input type="password" name="pwd" placeholder="Password...">
                    </td>
                    </tr>

                    <td>Admin: </td>
                    <td>
                        <input type="text" name="admin" placeholder="Admin...">
                    </td>
                    </tr>

                    <td>Repeat Password: </td>
                    <td>
                        <input type="password" name="pwdrepeat" placeholder="Repeat password...">
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit">Add</button>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </div>
</body>

</html>