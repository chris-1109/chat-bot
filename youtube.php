<?php
$conn = mysqli_connect('localhost','root','','bot');
$text=$_GET['text'];
$max=$_GET['max'];

if(strpos($text,'music')!==false){
    $text='<div style="position:relative;width:250px;height:50px;overflow:hidden;">
<div style="position:absolute;top:-276px;left:-5px">
<iframe width="400" height="310" src="https://www.youtube.com/embed/videoseries?list=PLe_bRVLGaVw76lQ6kQfk9ppITCZBSAIa_&index=2&autoplay=1"></iframe>
</div>
</div>';}

else if(strpos($text,'list')!==false){
    
}

else{
$text=substr($text,strpos($text,'play')+5,strlen($text));
while(strpos($text,' ')!==false){
    $pos=strpos($text,' ');
    $len=strlen($text);
    $text=substr($text,0,$pos).'+'.substr($text,$pos+1,$len);
}

$search=$text;
$url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q='.$search.'&key=AIzaSyADbP0UcY9TzynSrudRxfARQ06Rh56ElVg';
$data = file_get_contents($url);
$wizards = json_decode($data, true);
$part = $wizards['items'][0]['id']['videoId'];
$text='<br><iframe width="800" height="400" src="https://www.youtube.com/embed/'.$part.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

mysqli_query($conn,"insert into message values('$text','dis',$max+2)");

header('location: index.php');

?>