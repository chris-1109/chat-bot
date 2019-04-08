<!DOCTYPE HTML>
<?php
$k=0;
$text=$_POST['text'];
while($k==0){$k=1;
$key="";
$conn = mysqli_connect('localhost','root','','bot');
$result=mysqli_query($conn,"select * from message");
$max= mysqli_num_rows($result);
mysqli_query($conn,"insert into message values('$text','rec',$max+1)");
$result = mysqli_query($conn,"select * from keyref");
             
if (mysqli_num_rows($result) > 0) {
    
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    
    if(strpos($text,$row["ref"]) !== false){
    $key=$row['realkey'];
    break;}
}}
             
switch($key){
    case 'hello': {
        mysqli_query($conn,"insert into message values('Hello there','sent',$max+2)");
        header('location: index.php');
        break;}
        
        
    
    case 'call': {
        header('location: call.php?text='.$text.'&max='.$max);
        break;}
        
        
    
    case 'send': { 
        header('location: send.php?text='.$text.'&max='.$max);
        break;}
    
        
    
    case 'directions': { 
        header('location: map.php?text='.$text.'&max='.$max);
        break;}
        
    
    
    case 'remind': { 
        mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        header('location: index.php');
        break;}
        
    
    
    case 'play': {
        header('location: youtube.php?text='.$text.'&max='.$max);
        break;}
    
        
    
    case 'joke': { 
        mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        header('location: index.php');
        break;}
    
        
    
    case 'photo': { 
        mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        header('location: index.php');
        break;}
    
        
    
    case 'new':{ 
        $display='<br><iframe src="https://timesofindia.indiatimes.com/home/headlines" width="800" height="400"></iframe>';
        mysqli_query($conn,"insert into message values('$display','dis',$max+2)");
        header('location: index.php');
        break;}
        
    
    
    case 'toss': {
        if(rand(0,1)==1){
            mysqli_query($conn,"insert into message values('You got Heads','sent',$max+2)");}
        else{mysqli_query($conn,"insert into message values('You got tails','sent',$max+2)");}
        header('location: index.php');
        break;}
        
    
    
    case 'roll': {
        if(strpos($text,'dice') !== false){
            $roll=rand(1,6);
            mysqli_query($conn,"insert into message values('You got $roll','sent',$max+2)");
        }
        header('location: index.php');
        break;}
        
    
    
    case 'clean': {
        if(strpos($text,'report') !== false){mysqli_query($conn,"delete from report");
            mysqli_query($conn,"insert into message values('Report is cleaned','sent',$max+2)");}
        else{mysqli_query($conn,"delete from message");}
        header('location: index.php');
        break;}
    
    
        
    case 'report': {
        if(strpos($text,'show') !== false){
            header('location: http://localhost/phpmyadmin/sql.php?server=1&db=bot&table=report&pos=0');
        }
        else{
        $min=$max-4;
        $result = mysqli_query($conn,"select * from message limit $min,$max");
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $sentence=$row['sentence'];
        $type=$row['type'];
        mysqli_query($conn,"insert into report values('$sentence','$type')");}
        mysqli_query($conn,"insert into report values('---','----')");
        mysqli_query($conn,"insert into message values('reported, <br>we are sorry for the inconvenience','sent',$max+2)");}
        header('location: index.php');
        break;}
    
        
    
    case 'repeat': {
        $rep=$max-2;
        $result = mysqli_query($conn,"select * from message limit $rep,$rep");
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $text=$row['sentence'];
        $k=0;
        header('location: index.php');
        break;}
    
    
        
    case 'thank': {
        mysqli_query($conn,"insert into message values('I am glad that you have a good experience','sent',$max+2)");
        header('location: index.php');
        break;}    

        
    default: {
        $min=$max-4;
        $result = mysqli_query($conn,"select * from message limit $min,$max");
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $sentence=$row['sentence'];
        $type=$row['type'];
        mysqli_query($conn,"insert into report values('$sentence','$type')");}
        mysqli_query($conn,"insert into report values('---','----')");
        mysqli_query($conn,"insert into message values('I am sorry, i didn\'t get it','sent',$max+2)");
        echo $max;$k=1;
    header('location: index.php');}
}}

?>