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
    <nav>
        <ul>
            <div class="wrapper">
                <li><a href="index.php">Home</a></li>
                <?php echo (isset($_SESSION['username'])) ? "<li><a href='profile.php'>My Profile</a></li>" : "<li><a href='sign_up.php'>Sign Up</a></li>" ?>
                <?php echo (isset($_SESSION['username'])) ? "<li><a href='logout.php'>Log Out</a></li>" :  "<li><a href='login.php'>Log In</a></li>" ?>
            </div>
        </ul>
    </nav>
    
    <div class="wrapper">