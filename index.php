<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:log/logIn.php");
     // joing query to fetch the data
    require "db.php";
    $result=$Scoring->query("SELECT `GameName` from Game ORDER BY `GameId`");
    $gameName=array();
    if ($result && $result->num_rows > 0)
            while($row = $result->fetch_assoc())
                array_push($gameName,$row['GameName']);
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>highScore</title>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="head-foot.css">
        <script src="allFileJs.js"></script>
        <style>
      .container {
            top: 12vh;
            position: fixed;
            width: 100%;
        }
        
        .control{
            text-align: center;
            flex-direction: column;
        }

        .control div img{
            height: 170px;
            border-radius: 10px;
            border:3px solid var(--bColor);
            margin:5px 15px;
        }
        .control div img[class="active"]{
            box-shadow:0px 0px 15px 5px skyblue;
        }
        .part{
            flex-direction: row;
            margin: 5px;
        }
        .gName{
            font-size: 1.8em;
            color: var(--tColor);
            margin:0px;
        }
        @media (max-width:700px){
            .control div img{
                height: 130px;
            }
        }
        @media (max-width:500px){
            .control div img{
                height: 100px;
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
        <div class="control flex">
            <div class="part flex">
                <div>
                    <div class="gName"><?php echo $gameName[0];?></div>
                    <div id="game1" onclick=""><a href="Game1/ballonPopper.php"><img src="images/Game1.png"></a></div>
                </div>
                <div>
                    <div class="gName"><?php echo $gameName[1];?></div>
                    <div id="game2" onclick=""><a href="Game2/spaceAdventure.php"><img src="images/Game2.png"></a></div>
                </div>
                <div>
                    <div class="gName"><?php echo $gameName[2];?></div>
                    <div id="game3" onclick=""><a href="Game3/diamondPuzzle.php"><img src="images/Game3.png"></a></div>
                </div>
            </div>
            <div class="part flex">
                <div>
                    <div class="gName"><?php echo $gameName[3];?></div>
                    <div id="game4" onclick=""><a href="Game4/runner.php"><img src="images/Game4.png"></a></div>
                </div>
                <div>
                    <div class="gName"><?php echo $gameName[4];?></div>
                    <div id="game5" onclick=""><a href="Game5/flappyBird.php"><img src="images/Game5.png"></a></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="flex" id="footer">
    <div><a href="highScore/highScorePage.php" class="button">Scores</a></div><!--go to highScore page -->    
    <div class="name"><?php echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
    <div><a href="log/logOut.php" class="button">Exit</a></div><!-- go to login up page -->
    </footer>
</body>
</html>
