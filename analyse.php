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
        break;}
        
        
    
    case 'call': {
        mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        break;}
        
        
    
    case 'send': { mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        break;}
    
        
    
    case 'directions': { 
        $display="<script>window.open('https://maps.google.com');</script>you can view your directions in this site";
        mysqli_query($conn,"insert into message values('$display','dis',$max+2)");
        break;}
        
    
    
    case 'remind': { mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        break;}
        
    
    
    case 'play': {
        header('location: youtube.php?text='.$text.'&max='.$max);
        break;}
    
        
    
    case 'joke': { mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        break;}
    
        
    
    case 'photo': { mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");
        break;}
    
        
    
    case 'new':{ 
        $display='<br><iframe src="https://timesofindia.indiatimes.com/home/headlines" width="800" height="400"></iframe>';
        mysqli_query($conn,"insert into message values('$display','dis',$max+2)");
        break;}
        
    
    
    case 'toss': {
        if(rand(0,1)==1){
            mysqli_query($conn,"insert into message values('You got Heads','sent',$max+2)");}
        else{mysqli_query($conn,"insert into message values('You got tails','sent',$max+2)");}
        break;}
        
    
    
    case 'roll': {
        if(strpos($text,'dice') !== false){
            $roll=rand(1,6);
            mysqli_query($conn,"insert into message values('You got $roll','sent',$max+2)");
        }break;}
        
    
    
    case 'clean': {
        if(strpos($text,'report') !== false){mysqli_query($conn,"delete from report");
            mysqli_query($conn,"insert into message values('Report is cleaned','sent',$max+2)");}
        else{mysqli_query($conn,"delete from message");}
        break;}
    
    
        
    case 'report': {
        $min=$max-4;
        $result = mysqli_query($conn,"select * from message limit $min,$max");
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $sentence=$row['sentence'];
        $type=$row['type'];
        mysqli_query($conn,"insert into report values('$sentence','$type')");}
        mysqli_query($conn,"insert into report values('---','----')");
        mysqli_query($conn,"insert into message values('Sussefully reported<br>we are sorry for the inconvenienece','sent',$max+2)");
        break;}
    
        
    
    case 'repeat': {
        $rep=$max-2;
        $result = mysqli_query($conn,"select * from message limit $rep,$rep");
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $text=$row['sentence'];
        $k=0;
        break;}
    
        
    
    case 'know': {  
        if(strpos($text,'me') !== false){mysqli_query($conn,"insert into message values('you are my developer','sent',$max+2)");}
        else{
        mysqli_query($conn,"insert into message values('my developers are still working on it','sent',$max+2)");}
        break;}
    
    case 'thank': {
        mysqli_query($conn,"insert into message values('I am glad that you have a good experience','sent',$max+2)");
        break;}    
    
    default: {
        $min=$max-4;
        $result = mysqli_query($conn,"select * from message limit $min,$max");
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $sentence=$row['sentence'];
        $type=$row['type'];
        mysqli_query($conn,"insert into report values('$sentence','$type')");}
        mysqli_query($conn,"insert into report values('---','----')");
        mysqli_query($conn,"insert into message values('i did not understand','sent',$max+2)");
        echo $max;$k=1;}
}}
if($key!='play'){
header('location: index.php');}
?>