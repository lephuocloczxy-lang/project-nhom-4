<?php
// session_start();
// define('PROJECT_ROOT', dirname(__DIR__));
// require PROJECT_ROOT . '/vendor/autoload.php';

// use Admin\Bai01QuanlySv\Controllers\UserController;
// use Admin\Bai01QuanlySv\Controllers\SinhvienController;
// use Admin\Bai01QuanlySv\Controllers\ContactController;

// $action = $_GET['action'] ?? 'index';

// // Các action không cần đăng nhập
// $public_actions = ['login', 'register', 'do_login', 'do_register', 'contact', 'send_contact'];

// if (!in_array($action, $public_actions) && !isset($_SESSION['user_id'])) {
//     header('Location: index.php?action=login');
//     exit();
// }

// // 🎯 Điều hướng controller phù hợp
// switch ($action) {
//     // ===== Các action liên hệ =====
//     case 'contact':
//         $controller = new ContactController();
//         $controller->form();
//         break;

//     case 'send_contact':
//         $controller = new ContactController();
//         $controller->send();
//         break;

//     // ===== Các action người dùng =====
//     case 'login':
//         $controller = new UserController();
//         $controller->showLoginForm();
//         break;

//     case 'do_login':
//         $controller = new UserController();
//         $controller->login();
//         break;

//     case 'register':
//         $controller = new UserController();
//         $controller->showRegisterForm();
//         break;

//     case 'do_register':
//         $controller = new UserController();
//         $controller->register();
//         break;

//     case 'logout':
//         $controller = new UserController();
//         $controller->logout();
//         break;

//     // ===== Chi tiết sinh viên =====
//     case 'detail':
//         (new SinhvienController())->detail();
//         break;
//         case 'verify':
//     $email = $_GET['email'] ?? '';
//     $controller = new UserController();
//     $controller->verify($email);
//     break;
    
//     case 'change_password':
//     $controller = new UserController();
//     $controller->changePasswordForm();
//     break;

//     case 'change_password_submit':
//     $controller = new UserController();
//     $controller->changePasswordSubmit();
//     break;

//     case 'export_csv':
//     // require_once __DIR__ . '/controllers/SinhVienController.php';
//     $controller = new SinhVienController();
//     $controller->exportCSV();
//     break;
    
//     // ===== Các action sinh viên =====
//     case 'add':
//     case 'edit':
//     case 'update':
//     case 'delete':
//     case 'stats':
//     case 'index':
//     default:
//         $controller = new SinhvienController();
//         if (method_exists($controller, $action)) {
//             $controller->$action();
//         } else {
//             $controller->index();
//         }
//         break;
// }
session_start();
define('PROJECT_ROOT', dirname(__DIR__));
require PROJECT_ROOT . '/vendor/autoload.php';

use Admin\Bai01QuanlySv\Controllers\UserController;
use Admin\Bai01QuanlySv\Controllers\SinhvienController;
use Admin\Bai01QuanlySv\Controllers\ContactController;
use Admin\Bai01QuanlySv\Controllers\LogController;

// Lấy action từ URL, mặc định là 'index'
$action = $_GET['action'] ?? 'index';

// Các action không yêu cầu đăng nhập
$public_actions = ['login', 'register', 'do_login', 'do_register', 'contact', 'send_contact'];

// Kiểm tra session người dùng
if (!in_array($action, $public_actions) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit();
}

// 🎯 Điều hướng đến controller phù hợp
switch ($action) {
    // ===== Liên hệ =====
    case 'contact':
        (new ContactController())->form();
        break;

    case 'send_contact':
        (new ContactController())->send();
        break;

    // ===== Người dùng =====
    case 'login':
        (new UserController())->showLoginForm();
        break;

    case 'do_login':
        (new UserController())->login();
        break;

    case 'register':
        (new UserController())->showRegisterForm();
        break;

    case 'do_register':
        (new UserController())->register();
        break;

    case 'logout':
        (new UserController())->logout();
        break;

    // ===== Xác thực / đổi mật khẩu =====
    case 'verify':
        $email = $_GET['email'] ?? '';
        (new UserController())->verify($email);
        break;

    case 'change_password':
        (new UserController())->changePasswordForm();
        break;

    case 'change_password_submit':
        (new UserController())->changePasswordSubmit();
        break;

    // ===== Xuất CSV danh sách sinh viên =====
    case 'export_csv':
        (new SinhvienController())->exportCSV();
        break;
        
    // ===== Nhật ký hoạt động =====
   case 'active':
    (new \Admin\Bai01QuanlySv\Controllers\LogController())->index();
    break;

    // ===== Các chức năng sinh viên =====
    case 'add':
    case 'edit':
    case 'update':
    case 'delete':
    case 'stats':
    case 'index':
    default:
        $controller = new SinhvienController();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;
}
