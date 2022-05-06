<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:../log/logIn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Puzzle-<?php echo $_SESSION['userName'];?></title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <script src="../allFileJs.js"></script>
    <style>
        .box {
            display: inline-block;
            height: 100px;
            width: 100px;
            transition:.5s ease;
            border-radius: 10px;  
        }

        .container {
            position: absolute;
            top:15%;
            text-align: center;
            display: flex ;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
        }

        .winner {
            font-size: 4em;
            height: auto;
            width:75vw;
            color: var(--tColor);
        }
        
        .box{
            z-index: 2;
            margin:20px;
        }

        #diamondBox{
            display: grid;
            grid-template-columns:repeat(2,auto);
        }

        .game3{
            border-radius:30px;
            box-shadow:inset 0px 0px 100px 100px black;  
        }
        
        #score{
            font-size: 4em;
            color: var(--tColor);
        }
        #instructions{
            position:absolute;
            border: 2px solid white;
            color:white;
            font-size:3em;
            width:80%;
            top:15%;
        }
        @media (max-width:400px){
        .box {
            height: 90px;
            width: 90px; 
        }
        .winner {
            font-size: 3.5em;
        }
        }
    </style>
</head>

<body>
    <header>
        <nav class="flex" id="navbar">
            <span class="flex">
                <!--go to highScore page -->    
                <div id="game"><a href="#">Game</a></div>
                <div class=""><a href="#"><img src="../images/logo.png"></a></div>
                <div id="troupe"><a href="#">Troupe</a></div>
            </span>
            <div id="title"><a href="#">Diamond Puzzle</a></div>
        </nav>
    </header>
    <div class="flex">
        <div class="container game3" id="canvas1" style="display:flex">
            <div id="winner" class="winner">Create these white diamonds</div>
            <div id="diamondBox">
                <div class="box box0"></div>
                <div class="box box1"></div>
                <div class="box box2"></div>
                <div class="box box3"></div>
            </div>
            <div id="score" class="">Move: 0</div>
        </div>
        <div id="instructions" style="display:none"></div>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../index.php" class="button">Back</a></div>
        <!--go to highScore page -->
        <div class="button" id="instructionsButton">Instructions</div>
       <div class="button" id="pausePlay" onclick="reset()">Reset</div><!-- go to signup page -->
    </footer>
</body>

</html>
<script>
    var gameId=3;
    loadDoc('../instructions.php?gameId='+gameId,'instructions');
    var score=0,gameStart=true;
    var defaultMsg=document.getElementById("winner").innerHTML;
    let i,a = document.getElementById("diamondBox").children;
    for (i = 0; i < a.length; i++) {
        a[i].addEventListener("click", rotate);
        a[i].style.border = "5px solid white";
    }
   
    function rotate(e) {
        if(!gameStart){
            reset();
            return;
        }
        var trans, clickedElement;

        clickedElement = e.target.style;

        trans = Number(e.target.style.transform.match(/\d+/g)) + 45;
        clickedElement.transform = "rotate(" + trans + "deg)";

        let lastStyle = clickedElement.border;
        for (i = 0; i < a.length; i++)
            a[i].style.border = "5px solid white";

        if (lastStyle == "5px solid white")
            clickedElement.border = "5px solid red";

        for (win = 1, i = 0; i < a.length; i++) {//check you win the game or not
            if (!(Number(a[i].style.transform.match(/\d+/g)) % 90)) {
                win = 0;
                break;
            }
            if (a[i].style.border != "5px solid white") {
                win = 0;
                break;
            }
        }
        document.getElementById("score").innerHTML="Move: "+ ++score;
        if (win){
            document.getElementById("winner").innerHTML = "Puzzle Solved";
            gameOver();
        }
        //else
        //document.getElementById("winner").innerHTML = "            Winner         ";        
    }

function reset(){
    for (i = 0; i < a.length; i++) {
        a[i].style.border = "5px solid white";
        a[i].style.transform="rotate(0deg)";
        document.getElementById("winner").innerHTML = defaultMsg;
        score=0;
        document.getElementById("score").innerHTML="Move: 0";
        gameStart=true;
    }
}

window.onkeypress = function(event) {
  if (event.which == 32) {
    reset(); 
  }
}
function gameOver(){//gameOver//////////////
    var url="../highScore/scoreSaving.php?score="+score+"&gameId="+gameId;
    sendData(url)
    gameStart=false;
}
let temp,temp3,temp3Val="Game";
instructionsButton.addEventListener("click",()=>{
    temp=canvas1.style.display;
    canvas1.style.display=instructions.style.display;
    instructions.style.display=temp;
    temp3=instructionsButton.innerHTML;
    instructionsButton.innerHTML=temp3Val;
    temp3Val=temp3
    })

</script>