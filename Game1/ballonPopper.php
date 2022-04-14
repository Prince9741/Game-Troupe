<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Troupe Login</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
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
            width: 1200px;
            height: 500px;
            border: 2px solid white;
            background-color: rgb(38 63 76 / 67%);
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
        <div><a href="../index.php" class="button">Home</a></div>
    </footer>
</body>

</html>
<script>//canvas setup
    const canvas=document.getElementById('canvas1');
    const ctx=canvas.getContext('2d');
    canvas.width=1200;
    canvas.height=500;
    let score=0;
    let gameFrame=0;
    let difficulty=50;//descrease to increase the density;
    let fishSpeed=5;//descrease to increase the speed;
    let bubbleSpeed=1;//increase to increase the speed
    let life=10;
    ctx.font='50px Georgia';
    
    //Mouse Interactivtivity
    let canvasPosition=canvas.getBoundingClientRect();
    const mouse={
    x:canvas.width/2,
    y:canvas.height/2,
    click:false
    }
    canvas.addEventListener('mousedown',function(event){
        mouse.click=true;
        mouse.x=event.x-canvasPosition.left;
        mouse.y=event.y-canvasPosition.top;
    });
    canvas.addEventListener('mouseup',function(event){
        mouse.click=false;
        //mouse.x=event.x-canvasPosition.left;
        //mouse.y=event.y-canvasPosition.top;
    });
    
    //player
    class Player{
        constructor(){
            this.x=canvas.width;
            this.y=canvas.height/2;
            this.radius=30;
            this.angle=0;
            this.frameX=0;
            this.frameY=0;
            this.freame=0; 
            this.spriteWidth=500;
            this.spriteHeight=500;
        }
        update(){
            const dx=this.x-mouse.x;
            const dy=this.y-mouse.y;
            if(mouse.x!=this.x)
                this.x-=dx/fishSpeed;//fish speed
    
            if(mouse.y!=this.y)
                this.y-=dy/fishSpeed;//fish speed
            
        }
        draw(){
            if(mouse.click){
                ctx.lineWidth=0.2;
                ctx.beginPath();
                ctx.moveTo(this.x,this.y);
                //ctx.lineTo(mouse.x,mouse.y);
                ctx.stroke();
            }
            ctx.fillStyle='green';
            ctx.beginPath();
            ctx.arc(this.x,this.y,this.radius,0,Math.PI*2);
            ctx.fill();
            ctx.closePath();
        }
    }
    //bubbles
    const bubblesArray=[];
    class Bubble{
        constructor(){
            this.x=Math.random()*canvas.width;
            //this.radius=Math.random()<=0.5?Math.random()<=0.5?25:30:Math.random()<=0.5?50:40;//bubbleSize
            this.radius=Math.random()*15+30;
            this.y=canvas.height+this.radius;
            this.speed=Math.random()*5+bubbleSpeed;
            this.distance;
            this.counted=false;
            this.sound=Math.random()<=0.5?'sound1':'sound2';
        }
        update(){
            this.y-=this.speed;
            const dx=this.x-player.x;
            const dy=this.y-player.y;
            this.distance=Math.sqrt(dx*dx+dy*dy);
        }
        draw(){
            ctx.fillStyle='blue';
            ctx.beginPath();
            ctx.arc(this.x,this.y,this.radius,0,Math.PI*2);
            ctx.fill();
            ctx.closePath();
            ctx.stroke();
        }
    }
    
    const player=new Player();
    function handleBubbles(){
        if(gameFrame%difficulty==0){//difficulty
            bubblesArray.push(new Bubble());
        }
        for(let i=0;i<bubblesArray.length;i++){
            bubblesArray[i].update();
            bubblesArray[i].draw();
        }
        for(let i=0;i<bubblesArray.length;i++){
            if(bubblesArray[i].y < 0 - bubblesArray[i].radius*2){
                bubblesArray.splice(i,1);
                life--;
            }
            if(bubblesArray[i].distance < bubblesArray[i].radius+player.radius){
                if(!bubblesArray[i].counted){
                    score++;
                    bubblesArray[i].counted=true;
                    bubblesArray.splice(i,1);
                }
            }
        }
    }
    
    //Animation
    function animate(){
        ctx.clearRect(0,0,canvas.width,canvas.height);
        handleBubbles();
        player.update();
        player.draw();
        ctx.fillStyle='black';
        ctx.fillText('score: '+score,10,50,"white");
        ctx.fillText('Life: '+life,1000,50);
        gameFrame++;
        requestAnimationFrame(animate);
    }
    animate();
    </script>