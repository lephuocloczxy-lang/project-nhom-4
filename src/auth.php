<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /bai01_quanly_sv/public/index.php?action=login");
    exit;
}
