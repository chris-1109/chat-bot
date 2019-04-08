<?php
$conn = mysqli_connect('localhost','root','','bot');
$text=$_GET['text'];
$max=$_GET['max'];
while(strpos($text,' ')!==false){
    $pos=strpos($text,' ');
    $len=strlen($text);
    $text=substr($text,0,$pos).'+'.substr($text,$pos+1,$len);
}

$search=$text;

$text='<br><iframe width="800" height="400" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/search?q='.$search.'&key=AIzaSyADbP0UcY9TzynSrudRxfARQ06Rh56ElVg" allowfullscreen></iframe>';

mysqli_query($conn,"insert into message values('$text','dis',$max+2)");

header('location: index.php');
    
    ?>