<?php
session_start();
$log=isset($_SESSION['loggedin']);
if($log)
    header("location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Troupe Login</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
        <nav class="flex" id="navbar">
            <span class="flex">
                <!--go to highScore page -->    
                <div id="game"><a href="#">Game</a></div>
                <div class=""><a href="#"><img src="../images/logo.png"></a></div>
                <div id="troupe"><a href="#">Troupe</a></div>
            </span>
            <div id="title"><a href="#">Login</a></div>
        </nav>
    </header>
    <div class="form flex">
        <form action="logInControl.php" method="post" class="flex" id="inputForm">
            <!-- Input authoriezed user informations -->
            <label for="userName">Username:</label>
            <input id="userName" <?php
        if(isset($_SESSION['userNameLog'])){
            echo $_SESSION['userNameLog'];
            unset($_SESSION['userNameLog']);
        }
        ?>  name="userName" maxlength="20" placeholder="Enter user name" autofocus required>
            <label for="pwd">Password:</label>
            <input id="pwd" name="pwd" type="password" <?php
        if(isset($_SESSION['pwd'])){
            echo $_SESSION['pwd'];
            unset($_SESSION['pwd']);
        }
        ?>  placeholder="Enter Password" autocomplete="off" required>
            <input type="submit" value="Start" id="submit">
        </form>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../highScore/highScorePage.php" class="button">Scores</a></div>
        <!--go to highScore page -->
        <div><a href="signUp.php" class="button">Sign Up</a></div><!-- go to signup page -->
    </footer>
</body>

</html>