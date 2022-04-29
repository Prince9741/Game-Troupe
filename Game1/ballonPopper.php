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
        <div class="name"><?php echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
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
let ballonColor
//canvas setup
const canvas = document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width = screen.width-30;
canvas.height = screen.height-280;
ctx.font = '30px Georgia';
ctx.fillStyle='black';
ctx.fillText("Click to Play",canvas.width/2-100,canvas.height/2+35);
//repeating background
const background = new Image();
background.src = 'background1.png';

function handleBackground() {
    ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
} 
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
    ballonColor=1;
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
        if(!life)gameValueSet();//if life is zero and game is paused
        gameStart=true;
        animate(); 
    }
});
canvas.addEventListener('mouseup', function (event) {
    mouse.click = false;
    canvas.style.cursor='grab';
});
//star
const starImage = new Image();
starImage.src = 'star.png';
class Player {
    constructor() {
        this.x = canvas.width;
        this.y = canvas.height / 2;
        this.radius = 30;
        this.angle=0;
        this.frameX = 0;
        this.frameY = 0;
        this.freame = 0;
        this.sWidth = 220;
        this.sHeight = 229;
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
        ctx.drawImage(starImage, this.frameX * this.sWidth, this.frameY * this.sHeight, this.sWidth, this.sHeight, - this.radius, - this.radius, this.sWidth / 4, this.sHeight / 4);
        ctx.restore();
    }
}
const star = new Player();

//ballons
const ballonsArray = [];
class Ballon {
    constructor(imgValue) {
        this.x = Math.random() * canvas.width;
        this.radius = Math.random() * 15 + 30;
        this.y = canvas.height + this.radius;
        this.speed = Math.random() * 5 + ballonSpeed;
        this.frame=0;
        this.sWidth=100;
        this.sHeight=100;
        this.distance;
        this.counted = false;
        this.imgValue = imgValue+".png";
        this.sound = Math.random() <= 0.5 ? 'sound1' : 'sound2';
    }
    update() {
        this.y -= this.speed;
        const dx = this.x - star.x;
        const dy = this.y - star.y;
        this.distance = Math.sqrt(dx * dx + dy * dy);
    }
    draw() {
        ballonImage.src=this.imgValue;
        ctx.drawImage(ballonImage, this.frame * this.sWidth, 0, this.sWidth, this.sHeight, this.x - 48, this.y - 40, this.radius * 2.6, this.radius * 2.6);
    }
}
const blastImage= new Image();
class Blast {
    constructor(x,y,radius,imgValue) {
        this.x = x;
        this.radius = radius;
        this.y = y;
        this.imgValue = imgValue;
        this.blastMaxFrame=30;
        this.blastFrame=0;
        this.frame=0;
        this.frameLength=6;
        this.sWidth=100;
        this.sHeight=100;
        this.code=1;
    }
    update() {
        if(this.code){
            this.frame++;
            this.code=0;
        }
        else this.code=1;
    }
    draw() {
        // ctx.beginPath();
        // ctx.fillStyle="red";
        // ctx.arc(this.x,this.y,this.radius,0,Math.PI*2);
        // ctx.fill();
        ballonImage.src=this.imgValue;
        ctx.drawImage(ballonImage, this.frame * this.sWidth, 0, this.sWidth, this.sHeight, this.x - 48, this.y - 40, this.radius * 2.6, this.radius * 2.6);
    
    }
}
const blastArray=[];
function ballonBlast(){
    for (let i = 0; i < blastArray.length; i++) {
        blastArray[i].draw();
        blastArray[i].update();
        if(blastArray[i].frame>blastArray[i].frameLength)
           blastArray.splice(i, 1);
    }
}
const ballonPop1 = document.createElement('audio');
ballonPop1.src = 'pop.mp3';
const ballonImage = new Image();
function handleBallons() {
    if (!(gameFrame % difficulty)) {//difficulty
        ballonsArray.push(new Ballon(ballonColor));
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
        else if (ballonsArray[i].distance < ballonsArray[i].radius + star.radius) {
            if (!ballonsArray[i].counted) {
                ballonPop1.pause();
                ballonPop1.play();
                score++;
                if(!(score%5) && difficulty>40)
                    difficulty--;
                else if(!(score%20) && difficulty>30)
                    difficulty--;
                if(!(score%15))
                        ballonSpeed++;
                ballonsArray[i].counted = true;
                blastArray.push(new Blast(ballonsArray[i].x,ballonsArray[i].y,ballonsArray[i].radius,ballonsArray[i].imgValue));
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

window.onkeypress = function(event) {
  if (event.which == 32) {
    pausePlay(); 
  }
}
//game-over
function gameOver(){//gameOver//////////////
    for (let i = 0; i < ballonsArray.length; i++)
        ballonsArray.splice(i, 1);
    for (let i = 0; i < blastArray.length; i++)
        blastArray.splice(i, 1);
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
    ballonBlast();
    star.update();
    star.draw();
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