<?php
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);
$back=$log?"background-image:url(../images/back1.png);":"background-image:url(../images/back.png);";
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
    <title>Game-Troupe Highscore</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <script src="../allFileJs.js"></script>
    <style>
    .container {
        top: 13.5vh;
        position: fixed;
        width: 100%;
        flex-direction: column;
    }

    #control {
        display: grid;
        text-align: center;
        grid-column-gap: 20px;
        grid-row-gap: 25px;
        grid-template-columns: repeat(3, auto);
    }

    #control .game img{
        height: 120px;
        border-radius: 10px;
        border: 3px solid var(--tColor);
    }

    #control .game img:hover {
        outline: 3px solid var(--bColor);
    }

    #control .game img[class="active"] {
        box-shadow: 0px 0px 15px 5px skyblue;
        transform: scale(1.1);
    }

    .data {
        box-shadow: 0px 0px 50px 15px black;
        border-radius: 20px;
        padding: 5px;
    }

    .data tr,
    .heading {
        color: var(--tColor);
        font-family: cursive;
    }

    .data td,
    .heading {
        text-align: center;
        border-radius: 40%;
        border-bottom: 2.5px solid var(--tColor);
        padding: 2.5px 10px;
        font-size: 1.5em;
    }
    #dataContent img{
        border-radius: 100%;
        height: 27px;
        width: 27px;
        transform: scale(1.2);
    }
    .others td{
        color: #e8dc39;
    }
    .others img {
        border: 0px solid #e8dc39;
    }
    .male td {
        color: skyblue;
    }
    .male img {
        border: 0px solid skyblue;
    }
    .female td {
        color: var(--female);
    }
    .female img {
        border: 0px solid var(--female);
    }

    @media (max-width:700px) {
        #control {
            grid-column-gap: 10px;
            grid-row-gap: 20px;
        }

        #control .game img {
            height: 80px;
        }

        .data td {
            padding: 2px 5px;
            font-size: 1.5em;
        }
    }

    @media (max-width:500px) {
        #control {
            grid-column-gap: 5px;
            grid-row-gap: 10px;
        }

        #control .game img {
            height: 70px;
        }

        .data td {
            font-size: 1.2em;
        }
    }
   
     </style>
</head>

<body style=<?php echo $back;?>>
<?php $page="High Score"; require "../header.php";?>
    <div class="container flex">
        <div id="control">
            <div id="game1" class="game" onclick="currentGame(0,1,'<?php echo $gameName[0];?>')" ondblclick="playGame(1)"><img src="../images/Game1.png" alt="game"></div>
            <div id="game2" class="game" onclick="currentGame(1,2,'<?php echo $gameName[1];?>')" ondblclick="playGame(2)"><img class="active" src="../images/Game2.png" alt="game"></div>
            <div id="game3" class="game" onclick="currentGame(2,3,'<?php echo $gameName[2];?>')" ondblclick="playGame(3)"><img src="../images/Game3.png" alt="game"></div>
            <div id="game4" class="game" onclick="currentGame(3,4,'<?php echo $gameName[3];?>')" ondblclick="playGame(4)"><img src="../images/Game4.png" alt="game"></div>
            <div class="data">
                <table><div class="heading" id="heading"><?php echo $gameName[1];?></div>
                    <thead>
                        <tr>
                            <td>Pic</td>
                            <td>Name</td>
                            <td>Score</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody id="dataContent"></tbody>
                </table>
            </div>
            <div id="game5" class="game" onclick="currentGame(5,5,'<?php echo $gameName[4];?>')" ondblclick="playGame(5)"><img src="../images/Game5.png" alt="game"></div>
        </div>
    </div>
    <footer class="flex" id="footer">
        <div><a href="#" ></a></div>
        <!--go to highScore page -->
        <div><a href="../log/logIn.php" class="button">Play</a></div><!-- go to login up page -->
    </footer>
</body>

</html>
<script>
    var active=1;
    var img=document.querySelector("#control").children;
    loadDoc("highScore.php?gameId=2", "dataContent");
    function currentGame(nextLoc,gameId,gameName){//this function change the next data or selection
        dataContent.innerHTML="<tr><td>Loading...</td><td>Loading...</td><td>Loading...</td><td>Loading...</td></tr>";
        url = "highScore.php?gameId=" + gameId;
        loadDoc(url, "dataContent");
        console.log("Data Update Game no."+gameId);
        img[active].firstChild.classList.remove("active");
        img[nextLoc].firstChild.classList.add("active");
        heading.innerHTML=gameName
        active=nextLoc;
    }
    gameList={1:"ballonPopper.php",2:"spaceAdventure.php",3:"diamondPuzzle.php",4:"runner.php",5:"flappyBird.php"};
    function playGame(e){
        gameName=gameList[e];
        url="../Game"+e+"/"+gameName;
        window.location=url;
    }
</script>
