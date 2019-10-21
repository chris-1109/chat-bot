<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp/PHPMailer/src/Exception.php';
require 'C:\xampp/PHPMailer/src/PHPMailer.php';
require 'C:\xampp/PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$conn = mysqli_connect('localhost','root','','bot');

$mailadd=$_POST['mail'];
//9494229550@sms.textlocal.in
$sub=$_POST['sub'];
$body=$_POST['body'];
$max=$_POST['max'];
mysqli_query($conn,"insert into message values('message is sent to $mailadd','sent',$max+2)");
if($sub=='message'){
    $mailadd=$mailadd."@sms.textlocal.in";}

try {
    //Server settings
    $mail->SMTPDebug = 1;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ravishankar.ch.1109@gmail.com';                     // SMTP username
    $mail->Password   = '9247396575';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ravishankar.ch.1109@gmail.com', 'chris');
    $mail->addAddress($mailadd);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $body;
    $mail->send();
    
} catch (Exception $e) {
}
header('location: index.php');
?>