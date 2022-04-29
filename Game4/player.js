import { Sitting,Running, Jumping,Falling } from "./playerStates.js";

export class Player {
    constructor(game) {
        this.game = game;
        this.sWidth=100;
        this.sHeight=91.3;
        this.width =60; 
        this.height=60;
        this.y = this.game.height - this.height-this.game.groundMargin;
        this.x = this.width/3;
        this.frameY=this.vy = 0;
        this.jumpHeight=17;
        this.weight = 1;
        this.image = document.getElementById("player");
        this.frameX=0;
        this.frameY=0;
        this.maxFrame;
        this.fps=50;
        this.frameInterval=1000/this.fps;
        this.frameTimer=0;
        this.speed = 0;
        this.maxSpeed = 10;
        this.states=[new Sitting(this),new Running(this),new Jumping(this),new Falling(this)];
        this.currentState=this.states[0];
        this.currentState.enter();
  }
    update(input,deltaTime) {
        this.currentState.handeInput(input);
        //horizontal movement
        this.x += this.speed;
        if(input.includes('ArrowRight'))this.speed=this.maxSpeed;
        else if(input.includes('ArrowLeft'))this.speed=-this.maxSpeed;
        else this.speed=0;
        if(this.x<0)this.x=0;
        if(this.x>this.game.width-this.width)this.x=this.game.width-this.width;
        //vertical movement
        this.y+=this.vy;
        if(!this.onGround())this.vy+=this.weight;
        else this.vy=0;
        //sprite animation
        if(this.frameTimer>this.frameInterval){
          this.frameTimer=0;
          if(this.frameX<this.maxFrame)this.frameX++;
          else this.frameX=0;
        }else{
          this.frameTimer+=deltaTime;
        }
    }
    draw(ctx) {
      // ctx.beginPath();
      // ctx.fillStyle="red";
      // ctx.fillRect(this.x,this.y,this.width,this.height);
      // ctx.fill();
      ctx.drawImage(this.image, this.frameX * this.sWidth, this.frameY * this.sHeight, this.sWidth, this.sHeight,this.x,this.y, this.width,this.height); 
    }
    onGround() {
          return this.y>=this.game.height-this.height-this.game.groundMargin;
    }
    setState(state) {
        this.currentState=this.states[state];
        this.currentState.enter();
    }
}