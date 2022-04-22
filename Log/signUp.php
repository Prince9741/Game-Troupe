<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Troupe Sign up</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../head-foot.css">
</head>
<body>
    <header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="../images/logo.png"></a></div><!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
    <div class="form flex">
        <form action="signUpControl.php" method="post" class="flex" id="inputForm"> <!-- input user information -->
                <label for="userName">User Name:</label>
                <input id="userName" name="userName" placeholder="Enter user name"  maxlength="20" autocomplete="off" autofocus required>
                
            <div>
                <label for="male">Male:</label>
                <input type="radio" name="gen" value="0" id="male" checked>
        
                <label for="female">Female:</label>
                <input type="radio" name="gen" value="1" id="female">
            
                <label for="others">Others</label>
                <input type="radio" name="gen" value="2" id="others">
            </div>
            
                <label for="pwd">Password:</label>
                <input id="pwd" name="pwd" type="password" placeholder="Enter Password"  maxlength="20" autocomplete="off" required>
                <label for="cPwd">Confirm-Password:</label>
                <input id="cPwd" name="cPwd" type="password" placeholder="Confirm Password"  maxlength="20" autocomplete="off" required>
                <input type="submit" value="Start">
            
        </form>
        <?php
        session_start();
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../highScore/highScorePage.php" class="button">Scores</a></div><!--go to highScore page -->
        <div><a href="logIn.php" class="button">Play</a></div><!-- go to login up page -->
    </footer>
</body>
</html>