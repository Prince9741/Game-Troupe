<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <script src="../allFileJs.js"></script>
    <style>
      .container {
            top: 16vh;
            position: fixed;
            width: 100%;
            flex-direction: column;
        }
        
        #control{
            display: grid;
            text-align: center;
            grid-column-gap: 20px;
            grid-row-gap:40px;
            grid-template-columns:repeat(3,auto);

        }
        #control div img{
            height: 120px;
            border-radius: 10px;
            border:3px solid var(--tColor);
        }
        #control div img[class="active"]{
            box-shadow:0px 0px 15px 5px skyblue;
        }
        .data{
            box-shadow:0px 0px 50px 15px black;
            border-radius: 20px;
            padding: 5px;
        }
        
        .data tr{
            color: var(--tColor);
            font-family: cursive;
        }
        .data td{
            text-align: center;
            border-radius: 40%;
            border-bottom: 2px solid var(--tColor);
            padding: 5px 10px;
            font-size: 1.8em;
        }
        .others td{
            border-bottom: 2px solid green;
        }
        .female td{
            border-bottom: 2px solid red;
        }
        
        @media (max-width:700px){
            #control{
            grid-column-gap: 10px;
            grid-row-gap:20px;
            }
            #control div img{
                height: 80px;
            }
            .data td{
                padding: 2px 5px;
                font-size: 1.5em;
            }
        }
        @media (max-width:500px){
            #control{
            grid-column-gap: 5px;
            grid-row-gap:10px;
            }
            #control div img{
                height: 70px;
            }
            .data td{
                font-size: 1.3em;
            }
        }
        
     </style>
</head>

<body>
    <header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="../images/logo.png"></a></div>
            <!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
    
    <div class="container flex">
        <div id="control">
            <div id="game1" onclick="currentGame(0,1)"><img src="../images/Game1.png" alt="game"></div>
            <div id="game2" onclick="currentGame(1,2)"><img class="active" src="../images/logo.png" alt="game"></div>
            <div id="game3" onclick="currentGame(2,3)"><img src="../images/Game1.png" alt="game"></div>
            <div id="game4" onclick="currentGame(3,4)"><img src="../images/logo.png" alt="game"></div>
            <div class="data flex">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Score</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody id="dataContent">
                           <?php require "highScore.php"?>
                    </tbody>
                </table>
            </div>
            <div id="game5" onclick="currentGame(5,5)"><img src="../images/logo.png" alt="game"></div>
        </div>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../log/signUp.html" class="button">Sign Up</a></div>
        <!--go to highScore page -->
        <div><a href="../log/logIn.html" class="button">Login</a></div><!-- go to login up page -->
    </footer>
</body>

</html>
<script>
    var active=1;
    var img=document.querySelector("#control").children;

    function currentGame(nextLoc,gameId){
    console.log("Data Update Game no."+gameId);
    img[active].firstChild.classList.remove("active");
    img[nextLoc].firstChild.classList.add("active");
    active=nextLoc;
    url = "highScore.php?gameId=" + gameId;
    loadDoc(url, "dataContent");
    }
</script>
</script> 
