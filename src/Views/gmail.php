<?php
namespace Admin\Nhom4\Views;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../../vendor/autoload.php';
function guiEmail($toEmail, $subject, $content) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dvkhiem-cntt17@tdu.edu.vn';   // 👈 thay bằng Gmail của bạn
        $mail->Password   = 'ggxa bstd nuai hpvf';      // 👈 App password (không phải mật khẩu Gmail)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        // ✅ Thêm 2 dòng này để hiển thị đúng tiếng Việt
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->setFrom('dvkhiem-cntt17@tdu.edu.vn', 'Hệ thống bán hàng online!');
        $mail->addAddress($toEmail);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Lỗi gửi mail: " . $mail->ErrorInfo);
        return false;
    }
}
