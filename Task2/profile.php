<?php
    session_start();
    include_once 'header.php';
    include 'dbh.inc.php';
    if(isset($_POST['submit'])){
        $password = $_POST['pwd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sex = $_POST['sex'];
        $pass_reapeat = $_POST['pwdrepeat'];
        $admin = 0;
        if($password == "" || $email == "" || $phone == "" || $sex == "" || $pass_reapeat == "")
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
                echo "Update Success";
            }
            else
            {
                echo "Update Failed";
            }
        }       
    }
    if(isset($_POST['delete']))
    {
        $username = $_SESSION['username'];
        $sqli = "DELETE FROM `task 1` WHERE `username`='$username'";
        $query = mysqli_query($conn, $sqli);
        if($query != 0)
        {
            session_destroy();
            header("Location:index.php");
        }
        else
        {
            echo "Delete Failed";
        }
    }
?>
<section class="singup-form">
    <h2>Update Your Information</h2>
    <form action="profile.php" method="post">
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
            </tr>
                <td>
                    <button type="submit" name="submit">Update</button>
                </td>
                <td>
                    <button type="submit" name="delete">Delete</button>
                </td>
            </tr>
        </table>
    </form>
</section>
</div>
</body>
</html>