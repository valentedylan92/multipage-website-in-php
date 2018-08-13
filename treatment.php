<?php
$gender = $_POST['contact-gender'];
$name = filter_var($_POST['contact-first-name'],FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['contact-last-name'],FILTER_SANITIZE_STRING);
$email = filter_var($_POST['contact-email'],FILTER_SANITIZE_EMAIL);
$subject = $_POST['contact-subject'];
$message = $_POST['contact-message'];
$format = $_POST['contact-format'];

echo $gender.' '.$name.' '.$lastName.' '.$email.' '.$subject.' '.$message.' '.$format

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
?>
