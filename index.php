<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:log/logIn.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="head-foot.css">
        <script src="allFileJs.js"></script>
        <style>
      .container {
            top: 16vh;
            position: fixed;
            width: 100%;
            flex-direction: column;
        }
        
        #control{
            display: grid;
            text-align: center;
            grid-gap: 40px;
            grid-template-columns:repeat(3,auto);

        }
        #control div img{
            height: 150px;
            border-radius: 10px;
            border:3px solid var(--tColor);
        }
        #control div img[class="active"]{
            box-shadow:0px 0px 15px 5px skyblue;
        }
        
        @media (max-width:700px){
            #control{
            grid-template-columns:repeat(2,auto);
            grid-gap: 5px;
            }
           
        }
        @media (max-width:500px){
            #control{
            grid-row-gap:10px;
            }
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
        <div id="control">
            <div id="game1" onclick=""><a href="Game1/ballonPopper.php"><img src="images/Game1.png" alt="game"></a></div>
            <div id="game2" onclick=""><img src="images/Game2.png" alt="game"></div>
            <div id="game3" onclick=""><img src="images/Game3.png" alt="game"></div>
            <div id="game4" onclick=""><img src="images/Game4.png" alt="game"></div>
            <div id="game4" onclick=""><img src="images/logo.png" alt="game"></div>
            <div id="game5" onclick=""><img src="images/Game5.png" alt="game"></div>
        </div>
    </div>
    <footer class="flex" id="footer">
    <div><a href="highScore/highScorePage.php" class="button">Scores</a></div><!--go to highScore page -->    
    <div class="name"><?php echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
    <div><a href="log/logOut.php" class="button">Exit</a></div><!-- go to login up page -->
    </footer>
</body>
</html>
?>
