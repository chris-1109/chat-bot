<!DOCTYPE HTML>

<html>
    <head><title>
            SMART CHATBOT
          </title>
    <link rel="stylesheet" href="bot.css">
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    
    </head>
<body>
    <center>
<div id="chat">
        <h1>SMART  CHAT  BOT</h1>
    <br><br>
    <?php
    $conn = mysqli_connect('localhost','root','','bot');
    $result = mysqli_query($conn,"SELECT * from message");
    $max= mysqli_num_rows($result)-1;
    $bimg = "<image src='bimg.jpg' class='pic' width='50px'>";
    $bimg2 = "<image src='uimg.png' class='pic2' width='50px'>";
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($row['type']=='rec'){
                echo"<br><br><br><br><div class='rec'>".$row['sentence'].$bimg2."<br></div>";
            }
            else if($row['type']=='sent'){
                    echo"<br><br><br><br><div class='sent'>".$bimg.$row['sentence']."<br></div>";
                $speak=$row['sentence'];
                if($row['id']>$max){
                        echo '<script>responsiveVoice.speak("'.$speak.'");</script>';
                        }
            }
            else{
                echo"<br><br><br><br><br><div class='sent'>".$bimg.$row['sentence']."<br></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            }
        }
        
    } else {
	   echo "<div class='sent'>Hii".$bimg."</div><br><br><br><br><div class='sent'>I am chitti the chatbot !".$bimg."</div><br><br><br><br><div class='sent'>i am your friendly neighbourhood bot".$bimg."</div><br><br><br><br><div class='sent'>you can ask me any question and i will try to answer it".$bimg."</div><br><br><br><br><div class='sent'>Let's try:".$bimg."</div>";
    }
    ?>
    
    
    <div id="action"></div><br><br><br><br>
    <form action="analyse.php" method="post">
    <input type="text" name="text" id="text" autocomplete="off" spellcheck="false" autofocus>&nbsp;&nbsp;&nbsp;&nbsp;
    <button><img src="send.jpg" width="35px"></button>
    </form>
</div>    </center>
    <script>
        window.scrollTo(0,document.body.scrollHeight);
    document.getElementById("action").innerHTML = "" 
    document.getElementById("text").value = "";
    </script>
    </body>
</html>