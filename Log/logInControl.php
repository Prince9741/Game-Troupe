<?php
require "../db.php";
session_start();
if(isset($_POST['userName']) && isset($_POST['pwd'])){
    $userName=$_POST['userName'];
    $pwd=$_POST['pwd'];
    $waiTimeInSec=300;
    $waitTimeInMin=$waiTimeInSec/60;
    $waiTimeInHour=$waiTimeInSec/3600;
    $wrongPassTry=2;
    $result=$Scoring->query("SELECT * FROM `Players` WHERE `userName`='$userName'");//find the user data
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
        $currentTimeInSec=idate("U");//fetch system time in second
        $currentTime=date("Y-m-d H:i:s",$currentTimeInSec);//convert in human understanding
        if($currentTimeInSec>=(int)strtotime($rows['AfterLogin'])){
            if($rows['Password']==$pwd){//check password is correct or not
                $_SESSION['loggedin']=true;
                $_SESSION['userId']=$rows['UserId'];
                $_SESSION['userName']=$rows['UserName'];
                $_SESSION['gender']=$rows['GenderId'];//take gender value from database
                $_SESSION['profilePic']="../profilePic/".$rows['ProfilePic'];
                $sql="UPDATE `Players` SET `LoginTry` = $wrongPassTry , `AfterLogin`= '$currentTime' WHERE `userName`='$userName'";
                $Scoring->query($sql);//find the user data
                header("location:../");//send to the main page
            }
            else{
                if($rows['LoginTry']){
                    $loginTry=$rows['LoginTry'];
                    $_SESSION['msg']='<div class="msg">Wrong Password: Profile Locked after '.$loginTry--.' try</div>';//this code run when password is wrong
                    $sql="UPDATE `Players` SET `LoginTry` = $loginTry WHERE `userName`='$userName'";
                }  
                else{
                    $currentTime=date("Y-m-d H:i:s",$currentTimeInSec+$waiTimeInSec);
                    $sql="UPDATE `Players` SET `LoginTry` = $wrongPassTry, `AfterLogin`= '$currentTime' WHERE `userName`='$userName'";
                    $_SESSION['msg']='<div class="msg">Profile locked for '.$waitTimeInMin.' Min</div>';  
                }
                $Scoring->query($sql);
            }
        }
        else{
            $timeLeft=(int)strtotime($rows['AfterLogin']);
            $timeLeft=$timeLeft-$currentTimeInSec;
            $timeLeftInMin=(int)($timeLeft/60);
            $timeLeftInSec=$timeLeft%60;
            $_SESSION['msg']='<div class="msg" id="msg">Your id will unlocked after <span id="timeLeftInMin">'.$timeLeftInMin.'</span> min <span id="timeLeftInSec"> '.$timeLeftInSec.'</span> sec</div>';                
        }
        $_SESSION['userNameLog']="value='$userName'";
    }
    else{
        $_SESSION['msg']='<a href="signUp.php" class="msg"><div>'.$userName.': Register First</div></a>';//this code run when user is invalid
        $_SESSION['userNameSign']="value='$userName'";
    }
}
header("location:logIn.php");
?>
