<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$name = null; 
$email = null;
$subject = null;
$message = null;
$body = null;

if(isset($_POST['contactName']) && isset($_POST['contactEmail']) && isset($_POST['contactSubject']) && isset($_POST['contactMessage'])){
    $name = trim($_POST['contactName']);
    $email = trim($_POST['contactEmail']);
    $subject = trim($_POST['contactSubject']);
    $message = trim($_POST['contactMessage']);
    $body = "Name: ".$name."<br>Email: ".$email."<br>Subject: ".$subject."<br>Message: ".$message;
}else{
    echo 'Please fill all the required details.';
    die();
}

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp-relay.sendinblue.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'kushwahasameerkumar@gmail.com';                     // SMTP username
    $mail->Password   = 'xsmtpsib-4706581380b32793fcb383a28850191c9f19c44aa72e90c4f02d4ae7fc1a3725-Fr4jGmShJOq9573B';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('kushwahasameeerkumar@iiitg.ac.in', 'Sameer Kumar Kushwaha');
    //$mail->addAddress('221010amank@gmail.com', 'Aman Singh');     // Add a recipient
    $mail->addAddress('kushwahasameerkumar@gmail.com', 'Sameer');               // Name is optional
    $mail->addReplyTo('kushwahasameerkumar@gmail.com', 'Sameer');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Contact Us : Home Page';
    $mail->Body    = $body;
    //$mail->msgHTML(file_get_contents('content.html'), __DIR__);
    $mail->AltBody = $body;

    $mail->send();
    echo 'success';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo "Something went wrong. Please try again.";
    die();
}