<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ballon Poper</title>
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
        background: url("background1.png");
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
let ballonSpeed;//increase to increase the speed
let life,gameStart;
//canvas setup
const canvas = document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width = screen.width-30;
canvas.height = screen.height-280;
ctx.font = '30px Georgia';
ctx.fillStyle='black';
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
    starSpeed = 3;//descrease to increase the speed;
    ballonSpeed = 1;//increase to increase the speed
    life=7;
    mouse.x= canvas.width / 2;
    mouse.y= canvas.height / 2;
}
gameValueSet();
gameStart=false;
canvas.addEventListener('mousedown', function (event) {
    mouse.click = true;
    mouse.x = event.x - canvasPosition.left;
    mouse.y = event.y - canvasPosition.top;
    canvas.style.cursor='grabbing';
   
    if(!gameStart){
        if(!life){//if life is zero and game is paused
            gameValueSet();
        }
        gameStart=true;
        animate(); 
    }
});
canvas.addEventListener('mouseup', function (event) {
    mouse.click = false;
    canvas.style.cursor='grab';
});
//player
const playerLeft = new Image();
playerLeft.src = 'star.png';
class Player {
    constructor() {
        this.x = canvas.width;
        this.y = canvas.height / 2;
        this.radius = 30;
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
        ctx.translate(this.x, this.y);
        if (gameFrame % 3 == 0) this.angle++;
        ctx.rotate(this.angle);
        ctx.drawImage(playerLeft, this.frameX * this.spriteWidth, this.frameY * this.spriteHeight, this.spriteWidth, this.spriteHeight, 0 - 29, 0 - 29, this.spriteWidth / 4, this.spriteHeight / 4);
        ctx.restore();
    }
}
const player = new Player();

//repeating background
const background = new Image();
background.src = 'background1.png';

function handleBackground() {
    ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
} 

//ballons
const ballonsArray = [];
class Bubble {
    constructor(imgValue) {
        this.x = Math.random() * canvas.width;
        this.radius = Math.random() * 15 + 30;
        this.y = canvas.height + this.radius;
        this.speed = Math.random() * 5 + ballonSpeed;
        this.distance;
        this.counted = false;
        this.imgValue = imgValue;
        this.sound = Math.random() <= 0.5 ? 'sound1' : 'sound2';
    }
    update() {
        this.y -= this.speed;
        const dx = this.x - player.x;
        const dy = this.y - player.y;
        this.distance = Math.sqrt(dx * dx + dy * dy);
    }
    draw() {
        ballonImage.src=this.imgValue+".png";
        ctx.drawImage(ballonImage, this.x - 48, this.y - 40, this.radius * 2.6, this.radius * 2.6);
    }
}
const ballonPop1 = document.createElement('audio');
ballonPop1.src = 'pop.mp3';
const ballonImage = new Image();
var ballonColor=1;
function handleBallons() {
    if (!(gameFrame % difficulty)) {//difficulty
        ballonsArray.push(new Bubble(ballonColor));
        ballonColor %=4;
        ballonColor++;
    }
    for (let i = 0; i < ballonsArray.length; i++) {
        if (ballonsArray[i].y < 0 - ballonsArray[i].radius * 2) {
            ballonsArray.splice(i, 1);
            life--;
            if(life<3)
                   difficulty+=5;
            i--;
        }
        else if (ballonsArray[i].distance < ballonsArray[i].radius + player.radius) {
            if (!ballonsArray[i].counted) {
                ballonPop1.pause();
                ballonPop1.play();
                score++;
                if(!(score%5) && difficulty>40)
                    difficulty--;
                else if(!(score%20) && difficulty>30)
                    difficulty--;
                if(!(score%20))
                        ballonSpeed++;
                ballonsArray[i].counted = true;
                ballonsArray.splice(i, 1);
            }
        }
    }
    for (let i = 0; i < ballonsArray.length; i++) {
        ballonsArray[i].update();
        ballonsArray[i].draw();
    }
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

//game-over
function gameOver(){//gameOver//////////////
    for (let i = 0; i < ballonsArray.length; i++)
        ballonsArray.splice(i, 1);
    ctx.fillText("Game Over",canvas.width/2-65,canvas.height/2);
    ctx.fillText("Click to Play Again",canvas.width/2-110,canvas.height/2+35);
    var url="../highScore/scoreSaving.php?score="+score+"&gameId="+1;
    sendData(url)
    gameStart=false;
}
//Animation
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    handleBackground();
    handleBallons();
    player.update();
    player.draw();
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