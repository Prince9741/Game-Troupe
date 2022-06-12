<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:../");
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
<?php $page="Change Password"; require "../header.php";?>
    <div class="form flex">
        <form action="profileUpdateControl.php?control=changePassword" method="post" class="flex" id="inputForm"> <!-- input user information -->
                <label ><?php echo $_SESSION['userName'];?></label>
                <label for="oPwd">Old Password:</label>
                <input id="oPwd" name="oPwd" type="password" autofocus placeholder="Enter Old Password" maxlength="20" autocomplete="off" required>
                <label for="pwd">Password:</label>
                <input id="pwd" name="pwd" type="password" placeholder="Enter New Password" maxlength="20" autocomplete="off" required>
                <label for="cPwd">Confirm-Password:</label>
                <input id="cPwd" name="cPwd" type="password" placeholder="Confirm New Password" maxlength="20" autocomplete="off" required>
                <input type="submit" value="Change">
        </form>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>
    <footer class="flex" id="footer">
    <div><a href="../" class="button">Home</a></div><!-- go to login up page -->
    <div><a href="profileUpdate.php" class="button">Back</a></div><!-- go to login up page -->
    </footer>
</body>
</html>