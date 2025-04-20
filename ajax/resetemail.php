<?php
require 'C:\xampp\htdocs\Project-Management-Software-master\classes\PHPMailer\class.phpmailer.php'; // Укажите правильный путь к файлу
require 'C:\xampp\htdocs\Project-Management-Software-master\classes\PHPMailer\class.smtp.php';

$mail = new PHPMailer();

if(isset($_POST['email'])) {
    $result = $this->emailChange($_POST['email']);
    if($result === false) {
        echo $this->lang_php['email_not_found'] . '!';
    } else {
        $url = base_url('login?reset_code=' . $result);
        $to = $_POST['email'];
        $subject = 'Password reset from ' . base_url();
        $message = "Your password reset link is \n $url";

        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP-сервер
        $mail->SMTPAuth = true;
        $mail->Username = 'makhlaevvip@gmail.com'; // Ваш email
        $mail->Password = 'fend hesf vmye ajix'; // Пароль приложения
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Настройки отправителя и получателя
        $mail->setFrom('makhlaevvip@gmail.com', 'Admin');
        $mail->addAddress($to);

        // Содержимое письма
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Отправка
        if($mail->send()) {
            echo $this->lang_php['email_reset'] . '!';
        } else {
            echo $this->lang_php['email_reset_err'] . " Error: " . $mail->ErrorInfo;
        }
    }
}
?>
