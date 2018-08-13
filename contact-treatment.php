<?php

// if((!isset($_POST['username']) || $_POST['username'] == "") && (!isset($_POST['password']) || $_POST['password'] == "")){
//         $url = htmlspecialchars($_SERVER["PHP_SELF"]);
//         echo '<form action="'.$url.'" method="post">
//             <label for="username">username</label>
//             <input type="text" id="username" name="username"><br>
//             <label for="password">password</label>
//             <input type="password" id="password" name="password"><br>
//             <input type="submit" value="send">
//             </form>';
// }
if(file_exists('includes/auth.php')){
    include('includes/auth.php');
} else {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}

require_once('vendor/verot/class.upload.php/src/class.upload.php');

/* Sanitize and Validate contact form fields */
$title = filter_var($_POST['contact-title'], FILTER_SANITIZE_STRING);
$firstName = filter_var($_POST['contact-first-name'], FILTER_SANITIZE_STRING);
$surname = filter_var($_POST['contact-surname'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL);
if (true === filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Cette adresse email est valide.";
} else {
	echo "Cette adresse email n'est pas valide.";
}
// $email = filter_var($email, FILTER_VALIDATE_EMAIL);
$subject = filter_var($_POST['contact-subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING);
$format = filter_var($_POST['contact-format'], FILTER_SANITIZE_STRING);


/* Use upload class to handle the picture in the form */
$handle = new upload($_FILES['contact-picture']);
if ($handle->uploaded) {
    $handle->file_new_name_body   = $firstName . '-' . $surname . '-picture';
    $handle->image_resize         = true;
    $handle->image_x              = 100;
    $handle->image_ratio_y        = true;
    $handle->process('logs/pictures/');
    if ($handle->processed) {
        echo 'image resized<br>';
        echo $title . '<br>';
        echo $firstName . '<br>';
        echo $surname . '<br>';
        echo $email . '<br>';
        echo $subject . '<br>';
        echo $message . '<br>';
        echo $format . '<br>';
        $handle->clean();
    } else {
        echo 'error : ' . $handle->error;
    }
}

/* Add logs in txt file */
$my_file = 'logs/logs.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');
$data = $date . "\n";
if(isset($firstName) && isset($surname) && isset($title) && isset($email)){
    $data .= 'message from ' . $title . ' '  . $firstName . ' ' . $surname . ' (' . $email . ')';
    $data .= "\n";
}elseif(isset($firstName) && isset($surname) && isset($email)) {
    $data .= 'message from ' . $firstName . ' ' . $surname . ' (' . $email . ')';
    $data .= "\n";
}elseif(isset($email)) {
    $data .= 'message from ' . $email . "\n";
}
if(isset($subject)){
    $data .= "Concerns : \n";
    $data .= $subject . "\n";
}
if(isset($message)){
    $data .= "Message : \n";
    $data .= $message . "\n";
    $data .= "\\\\\\end of entry///\n";
}
$data .= "\n";
fwrite($handle, $data);
fclose($handle);

/* Send message via PHPMailer */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
// require '../vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/OAuth.php';
require 'vendor/phpmailer/phpmailer/src/POP3.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
try {
// Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $username;
//Password to use for SMTP authentication
$mail->Password = $password;
unset($_POST['password']);
//Set who the message is to be sent from
$mail->setFrom($email, $firstName . ' ' . $surname);
//Set an alternative reply-to address
// $mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('t.gribaumont@gmail.com', 'Thibault Gribaumont');
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents($message), __DIR__);
$mail->Body = $message;
//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
// echo 'logs/pictures/'.$firstName.'-'.$surname.'-picture.jpg';
$mail->addAttachment('logs/pictures/'.$firstName.'-'.$surname.'-picture.jpg');
echo '1';
// try {
//     echo '2';
    $mail->send();
echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
// send the message, check for errors
// if(!$mail->send()) {
//     echo '2';
//     echo "Mailer Error: " . $mail->ErrorInfo;
// } else {
//     echo '3';
//     echo "Message sent!";
// }
unset($mail);




/* Redirection to contact form */
echo '<script type="text/javascript">
           window.location = "http://localhost:8888/multipage-website-in-php/contact.php?messageStatus=sent"
      </script>';
die();
?>