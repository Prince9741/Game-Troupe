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
    <title>Dog Runner-<?php echo $_SESSION['userName'];?></title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <link rel="stylesheet" href="../allGame.css">
    <script src="../allFileJs.js"></script>
    <style>
    #canvas1 {
        background-image:url(background1.png);
        }
        #player{
          display: none;
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
            <div id="title"><a href="#">Dog Runner</a></div>
        </nav>
    </header>
  <div id="container" value="canvas">
        <canvas style="display:block" id="canvas1"></canvas>
        <div id="instructions" style="display:none"></div>
    </div>
    <img id="player" src="player.png">
    <footer class="flex" id="footer">
        <div><a href="../index.php" class="button">Back</a></div>
        <!--go to highScore page -->
        <div class="button" id="instructionsButton">Instructions</div>
        <div class="button" id="pausePlay">Pause</div>
    </footer>
</body>
</html>

<script type="module">
const gameId=4;
loadDoc('../instructions.php?gameId='+gameId,'instructions');
  import { Player } from "./player.js";
  import { InputHandler } from "./input.js";
    let score;
    let life, gameStart;
    let lastTime,obsticleSpeed,next,obsticleDist;
    //canvas setup
    const canvas = document.getElementById('canvas1');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth-30;
    canvas.height = window.innerHeight-150;
    ctx.font = '30px Georgia';
    ctx.fillStyle = 'black';
    ctx.fillText("Click to Play", canvas.width / 2 - 100, canvas.height / 2 + 35);
    const pauseDiv = document.getElementById('pausePlay');
    const pauseButnDefault=pauseDiv.innerHTML;
    //Mouse Interactivtivity
    function gameValueSet() {
      score = 0;
      life = 5;
      lastTime=0;
      obsticleSpeed = 10;
      obsticleDist=30;
      next = 0;
    }
    gameValueSet();
    gameStart = false;
    canvas.addEventListener('click', function (event) {
    if(!gameStart){
        if(!life){//if life is zero and game is paused
            gameValueSet();
        }
        gameStart=true;
        pauseDiv.innerHTML=pauseButnDefault;
        animate(0); 
    }
});

    //repeating background
    const background = new Image();
    background.src = 'background1.png';

    function handleBackground() {
      ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
    }

    pauseDiv.addEventListener("click",pausePlay);
  
var instruct=false;
function pausePlay(){
    if(gameStart){
        gameStart=false;
        pauseDiv.innerHTML="Play";
    }   
    else if(!instruct){
        gameStart=true;
        pauseDiv.innerHTML=pauseButnDefault;
        animate();
    }
}


    window.onkeypress = function (event) {
      if (event.which == 32) {
        pausePlay();
      }
    }
    //game-over
    function gameOver() {//gameOver//////////////
      for (let i = 0; i < obsticleArray.length; i++)
        obsticleArray.splice(i, 1);
      ctx.fillText("Game Over", canvas.width / 2 - 65, canvas.height / 2);
      ctx.fillText("Click to Play Again", canvas.width / 2 - 110, canvas.height / 2 + 35);
      var url="../highScore/scoreSaving.php?score="+score+"&gameId="+gameId;
      sendData(url)
      gameStart = false;
    }
    class Game {
      constructor(width, height) {
        this.width = width;
        this.height = height;
        this.groundMargin = 40;
        this.player = new Player(this);
        this.input = new InputHandler(canvas);
      }
      update(deltaTime) {
        this.player.update(this.input.keys, deltaTime);
      }
      draw(context) {
        this.player.draw(context);
        context.beginPath();
        context.strokeStyle = "black";
        context.moveTo(0,this.height-this.groundMargin);
        context.lineTo(this.width, this.height-this.groundMargin);
        context.stroke();
      }
    }
    const game = new Game(canvas.width, canvas.height);
    console.log(game);
    class Obsticle {
      constructor() {
        this.height =Math.random() * 45 + 20;
        this.width =Math.random() * 30 + 25;
        this.bar=8;
        this.x = game.width - this.width;
        this.y = game.height - this.height - game.groundMargin;
        this.counted = false;
        this.lifeGone = document.createElement('audio');
        this.lifeGone.src = 'bark.mp3';
      }
      update() {
        this.x = this.x - obsticleSpeed;
      }
      draw() {
        ctx.beginPath();
        ctx.fillStyle = "red";
        ctx.fillRect(this.x, this.y, this.bar, this.height);
        ctx.fillRect( this.x+this.width-this.bar, this.y, this.bar, this.height);
        ctx.fillStyle = "black";
        ctx.fillRect(this.x, this.y, this.width, this.bar);
        ctx.fill();
      }
    }
    var obsticleArray = []; 
    
    function handleObsticle() {
      if (!next) {
        obsticleArray.push(new Obsticle);
        next = parseInt(Math.random()*obsticleDist+Math.random()*obsticleDist+Math.random()*obsticleDist+10);
      }
      else next--;
      for (var i = 0; i < obsticleArray.length; i++) {
        obsticleArray[i].update();
        obsticleArray[i].draw();
      }
      for (var i = 0; i < obsticleArray.length; i++) {
        if (obsticleArray[i].x + obsticleArray[i].width < 0) {
          obsticleArray.splice(i, 1);
          score++;
          if(!(score%5)) {
            obsticleSpeed++;
            obsticleDist+=1;
          }
          console.log("destroy by wall");
          i--;
        }
        else if (game.player.x < obsticleArray[i].x + obsticleArray[i].width &&
          game.player.y < obsticleArray[i].y + obsticleArray[i].height &&
          game.player.x + game.player.width > obsticleArray[i].x &&
          game.player.y + game.player.height > obsticleArray[i].y) {
          if (!obsticleArray[i].counted){
            obsticleArray[i].counted = true;
            obsticleArray[i].lifeGone.play();
            obsticleArray.splice(i, 1);
            life--;
            console.log("destroy by dog");
          }
        }
      }
    }
    function animate(timeStamp) {
      const deltaTime = timeStamp - lastTime;
      lastTime = timeStamp;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      handleBackground();
      handleObsticle();
      game.update(deltaTime);
      game.draw(ctx);
      ctx.fillStyle = "black";
      ctx.fillText('Score: ' + score, 10, canvas.height-10);
      ctx.fillText('Life: ' + life,  canvas.width-100, canvas.height-10);
      if (gameStart)
        life ? requestAnimationFrame(animate) : gameOver();
    }
    let temp,temp2,temp2Val=true,temp3,temp3Val="Game";
instructionsButton.addEventListener("click",()=>{
    if(!gameStart){
    temp=canvas1.style.display;
    canvas1.style.display=instructions.style.display;
    instructions.style.display=temp;
    temp2=instruct;
    instruct=temp2Val;
    temp2Val=temp2;
    temp3=instructionsButton.innerHTML;
    instructionsButton.innerHTML=temp3Val;
    temp3Val=temp3;
}
    else{
        alert("Can't read instructions, While play");
    }})
</script>