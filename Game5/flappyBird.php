<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:../log/logIn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flappy Bird</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <script src="../allFileJs.js"></script>
    <style>
    * {
        margin: 0px;
        padding: 0px;
    }
    #container {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #canvas1 {
        border: 2px solid white;
        background-image:url(background1.png);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        cursor:grab;
    }
    </style>
</head>
<body>
    <header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="../images/logo.png"></a></div>
            <!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
    <div id="container">
        <canvas id="canvas1"></canvas>

    </div>
    <footer class="flex" id="footer">
        <div><a href="../index.php" class="button">Back</a></div>
        <!--go to highScore page -->
        <div class="name"><?php echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
        <div class="button" id="pausePlay" onclick="pausePlay()">Pause/Play</div><!-- go to signup page -->
    </footer>
</body>
</html>
<script src="app.js"></script>
