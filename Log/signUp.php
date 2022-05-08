<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Troupe Sign up</title>
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
            <div id="title"><a href="#">Sign Up</a></div>
        </nav>
    </header>
    <div class="form flex">
        <form action="signUpControl.php" onSubmit = "return validateUserName(this)" method="post" class="flex" id="inputForm"> <!-- input user information -->
                <label for="userName">User Name:</label>
                <input id="userName" name="userName" placeholder="Enter user name" autocomplete="off" autofocus required>
                
                <div class="wrapper">
                <input type="radio" name="gen" value="0" id="male" checked>
                <input type="radio" name="gen" value="1" id="female">
                <input type="radio" name="gen" value="2" id="others">
                    <label for="male" class="option male flex">
                        <div class="dot"></div>
                        <span>Male</span>
                    </label>
                    <label for="female" class="option female flex">
                        <div class="dot"></div>
                        <span>Female</span>
                    </label>
                    <label for="others" class="option others flex">
                        <div class="dot"></div>
                        <span>Others</span>
                    </label>
                </div>

                <label for="pwd">Password:</label>
                <input id="pwd" name="pwd" type="password" placeholder="Enter Password"  maxlength="20" autocomplete="off" required>
                <label for="cPwd">Confirm-Password:</label>
                <input id="cPwd" name="cPwd" type="password" placeholder="Confirm Password"  maxlength="20" autocomplete="off" required>
                <input type="submit" value="Register">
            
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
        <div><a href="logIn.php" class="button">Login</a></div><!-- go to login up page -->
    </footer>
</body>
</html>
<script>
     // Function to check Whether username valid or not
    function validateUserName(form) {
        userName = form.userName.value;
        if(userName.length>20){
            alert("UserName Should be less than 20 letters");
                return false; 
        }
        if(!/^[0-9a-zA-Z_.-]+$/.test(userName)){
            alert("Space or Special character not allowed in UserName");
            return false;
        }
        return true;
    }
    </script>