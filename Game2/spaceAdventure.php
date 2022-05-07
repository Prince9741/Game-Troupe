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
    <title>Space Adventure-<?php echo $_SESSION['userName'];?></title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <link rel="stylesheet" href="../allGame.css">
    <script src="../allFileJs.js"></script>
    <style>
    #canvas1 {
        background-image:url(background1.png);
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
            <div id="title"><a href="#">Space Adventure</a></div>
        </nav>
    </header>
    <div id="container" value="canvas">
        <canvas style="display:block" id="canvas1"></canvas>
        <div id="instructions" style="display:none"></div>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../index.php" class="button">Back</a></div>
        <!--go to highScore page -->
        <div class="button" id="instructionsButton">Instructions</div>
        <div class="button" id="pausePlay" onclick="pausePlay()">Pause</div>
    </footer>
</body>
</html>
<script>
const gameId=2;
loadDoc('../instructions.php?gameId='+gameId,'instructions');
let gameFrame,score;
let difficulty; //descrease to increase the density;
let starSpeed;//descrease to increase the speed;
let asteroidSpeed;//increase to increase the speed
let life,gameStart,asteroidColor;
//canvas setup
const canvas = document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth-30;
canvas.height = window.innerHeight-150;
ctx.font = '30px Georgia';
ctx.fillStyle='white';
ctx.fillText("Click to Play",canvas.width/2-100,canvas.height/2+35);
const pauseDiv = document.getElementById('pausePlay');
const pauseButnDefault=pauseDiv.innerHTML;
//Mouse Interactivtivity
let canvasPosition = canvas.getBoundingClientRect();
const mouse = {
    x: canvas.width / 2,
    y: canvas.height / 2,
    click: false
}
function gameValueSet(){
    gameFrame = 0;
    asteroidColor=1
    score = 0;
    difficulty = 50;//descrease to increase the density;
    starSpeed = 5;//descrease to increase the speed;
    asteroidSpeed = 1;//increase to increase the speed
    life=7;
    mouse.x= canvas.width / 2;
    mouse.y= canvas.height / 2;
}
gameValueSet();
gameStart=false;
canvas.addEventListener('mousemove', function (event) {
    mouse.click = true;
    mouse.x = event.x - canvasPosition.left-Ship.width/2;
    mouse.y = event.y - canvasPosition.top-Ship.height/2;
});
canvas.addEventListener('click', function (event) {
    if(!gameStart){
        if(!life){//if life is zero and game is paused
            gameValueSet();
        }
        gameStart=true;
        pauseDiv.innerHTML=pauseButnDefault;
        animate(); 
    }
});

//Ship
const ShipImage = new Image();
ShipImage.src = 'star.png';
class Player {
    constructor() {
        this.x = canvas.width/2;
        this.y = canvas.height;
        this.height = 130;
        this.width=60;
        this.angle=0;
        this.frameX = 0;
        this.frameY = 0;
        this.freame = 0;
        this.spriteWidth = 498;
        this.spriteHeight = 327;
    }
    update() {
        const dx = this.x - mouse.x;
        const dy = this.y - mouse.y;
        if (mouse.x != this.x)
            this.x -= dx / starSpeed;//star speed
        if (mouse.y != this.y)
            this.y -= dy / starSpeed;//star speed
    }
    draw() {
        ctx.save();
        ctx.drawImage(ShipImage,this.x,this.y,this.width,this.height);
        ctx.restore();
    }
}
const Ship = new Player();
//repeating background
const background = new Image();
background.src = 'background1.png';

function handleBackground() {
    ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
} 
//asteroids
const asteroidsArray = [];
const relation={0:"friend",1:"enemy"}
class Asteroid {
    constructor(imgValue,relation) {
        this.x = Math.random() * canvas.width;
        this.radius = Math.random() * 10 + 20;
        this.y = 0 - this.radius;
        this.speed = Math.random() * 5 + asteroidSpeed;
        this.counted = false;
        this.imgValue = imgValue;
        this.popSound=document.createElement('audio');
        this.popSound.src =relation?'collect.mp3':'blast.mp3';
    }
    update() {
        this.y += this.speed;
        const dx = this.x - Ship.x;
        const dy = this.y - Ship.y;
    }
    draw() {
        asteroidImage.src=this.imgValue+".png";
        ctx.drawImage(asteroidImage, this.x-this.radius, this.y-this.radius, this.radius * 2, this.radius * 2);
    }
}

const asteroidImage = new Image();
const allAsteroid=4;
function handleAsteroids() {
    if (!(gameFrame % difficulty)) {//difficulty
        rel=asteroidColor==allAsteroid?1:0;
        asteroidsArray.push(new Asteroid(asteroidColor,rel));
        asteroidColor %=allAsteroid;
        asteroidColor++;
    }
    for (let i = 0; i < asteroidsArray.length; i++) {
        if (asteroidsArray[i].y > canvas.height + asteroidsArray[i].radius * 2) {
            asteroidsArray.splice(i, 1);
            i--;
        }
        else if (RectCircleColliding(Ship,asteroidsArray[i])) {//check distance between circle and rocket
            if (!asteroidsArray[i].counted) {
                asteroidsArray[i].counted = true;
                if(asteroidsArray[i].imgValue==allAsteroid)score++;
                else life--;
                asteroidsArray[i].popSound.play();
                asteroidsArray.splice(i, 1);
                if(!(score%3) && difficulty>45 || !(score%7) && difficulty>40) difficulty--;
                if(!(score%5)) asteroidSpeed++;
                if(life<3) difficulty+=3;
            }
        }
    }
    for (let i = 0; i < asteroidsArray.length; i++) {
        asteroidsArray[i].update();
        asteroidsArray[i].draw();
    }
}

function RectCircleColliding(rect,circle){
    var dx=Math.abs(circle.x-(rect.x+rect.width/2));
    var dy=Math.abs(circle.y-(rect.y+rect.height/2));

    if( dx > circle.radius+rect.width/2 ){ return(false); }
    if( dy > circle.radius+rect.height/2 ){ return(false); }

    if( dx <= rect.width ){ return(true); }
    if( dy <= rect.height ){ return(true); }

    var dx=dx-rect.width;
    var dy=dy-rect.height
    return(dx*dx+dy*dy<=circle.radius*circle.radius);
}

//pausePlay
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

window.onkeypress = function(event) {
  if (event.which == 32) {
    pausePlay(); 
  }
}
//game-over
function gameOver(){//gameOver//////////////
    for (let i = 0; i < asteroidsArray.length; i++)
        asteroidsArray.splice(i, 1);
    ctx.fillText("Game Over",canvas.width/2-65,canvas.height/2);
    ctx.fillText("Click to Play Again",canvas.width/2-110,canvas.height/2+35);
    var url="../highScore/scoreSaving.php?score="+score+"&gameId="+gameId;
    sendData(url)
    gameStart=false;
}
//Animation
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    handleBackground();
    handleAsteroids();
    Ship.update();
    Ship.draw();
    ctx.fillText('Score: ' + score, 10, canvas.height-10);
    ctx.fillText('Life: ' + life,  canvas.width-100, canvas.height-10);
    gameFrame++;
    if(gameStart)
    life?requestAnimationFrame(animate):gameOver();
}
</script>
<script src="../gameJs.js"></script>