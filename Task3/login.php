<?php
    session_start();
    include_once 'header.php';
    include 'dbh.inc.php';
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['pwd'];
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        if($username == "" || $password == "")
        {
            echo "Please fullfill your information!!!";
        }
        else
        {
            $stmt = $conn->prepare("SELECT * FROM `task2` WHERE (`username` = ? AND `password` = ?)");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($user)
            {
                $_SESSION['username'] = $username;
                $_SESSION['admin']  = $user['admin'];
                if($user['admin'] == 1)
                {
                    header('Location: admin_panel.php');
                }
                else
                {
                    header('Location: index.php?username='.$username);
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
                    <input type="text" name="username" placeholder="Username...">
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