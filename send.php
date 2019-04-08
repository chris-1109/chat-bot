<!DOCTYPE HTML>
<head><title>Mail details</title>
<style>
    .seperate{
        padding: 10px;
        width: 20%;
        border-radius: 15px;
        outline: inherit;
    }
    body {background-color: aliceblue;}
    </style>
</head>


<?php
$sub='message';
$text = $_GET['text'];
$max = $_GET['max'];
$conn = mysqli_connect('localhost','root','','bot');

$result = mysqli_query($conn,"select * from relation");             
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    if(strpos($text,$row['name'])!==false || strpos($text,$row['relation'])!==false){
        if(strpos($text,'mail')!==false){
        $mail = $row['mail'];}
        else{$mail=$row['phone'];}
    break;}
    else{$mail='';}
}}


echo "<center><br><br><br><br><form method='POST' action='mailsender.php'>";

if(strpos($text,'mail')!==false){
    if($mail==''){
    echo '<br><br>Enter the mail Id&emsp;&emsp;<input list="mail" name="browser" class="seperate" required autocomplete="off" type="email">
<datalist id="mail" class="seperate">';
  $result = mysqli_query($conn,"select * from relation");
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        echo '<option value="'.$row["mail"].'">';}}
  echo '</datalist>';
        echo "<br><br>Enter the subject for the mail&emsp;&emsp;<input type='text' name='sub' class='seperate' required autocomplete='off'>";
    echo "<br><br>Enter the message&emsp;&emsp;<textarea type='text' name='body' class='seperate' required autocomplete='off'></textarea>";}
else{
    echo "<br><br><input type='text' name='mail' value='$mail' hidden class='seperate' autocomplete='off'>";
    echo "<br><br>Enter the subject for the mail&emsp;&emsp;<input type='text' name='sub' class='seperate' required autocomplete='off'>";
    echo "<br><br>Enter the message&emsp;&emsp;<textarea type='text' name='body' class='seperate' required autocomplete='off'></textarea>";}}

else{
    if($mail==''){
    echo '<br><br>Enter the phone no&emsp;&emsp;<input list="mail" name="browser" class="seperate" required autocomplete="off">
<datalist id="mail" class="seperate">';
  $result = mysqli_query($conn,"select * from relation");
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        echo '<option value="'.$row["phone"].'">';}}
  echo '</datalist>';
        
    echo "<br><br><input type='text' name='sub' value='$sub' hidden class='seperate' required autocomplete='off'>";
    echo "<br><br>Enter the message&emsp;&emsp;<textarea type='text' name='body' class='seperate' required autocomplete='off'></textarea>";}
    
else{echo "<br><br><input type='text' name='mail' value='$mail' hidden class='seperate' required autocomplete='off'>";
    echo "<br><br><input type='text' name='sub' value='$sub' hidden class='seperate' required autocomplete='off'>";
    echo "<br><br>Enter the message&emsp;&emsp;<textarea type='text' name='body' class='seperate' required autocomplete='off'></textarea>";}}

    echo "<input type='text' name='max' value='$max' hidden class='seperate' required autocomplete='off'>";
    echo "<br><br><br><input type='submit' value='DONE' class='seperate'></form></center";


?>