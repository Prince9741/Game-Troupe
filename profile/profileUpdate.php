<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <link rel="stylesheet" href="profile.css">
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
            <div id="title"><a href="#">Profile</a></div>
        </nav>
    </header>
    <div class="form flex">
        <form action="profileUpdateControl.php?control=profileUpdate" method="post" class="flex" id="inputForm" enctype="multipart/form-data"> <!-- input user information -->
            <label for="pic">Profile Pic</label>
            <label for="profilePic"><img id="pic" style="border:2px solid white;border-radius:100%;" src="<?php echo $_SESSION['profilePic'];?>" height="40" width="40"></label>
            <input id="profilePic" name="profilePic" type="file" onchange="changeHiddenVal()" style="display:none"  accept=".jpg, .jpeg, .png">
            <input id="profilePicVal" name="profilePicVal" value="0" type="hidden">
            <label for="userName">User Name: <?php echo $_SESSION['userName'];?></label>
            <input id="userName" name="userName" placeholder="Update" value="<?php echo $_SESSION['userName'];?>" maxlength="20" autocomplete="off" autofocus required>
            <div class="wrapper" id="gender">
                <input type="radio" name="gen" value="0" id="male">
                <input type="radio" name="gen" value="1" id="female">
                
                <input type="radio" name="gen" value="2" id="others">
                <label for="male" class="option male flex">
                    <span>Male</span>
                </label>
                <label for="female" class="option female flex">
                    <span>Female</span>
                </label>
                <label for="others" class="option others flex">
                    <span>Others</span>
                </label>
            </div>
            <input type="hidden" id="genValue" value="<?php echo $_SESSION['gender']?>">
            <input type="submit" value="Update">
        </form>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>
    <footer class="flex" id="footer">
    <div><a href="../index.php" class="button">Home</a></div><!-- go to login up page -->
    <div class='flex'>
    <div><a href="changePassword.php" class="button">Change Password</a></div><!-- go to login up page -->
    <div><a href="profileDelete.php" class="button">Delete Profile</a></div><!-- go to login up page -->
    </div>
    </footer>
</body>
</html>
<script>
var gender=document.querySelectorAll("#gender input");
var genValue=document.getElementById("genValue").value;
for(var i=0;i<gender.length;i++){
if(gender[i].value==genValue)
gender[i].checked=true;
}
    form = document.querySelector("#profilePic");
    form.addEventListener("change", changeImage);
    function changeImage(input) {
        image =  document.getElementById("pic");
        input=input.target;
        if (input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                image.src = e.target.result;
            }
        }
    }

function changeHiddenVal(){
    profilePicVal.value=1;
}
</script>