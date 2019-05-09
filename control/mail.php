<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

$address = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$checkbox = $_POST['checkbox'];

$HTML5content = "<p>This is an e-mail from <br>Name: {$name}<br>Email: {$address}<br>Phone: {$phone}<br>That marked the checkbox as {$checkbox}</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>";
$rawContent = "This is an email from {$name}, {$address}, {$phone}. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'smtpalexoliveira@gmail.com';                     // SMTP username
    $mail->Password   = 'smtpalex';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    
    //Recipients
    $mail->setFrom('no-reply@gmail.com', 'No reply');
    $mail->addAddress($address);     // Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'No reply');
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Confirmation e-mail from {$name}";
    $mail->Body    = $HTML5content;
    $mail->AltBody = $rawContent;
    
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}