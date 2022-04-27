//import { Sitting } from "./playerStates";

export class Player {
    constructor(game) {
        this.game = game;
        this.sWidth=this.width = 100;
        this.sHeight=this.height = 91.3;
        this.x = 0;
        this.y = this.game.height - this.height;
        this.vy = 0;
        this.weight = 1;
        this.image = document.getElementById("player");
          this.frameX=0;
          this.frameY=0;
        this.speed = 0;
        this.maxSpeed = 10;
        //   this.states=[new Sitting(this)];
        //   this.currentState=this.states[0];
        //   this.currentState.enter();
    }
    update(input) {
        //   this.currentState.handeInput(input);
        this.x += this.speed;
        //horizontal movement
          if(input.includes('ArrowRight'))this.speed=this.maxSpeed;
          else if(input.includes('ArrowLeft'))this.speed=-this.maxSpeed;
          else this.speed=0;
           if(this.x<0)this.x=0;
           if(this.x>this.game.width-this.width)this.x=this.game.width-this.width;
        //vertical movement
        if(input.includes('ArrowUp')&&this.onGround())this.vy-=20;
          this.y+=this.vy;
        if(!this.onGround())this.vy+=this.weight;
        else this.vy=0;
        // if (input.includes('ArrowRight')) this.x++;
        // else if (input.includes('ArrowLeft')) this.x--;
        //update Image
        
        if(this.frameX<6)
            this.frameX++;
        else
            this.frameX=0;
    }
    draw(context) {
       context.drawImage(this.image, this.frameX * this.sWidth, this.frameY * this.sHeight, this.sWidth, this.sHeight,this.x,this.y, this.sWidth,this.sHeight); 
    }
    onGround() {
          return this.y>=this.game.height-this.height;
    }
    setState(state) {
        // this.currentState=this.states[state];
        // this.currentState.enter();
    }
}