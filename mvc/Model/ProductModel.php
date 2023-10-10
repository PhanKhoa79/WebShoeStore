<?php 
include_once('DBConfig.php');

class ProductModel {
    public static function addProduct($data) {
        try {
            $conn = connectDB();

            $query = "INSERT INTO prodcut (IdProduct, NameProduct, QuantityProduct, DesProduct, ImageProduct, Size, Price, Status, ProvideProducts, id_category, id_type) 
                      VALUES (:id, :name, :quantity,  :description, :image, :size, :price, :status, :provider, :category, :brand)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':id',  $data['id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':quantity', $data['quantity']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':image', $data['image']);
            $stmt->bindParam(':size', $data['size']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':provider', $data['provider']);
            $stmt->bindParam(':category', $data['category']);
            $stmt->bindParam(':brand', $data['brand']);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllProducts() {
        try {
            $conn = connectDB();
            
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $row = 5;
            $from = ($page - 1) * $row;

            $query = "SELECT P.IdProduct, P.NameProduct, P.ImageProduct, P.QuantityProduct, P.Status, P.Price, C.name_category 
                      FROM prodcut P 
                      INNER JOIN category_product C ON P.id_category = C.id_category
                      LIMIT $from, $row"; 
            $stmt = $conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    public static function countProduct() {
        try {
            $conn = connectDB(); 
            $query = "SELECT * FROM prodcut"; 
            $stmt = $conn->prepare($query); 
        
            $stmt->execute();
        
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = count($products);
            return $rowCount;
        } catch(PDOException $e) {
            return 0; 
        }
    }
    public static function getProductById($productId) {
        try {
            $conn = connectDB();
            $query = "SELECT IdProduct, NameProduct, ImageProduct, QuantityProduct, Status, Price, CategoryProduct FROM prodcut WHERE IdProduct = :productId";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }


    public static function deleteProduct($productId) {
        try {
            $conn = connectDB();

            $query = "DELETE FROM prodcut where IdProduct = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $productId, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function updateProduct($data) {
        try {
            $conn = connectDB();
    
            $query = "UPDATE prodcut 
                      SET NameProduct = :name, 
                          QuantityProduct = :quantity, 
                          ImageProduct = :image, 
                          Price = :price, 
                          Status = :status,
                          id_category = :category,
                          id_type = :type
                      WHERE IdProduct = :id";
    
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
            $stmt->bindParam(':type', $data['brand'], PDO::PARAM_INT);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>