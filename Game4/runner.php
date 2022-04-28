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
    <title>Game-Troupe Login</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <script src="../allFileJs.js"></script>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        #canvas1 {
          border: 5px solid black;
          position: absolute;
          top:50%;
          left:50%;
          transform: translate(-50%,-50%);
          max-height: 100%;
          max-width: 100%;
          background-color:rgb(43 87 108 / 68%);
        }
        #player{
          display: none;
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
    <canvas id="canvas1">
    </canvas>
    <img id="player" src="player.png">
  </div>
  <footer class="flex" id="footer">
      <div><a href="../index.php" class="button">Back</a></div>
      <!--go to highScore page -->
      <div class="name"><?php echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
      <div class="button" id="pausePlay" onclick="pausePlay()">Pause</div><!-- go to signup page -->
  </footer>
</body>
</html>

<script type="module">
  import { Player } from "./player.js";
  import { InputHandler } from "./input.js";
  window.addEventListener('load', function () {
    let score;
    let life, gameStart;
    let lastTime,obsticleSpeed,next;
    //canvas setup
    const canvas = document.getElementById('canvas1');
    const ctx = canvas.getContext('2d');
    canvas.width = screen.width - 30;
    canvas.height = screen.height - 280;
    ctx.font = '30px Georgia';
    ctx.fillStyle = 'black';
    ctx.fillText("Click to Play", canvas.width / 2 - 100, canvas.height / 2 + 35);
    //Mouse Interactivtivity
    function gameValueSet() {
      score = 0;
      life = 3;
      lastTime=0;
      obsticleSpeed = 10;
      next = 0;
    }
    gameValueSet();
    gameStart = false;
    canvas.addEventListener('click', function (event) {
      if (!gameStart) {
        if (!life) {//if life is zero and game is paused
          gameValueSet();
        }
        gameStart = true;
        animate(0);
      }
    });

    //repeating background
    // const background = new Image();
    // background.src = 'background1.png';

    // function handleBackground() {
    //   ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
    // }

    //pausePlay
    function pausePlay() {
      var pausePlayValue = document.getElementById("pausePlay");
      if (gameStart) {
        gameStart = false;
        pausePlayValue.innerHTML = "Play";
      }
      else {
        pausePlayValue.innerHTML = "Pause";
        gameStart = true;
        animate(0);
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
      var url = "../highScore/scoreSaving.php?score=" + score + "&gameId=" + 4;
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
        context.moveTo(0,this.height-this.groundMargin);
        context.lineTo(this.width, this.height-this.groundMargin);
        context.strokeStyle = "red";
        context.stroke();
      }
    }
    const game = new Game(canvas.width, canvas.height);
    console.log(game);
    class Obsticle {
      constructor() {
        this.height = Math.random() * 50 + 30;
        this.width =Math.random() * 30 + 30;
        this.bar=10;
        this.x = game.width - this.width;
        this.y = game.height - this.height - game.groundMargin;
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
        next = parseInt(Math.random() * 30 + game.player.width);
        console.log(next);
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
          console.log("destroy by wall");
        }
        if (game.player.x < obsticleArray[i].x + obsticleArray[i].width &&
          game.player.y < obsticleArray[i].y + obsticleArray[i].height &&
          game.player.x + game.player.width > obsticleArray[i].x &&
          game.player.y + game.player.height > obsticleArray[i].y) {
          obsticleArray.splice(i, 1);
          life--;
          console.log("destroy by dog");
        }
      }
    }
    
    function animate(timeStamp) {
      const deltaTime = timeStamp - lastTime;
      lastTime = timeStamp;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      handleObsticle();
      game.update(deltaTime);
      game.draw(ctx);
      ctx.fillStyle = "black";
      ctx.fillText('Score: ' + score, 10, canvas.height-10);
      ctx.fillText('Life: ' + life,  canvas.width-100, canvas.height-10);
      if (gameStart)
        life ? requestAnimationFrame(animate) : gameOver();
    }
  });</script>