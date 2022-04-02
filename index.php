<?php
session_start();
if(isset($_SESSION['loggedin'])){
switch($_SESSION['gender']){
    case 0:
        echo "<div style='color:blue'>Welcome ".$_SESSION['username']."</div>"; 
        break;  
    case 1:
        echo "<div style='color:pink'>Welcome ".$_SESSION['username']."</div>";    
        break;
    case 2:
        echo "<div style='color:grey'>Welcome ".$_SESSION['username']."</div>";    
}
echo '<div class="button"><a href="log/logOut.php">Log Out</a></div>';
}
else
    header("location:log/logIn.html");//login page if not login

?>
