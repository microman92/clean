<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$data = "Ф.И.О"
$tel = "Номер телефона"
$comment = "Комментарии"

$title = "Заголовок письма";
$body = "";
foreach ( $_POST as $key => $value ) {
  if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
    $body .= "
    " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
      <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
      <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
    </tr>
    ";
  }
}

$body = "<table style='width: 100%;'>$body</table>";

$mail = new PHPMailer\PHPMailer\PHPMailer();

try {

  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;

  $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
  $mail->Username   = 'grandclean.zayavki@gmail.com'; 
  $mail->Password   = 'rviv nauw bnza bxhu';
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->setFrom('grandclean.zayavki@gmail.com', 'Заявка с вашего сайта'); 
  // Адрес самой почты и имя отправителя

   // Получатель письма
  $mail->addAddress('grandclean.zayavki@gmail.com');

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;
  
    $mail->send();

} catch (Exception $e) {
    $status = "Сообщение не было отправлено. Причина ошибки:{$mail->ErrorInfo}";
}