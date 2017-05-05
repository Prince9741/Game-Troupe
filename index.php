<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="head-foot.css">
        <script src="../allFileJs.js"></script>
        <style>
            .container{
            position:fixed;
            top:20vh;
            width: 99vw;
        }
        #score{
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 15vw;
        }
        #score img{
            border: 2px solid green;
            height:100px;
        }
        </style>
</head>
<body>
<header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="images/logo.png"></a></div><!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
<div class="container flex">
<div id="score">
    <div id="game1" class="game"><img src="images/images.png" alt="gamePHOT"></div>
    <div id="game2" class="game"><img src="images/images.png" alt="gamePHOT"></div>
    <div id="game3" class="game"><img src="images/images.png" alt="gamePHOT"></div>
    <div id="game4" class="game"><img src="images/images.png" alt="gamePHOT"></div>
    <div id="game5" class="game"><img src="images/images.png" alt="gamePHOT"></div>
    <div id="game6" class="game"><img src="images/images.png" alt="gamePHOT"></div>
</div>
</div>
    <footer class="flex" id="footer">
    <div><a href="highScore/HighScorepage.php" class="button">High Scores</a></div><!--go to highScore page -->
        <div><a href="log/logOut.php" class="button">Logout</a></div><!-- go to login up page -->
    </footer>
</body>
</html>

<!--
<?php/*
session_start();
if(isset($_SESSION['loggedin'])){
switch($_SESSION['gender']){
    case 0:
        echo "<div style='color:blue'>Welcome ".$_SESSION['username']."</div>"; 
        break;  
    case 1:
        echo "<div style='color:pink'>Welcome ".$_SESSION['username']."</div>";    
        break;
    case 2:
        echo "<div style='color:grey'>Welcome ".$_SESSION['username']."</div>";    
}
echo '<div class="button"><a href="log/logOut.php">Log Out</a></div>';
}
else
    header("location:log/logIn.html");//login page if not login
*/
?>
-->