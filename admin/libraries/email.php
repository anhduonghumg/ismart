<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// khởi tạo và cho phép ngoại lệ
function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $option = array())
{
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Cho phép đầu ra gỡ lỗi dài dòng
        $mail->isSMTP();                                            // Gửi bằng SMTP
        $mail->Host       = $config_email['smtp_host'];                    // Đặt máy chủ SMTP để gửi qua
        $mail->SMTPAuth   = true;                                   // Kích hoạt xác thực SMTP
        $mail->Username   = $config_email['smtp_user'];                     // SMTP tên đăng nhập
        $mail->Password   = $config_email['smtp_pass'];                                // SMTP mật khẩu
        $mail->SMTPSecure = $config_email['smtp_secure'];         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $config_email['smtp_port'];
        $mail->CharSet = 'UTF-8';                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Người nhận
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']); // Gửi đi từ
        $mail->addAddress($sent_to_email, $sent_to_fullname);     // Người nhận
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Tài liệu đính kèm
        // $mail->addAttachment('1721050511_NguyenAnhDuong_BT.docx');         // Add attachments
        // $mail->addAttachment('1721050511_NguyenAnhDuong_BT.docx', 'baitap.docx');    // Optional name

        // Nội dung
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Email không gửi được.Chi tiết lỗi: {$mail->ErrorInfo}";
    }
}
