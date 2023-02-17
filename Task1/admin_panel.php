<?php
    session_start();
    include 'dbh.inc.php';
    if($_SESSION['admin'] != 1)
    {
        header('Location:index.php');
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
    <h1>Admin Panel</h1>
    <div>
       <tr>
            <td><a href="logout.php">Log Out</a></td>
        </tr>
        <tr>
            <td><a href="admin_addUser.php">Add User</a></td>
       </tr>
        <table>
            <tr>
                <th>UserID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
            <?php 
            $sqli = "SELECT * FROM `task 1`";
            $query = mysqli_query($conn, $sqli);
            while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['password'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['sex'] ?></td>
                    <td><?php echo $row['admin'] ?></td>
                    <td>
                        <a href="admin_update.php?username=<?php echo $row['username'] ?>"> Edit</a>
                        <a href="admin_delete.php?username=<?php echo $row['username'] ?>"> Delete</a>
                    </td>
                </tr>
            <?php            
            }
            ?>
        </table>
        </form>
    </div>
    <div>
        <img src="https://i.imgur.com/93pEAaz.jpg" alt="" srcset="">
    </div>
</body>
</html>