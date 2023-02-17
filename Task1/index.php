<?php
    session_start();
    include_once 'header.php';
?>

        <section class="index-intro">
            <h1>
                Hi there<?php echo (isset($_SESSION['username'])) ? ", ".$_SESSION['username'] . "!!": ""; ?>
            </h1>
        </section>
    </div>
    <div>
        <img src="https://i.imgur.com/93pEAaz.jpg" alt="" srcset="">
    </div>
</body>
</html>
