<?php
require_once('vendor/verot/class.upload.php/src/class.upload.php');
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

$handle = new upload($_FILES['contact-picture']);
// var_dump($handle);
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

$my_file = 'logs/logs.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');
// var_dump($date);
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
    $data .= 'Concerns : ' . $subject . "\n";
}
if(isset($message)){
    $data .= $message . "\n";
}
$data .= "\n";
fwrite($handle, $data);
fclose($handle);
echo '<script type="text/javascript">
           window.location = "http://localhost:8888/multipage-website-in-php/contact.php?messageStatus=sent"
      </script>';
die();
?>