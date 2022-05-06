<?php
function game1(){
    echo "1. Click on the screen to move, the star to pop ballons, before they reach the roof</br>
    2. Use Space button to Pause/Play";
}
function game2(){
    echo "1. Move the mouse to move the space shuttle, to avoid asteroid and colled plasma energy</br>
    2. Use Space button to Pause/Play";
}
function game3(){
    echo "1. In this Puzzle, Which square you click, it alter into diamond or square 
    and also into color</br>
    2.there can be only one red shape</br>
    3. Use Space button to reset
    ";
}
function game4(){
    echo "1. Click or use movement keys, to jump or control the runner and avoid obsticles</br>
    2. Use Space button to Pause/Play";
}
function game5(){
    echo "1. Click on the screen to jump the bird and avoid obsitcles</br>
    2. Use Space button to Pause/Play";
}
if(isset($_GET['gameId']))
switch($_GET['gameId']){
    case 1:
        game1();
    break;
    case 2:
        game2();
    break;
    case 3:
        game3();
    break;
    case 4:
        game4();
    break;
    case 5:
        game5();
    break;
}

?>