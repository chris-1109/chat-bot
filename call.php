<?php
$text = $_GET['text'];
$max = $_GET['max'];
$conn = mysqli_connect('localhost','root','','bot');

$result = mysqli_query($conn,"select * from relation");             
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    if(strpos($text,$row['name'])!==false || strpos($text,$row['relation'])!==false){
        $skype = $row['skype'];
        if($skype==''){$skype = '+91'.$row['phone'];}
    break;}
    else{$skype='';}
}}


echo $skype;
?>


skype:+919494229550?call

skype:username?call

skype:username1;username2?call

skype:live:happy5378?chat

skype:username1;username2?call