<?php
$text = $_GET['text'];
$max = $_GET['max'];
$conn = mysqli_connect('localhost','root','','bot');
$skype='';
$result = mysqli_query($conn,"select * from relation");             
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    if(strpos($text,$row['name'])!==false || strpos($text,$row['relation'])!==false){
        if(strpos($text,'&')!==false || strpos($text,'and')!==false || strpos($text,',')!==false || strpos($text,'group')!==false){
        if($row['skype']==''){$skype = $skype.';+91'.$row['phone'];}
        else{$skype = $skype.';'.$row['skype'];}}
        
        else{
        $skype = $row['skype'];
        if($skype==''){$skype = '+91'.$row['phone'];}
        break;}}
    else{$skype='';}
}}

if($skype!=''){
if(strpos($text,'call')!==false){
header('location: skype:'.$skype.'?call');}
else if(strpos($text,'chat')!==false || strpos($text,'skype')!==false){
    header('location: skype:'.$skype.'?chat');}}
else{mysqli_query($conn,"insert into message values('cannot find the contact','sent',$max+2)");
        header('location: index.php');}
echo $skype;
?>