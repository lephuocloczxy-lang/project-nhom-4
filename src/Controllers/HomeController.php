<?php
namespace Admin\Nhom4\Controllers;

<<<<<<< HEAD
use Exception;
use PDO;
use PDOException;

=======
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
class HomeController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function index() {
        try {
<<<<<<< HEAD
=======
            // Lấy dữ liệu cho trang chủ
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            $featured_products = $this->getFeaturedProducts();
            $new_products = $this->getNewProducts();
            $promotions = $this->getPromotions();
            $banners = $this->getBanners();
            $news = $this->getNews();
            $categories = $this->getCategories();
            $user = $_SESSION['user'] ?? null;

<<<<<<< HEAD
            require_once __DIR__ . '/../Views/home/index.php';
        } catch (Exception $e) {
=======
            // ✅ SỬA: Thêm khoảng trắng
            require_once __DIR__ . '/../Views/home/index.php';
            
        } catch (Exception $e) {
            // ✅ SỬA: Bỏ named parameters
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("HomeController Error: " . $e->getMessage());
            $this->showErrorPage("Có lỗi xảy ra khi tải trang chủ");
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getFeaturedProducts() {
        try {
            $sql = "SELECT id, name, price, image, description 
                    FROM products 
                    WHERE featured = 1 AND status = 1 
                    LIMIT 8";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getFeaturedProducts Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getNewProducts() {
        try {
            $sql = "SELECT id, name, price, image, description 
                    FROM products 
                    WHERE status = 1 
                    ORDER BY created_at DESC 
                    LIMIT 8";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getNewProducts Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getPromotions() {
        try {
            $sql = "SELECT id, title, description, image, start_date, end_date 
                    FROM promotions 
                    WHERE start_date <= NOW() AND end_date >= NOW() 
                    AND status = 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getPromotions Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getBanners() {
        try {
            $sql = "SELECT id, title, image, link, position 
                    FROM banners 
                    WHERE status = 1 
                    ORDER BY position ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getBanners Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getNews() {
        try {
            $sql = "SELECT id, title, summary, image, created_at 
                    FROM news 
                    WHERE status = 1 
                    ORDER BY created_at DESC 
                    LIMIT 5";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getNews Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function getCategories() {
        try {
            $sql = "SELECT id, name, slug, icon 
                    FROM categories 
                    WHERE parent_id IS NULL AND status = 1 
                    ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
<<<<<<< HEAD
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
=======
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            error_log("getCategories Error: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    private function showErrorPage($message) {
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Lỗi hệ thống</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                .error-container { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class='error-container'>
                <h2>⚠️ Có lỗi xảy ra</h2>
                <p>$message</p>
                <a href='index.php?action=trangchu'>Quay lại trang chủ</a>
            </div>
        </body>
        </html>";
        exit;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
