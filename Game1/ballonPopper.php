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
        <div><a href="../log/logout.php" class="button">Exit</a></div><!-- go to signup page -->
        <!--go to highScore page -->
        <div class="name"><?php session_start(); echo "Welcome ".$_SESSION['userName'];?></div><!-- go to login up page -->
        <div><a href="../index.php" class="button">Home</a></div>
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
canvas.width = 1200;
canvas.height = 500;
ctx.font = '50px Georgia';
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
    starSpeed = 2;//descrease to increase the speed;
    ballonSpeed = 1;//increase to increase the speed
    life=10;
    gameStart=true;
}
gameValueSet();
canvas.addEventListener('mousedown', function (event) {
    mouse.click = true;
    mouse.x = event.x - canvasPosition.left;
    mouse.y = event.y - canvasPosition.top;
    canvas.style.cursor='grabbing';
    if(!gameStart){
        gameValueSet();
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
        //let theta = Math.atan2(dy, dx);
        //this.angle = theta;
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
//ballons
const ballonsArray = [];
const ballonImage = new Image();
var ballonColor = 0;
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
        switch(this.imgValue){
            case 1:
                ballonImage.src = '1.png';
                break;
            case 2:
                ballonImage.src = '2.png';
                break;
            case 3:
                ballonImage.src = '3.png';
                break;
            case 0:
                ballonImage.src = '4.png';
        }
        ctx.drawImage(ballonImage, this.x - 48, this.y - 40, this.radius * 2.6, this.radius * 2.6);
    }
}
const ballonPop1 = document.createElement('audio');
ballonPop1.src = 'pop.mpeg';
function handleBallons() {
    if (!(gameFrame % difficulty)) {//difficulty
        ballonsArray.push(new Bubble(ballonColor++));
        ballonColor = ballonColor % 4;
    }
    for (let i = 0; i < ballonsArray.length; i++) {
        if (ballonsArray[i].y < 0 - ballonsArray[i].radius * 2) {
            ballonsArray.splice(i, 1);
            life--;
            i--;
        }
        else if (ballonsArray[i].distance < ballonsArray[i].radius + player.radius) {
            if (!ballonsArray[i].counted) {
                ballonPop1.play();
                score++;
                if(!(score%10))
                    difficulty--;
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
//repeating background
const background = new Image();
background.src = 'background1.png';
function handleBackground() {
    ctx.drawImage(background, 0, 0, canvas.width, canvas.height);
}
//game-over
function gameOver(){//gameOver//////////////
    for (let i = 0; i < ballonsArray.length; i++)
        ballonsArray.splice(i, 1);
    ctx.fillText("Game Over:"+score,450,250);
    ctx.fillText("Click to Play Again",390,300);
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
    ctx.fillStyle='black';
    ctx.fillText('score: ' + score, 10, 490);
    ctx.fillText('Life: ' + life, 1020, 490);
    gameFrame++;
    if(life)
    requestAnimationFrame(animate);
    else
    gameOver();
}
animate();
window.addEventListener('resize', function () {
    canvasPosition = canvas.getBoundingClientRect();
})
</script>