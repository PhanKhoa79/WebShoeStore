<?php 
include_once('DBConfig.php'); 
class CategoryModel {
    public static function addCategory($data) {
        try {
            $conn = connectDB();

            $query = "INSERT INTO category_product (id_category, name_category) 
                      VALUES (:id, :name)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':id',  $data['id']);
            $stmt->bindParam(':name', $data['name']);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function addType($data) {
        try {
            $conn = connectDB();

            $query = "INSERT INTO type_product (name_type, id_category) 
                      VALUES (:name, :id)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':id',  $data['id']);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllCategorys() {
        try {
            $conn = connectDB();

            $query = "SELECT id_category, name_category FROM category_product";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    public static function getTypeByCategory($categoryId) {
            try {
                $conn = connectDB();
                $query = "SELECT * FROM type_product WHERE id_category = :categoryId";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':categoryId', $categoryId);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }
    }
}
?>