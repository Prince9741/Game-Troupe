<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Troupe Login</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../head-foot.css">
</head>

<body>
    <header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="../images/logo.png"></a></div>
            <!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
    <div class="form flex">
        <form action="logInControl.php" method="post" class="flex" id="inputForm">
            <!-- Input authoriezed user informations -->
            <label for="username">Username:</label>
            <input id="username" name="username" maxlength="20" placeholder="Enter user name" autofocus required>
            <label for="pwd">Password:</label>
            <input id="pwd" name="pwd" type="password" placeholder="Enter Password" autocomplete="off" required>
            <input type="submit" value="Start">
        </form>
        <?php
        if(isset($_GET['msg']))
            echo '<div class="msg ">'.$_GET['msg'].'</div>';
        ?>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../highScore/highScorePage.php" class="button">High Scores</a></div>
        <!--go to highScore page -->
        <div><a href="signUp.php" class="button">Sign Up</a></div><!-- go to signup page -->
    </footer>
</body>

</html>