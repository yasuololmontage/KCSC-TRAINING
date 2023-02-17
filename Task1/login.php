<?php
    session_start();
    include_once 'header.php';
    include 'dbh.inc.php';
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['pwd'];
        $email = $_POST['username'];
        
        if($username == "" || $password == "" || $email == "")
        {
            echo "Please fullfill your information!!!";
        }
        else
        {
            $sqli = "SELECT * FROM `task 1` WHERE (`username` = '$username' AND `password` = '$password') or (`email` = '$email' AND `password` = '$password')";
            $query = mysqli_query($conn, $sqli);
            $row = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) != 0)
            {
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $row['admin'];
                if($_SESSION['admin'] == 1)
                    {
                        header('Location:admin_panel.php');
                    }
                else
                {
                    header("Location:index.php?username=".$username);
                }
            }
            else
            {
                echo "Wrong username or password!!!";
            }
        }
    }

?>
        <section class="singup-form">
            <h2>Log In</h2>
            <form action="login.php" method="post">
            <table>
            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" placeholder="Username/Email...">
                </td>
            </tr>
            <tr>
                <td>Password: </td>
                <td>
                    <input type="password" name="pwd" placeholder="Password...">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="submit">Log In</button>
                </td>
            </tr>
            </table>
            </form>
        </section>
    </div>
</body>
</html>
