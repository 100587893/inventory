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
  $mail->Username = "oxfordphptest@outlook.com";
  $mail->Password = "Futica670";
  $mail->Port = 587;

  $mail->setFrom("oxfordphptest@outlook.com", "Oxford Test");

  // $mail->From = "oxfordphptest@outlook.com";
  // $mail->FromName = "Oxford Test";
?>
