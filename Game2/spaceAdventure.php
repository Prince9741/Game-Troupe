<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Adventure</title>
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
        <div class="name"><?php session_start(); echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
        <div class="button" id="pausePlay" onclick="pausePlay()">Pause</div><!-- go to signup page -->
    </footer>
</body>
</html>
<script>
let gameFrame,score;
let difficulty; //descrease to increase the density;
let starSpeed;//descrease to increase the speed;
let asteroidSpeed;//increase to increase the speed
let life,gameStart;
//canvas setup
const canvas = document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width = screen.width-30;
canvas.height = screen.height-280;
ctx.font = '30px Georgia';
ctx.fillStyle='white';
ctx.fillText("Click to Play",canvas.width/2-100,canvas.height/2+35);
//Mouse Interactivtivity
let canvasPosition = canvas.getBoundingClientRect();
const mouse = {
    x: canvas.width / 2,
    y: canvas.height / 2,
    click: false
}
function gameValueSet(){
    gameFrame = 0;
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
class Bubble {
    constructor(imgValue) {
        this.x = Math.random() * canvas.width;
        this.radius = Math.random() * 10 + 20;
        this.y = 0 - this.radius;
        this.speed = Math.random() * 5 + asteroidSpeed;
        this.counted = false;
        this.imgValue = imgValue;
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
const asteroidPop1 = document.createElement('audio');
asteroidPop1.src = 'blast.mp3';
const asteroidImage = new Image();
var asteroidColor=1;
function handleAsteroids() {
    if (!(gameFrame % difficulty)) {//difficulty
        asteroidsArray.push(new Bubble(asteroidColor));
        asteroidColor %=3;
        asteroidColor++;
    }
    for (let i = 0; i < asteroidsArray.length; i++) {
        if (asteroidsArray[i].y > canvas.height + asteroidsArray[i].radius * 2) {
            asteroidsArray.splice(i, 1);
            score++;
            if(!(score%5) && difficulty>40)
                    difficulty--;
            else if(!(score%20) && difficulty>30)
                difficulty--;
            if(!(score%20))
                    asteroidSpeed++;
            i--;
        }
        else if (RectCircleColliding(Ship,asteroidsArray[i])) {//check distance between circle and rocket
            if (!asteroidsArray[i].counted) {
                asteroidPop1.play();
                asteroidsArray[i].counted = true;
                asteroidsArray.splice(i, 1);
                life--;
                if(life<3)
                   difficulty+=5;
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
function pausePlay(){
    content=document.getElementById("pausePlay");
    if(gameStart){
        gameStart=false;
        content.innerHTML="Play";
    }
    else{
        content.innerHTML="Pause";
        gameStart=true;
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
    var url="../highScore/scoreSaving.php?score="+score+"&gameId="+2;
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
window.addEventListener('resize', function () {
    canvasPosition = canvas.getBoundingClientRect();
})
</script>