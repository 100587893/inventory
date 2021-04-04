<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  require_once "../vendor/autoload.php";

  $mail = new PHPMailer(true);

  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->Host = "smtp.office365.com";
  $mail->SMTPAuth = true;
  $mail->Username = "inventory@projecttest.ca";
  $mail->Password = "Project2021";
  $mail->Port = 587;

  $mail->setFrom("inventory@projecttest.ca", "Inventory Management");
?>