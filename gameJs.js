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
    }
    })

window.addEventListener('resize', function () {
    canvasPosition = canvas.getBoundingClientRect();
    canvas.width = screen.width-30;
    canvas.height = screen.height-280;
})