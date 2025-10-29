<?php
namespace Admin\Bai01QuanlySv\Controllers;
require_once __DIR__ . '/../auth.php';
use Admin\Bai01QuanlySv\Models\ContactModel;
use Admin\Bai01QuanlySv\Database;

class ContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new ContactModel();
    }

    // Hiển thị form liên hệ
    public function form() {
        require_once __DIR__ . '/../auth.php';
        require_once __DIR__ . '/../../views/contact_form.php';
    }

    // Xử lý gửi form liên hệ
    public function send() {
        require_once __DIR__ . '/../auth.php';
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Validate cơ bản
        if (!$name || !$email || !$message) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!'); history.back();</script>";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Email không hợp lệ!'); history.back();</script>";
            exit;
        }

        // Lưu vào DB
        if ($this->contactModel->saveContact($name, $email, $message)) {
            echo "<script>alert('✅ Gửi liên hệ thành công!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('❌ Lỗi khi gửi liên hệ!'); history.back();</script>";
        }
    }
}
