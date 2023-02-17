<?php
    include_once 'header.php';
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
            $sqli = "SELECT * FROM `task 1` WHERE `username` = '$username'";
            $query = mysqli_query($conn, $sqli);
            if(mysqli_num_rows($query) == 1)
            {
                echo "Username exists!!!";
            }
            else
            {
                $sqli = "INSERT INTO `task 1`(`id`, `username`, `password`, `email`, `phone`, `address`, `sex`,`admin`) VALUES (null,'$username','$password','$email','$phone','$address','$sex','$admin')";
                $query = mysqli_query($conn, $sqli);
                if($query != 0)
                {
                    echo "Sign Up Success";
                    header("Location:index.php");
                }
                else
                {
                    echo "Sign Up Failure";
                }
            }
        }       
    }
?>

<section class="singup-form">
    <h2>Sign Up</h2>
    <form action="sign_up.php" method="post">
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
            
            <td>Repeat Password: </td>
                <td>
                    <input type="password" name="pwdrepeat" placeholder="Repeat password...">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="submit">Sign Up</button>
                </td>
            </tr>
        </table>
    </form>
</section>
</div>
</body>
</html>