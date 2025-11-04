<?php
<<<<<<< HEAD
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * 📧 Gửi email qua Gmail SMTP
 * @param string $toEmail  Email người nhận
 * @param string $subject  Tiêu đề email
 * @param string $content  Nội dung HTML
 * @return bool
 */
function guiEmail($toEmail, $subject, $content): bool {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // ⚠️ Dùng App Password (không dùng mật khẩu Gmail thật)
        $mail->Username   = 'dvkhiem-cntt17@tdu.edu.vn';
        $mail->Password   = 'ggxa bstd nuai hpvf'; // Mã ứng dụng Gmail (App Password)

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Cấu hình tiếng Việt + HTML
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->isHTML(true);

        // Thông tin người gửi & người nhận
        $mail->setFrom('dvkhiem-cntt17@tdu.edu.vn', 'Hệ thống bán hàng Online');
        $mail->addAddress($toEmail);

        // Tiêu đề & nội dung
        $mail->Subject = $subject;
        $mail->Body    = $content;

        // Gửi mail
        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("❌ Lỗi gửi email tới $toEmail: " . $mail->ErrorInfo);
=======
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
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        return false;
    }
}
