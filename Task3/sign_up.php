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
            $stmt = $conn->prepare("SELECT * FROM `task2` WHERE `username` = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                echo "Username exists!!!";
            }
            else
            {
                $stmt = $conn->prepare("INSERT INTO `task2`(`id`, `username`, `password`, `email`, `phone`, `address`, `sex`,`admin`) 
                                        VALUES (null,?,?,?,?,?,?,'$admin')");
                $stmt->bind_param("ssssss", $username, $password, $email, $phone, $address, $sex);
                $stmt->execute();
                if ($stmt->affected_rows > 0) 
                {
                    echo "Signed up successfully";
                    header("Location:index.php");
                } 
                else 
                {
                    echo "Sign up failed";
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