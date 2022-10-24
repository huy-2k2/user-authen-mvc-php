<?php
require_once 'config/mailer_config.php';
function send_email_active_account($email, $name, $link)
{
    try {
        global $mail;
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->Subject = 'Xác nhận tài khoản User Manager';
        $mail->Body = "
        <p style='color:#f87171'>bỏ qua tài email này nếu không phải là bạn!</p>
        <p>nhấn<a href='$link'> vào đây </a>để xác thực tài khoản của bạn</p>
    ";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function send_email_active_reset($email, $name, $link)
{
    global $mail;
    try {
        $mail->addAddress($email, $name);
        $mail->Subject = 'Lấy lại mật khẩu User Manager';
        $mail->Body = "
    <p style='color:#f87171'>bỏ qua tài email này nếu không phải là bạn!</p>
    <p>nhấn<a href='$link'> vào đây </a>để lấy lại mật khẩu của bạn</p>";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
