<?php
namespace Admin\Bai01QuanlySv\Controllers;

use Admin\Bai01QuanlySv\Models\LogModel;
use Admin\Bai01QuanlySv\Database;
 // đổi đúng namespace Database của bạn

class LogController
{
    private $logModel;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->logModel = new LogModel($db);
    }

    public function index()
    {
        $logs = $this->logModel->getAll();
        $current = 'active';
        include __DIR__ . '/../../views/logs_list.php';
    }
}
