<?php 
include_once('DBConfig.php');

class UserModel {
    public static function isCheckUserName($username) {
        try {
            $conn = connectDB();
            $query = "Select * from user where UserName = :username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $check = ($stmt->rowCount() > 0);
            return $check;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function isCheckEmail($email) {
        try {
            $conn = connectDB();
            $query = "Select * from user where Email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $check = ($stmt->rowCount() > 0);
            return $check;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function addUser($username, $email, $password) {
        try {
            $conn = connectDB(); // Hàm kết nối cơ sở dữ liệu từ tệp DBconfig.php
    
            // Truy vấn để thêm người dùng mới
            $query = "INSERT INTO user(UserName, Email, PassWord) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
    
            // Kiểm tra xem dữ liệu đã được thêm thành công
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function isValidLogin($email, $password) {
        try {
            $conn = connectDB();
    
            // Truy vấn để lấy thông tin người dùng dựa trên email
            $query = "SELECT * FROM user WHERE Email = :email and PassWord = :password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() === 1) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getUserByEmail($email) {
        try {
            $conn = connectDB();
            $query = "SELECT * FROM user WHERE Email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Trả về một mảng chứa thông tin người dùng
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    
    public static function getUserNamebyEmail($email) {
        try {
            $conn = connectDB();
            $query = "Select UserName from user where Email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['UserName'];
            }
            return null;
        } catch(PDOException $e) {
            return null;
        }
    }
    public static function getRolebyEmail($email) {
        try {
            $conn = connectDB();
            $query = "Select role from user where Email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['role'];
            }
            return null;
        } catch(PDOException $e) {
            return null;
        }
    }

    public static function getAvatarbyEmail($email) {
        try {
            $conn = connectDB();
            $query = "Select Avatar from user where Email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['Avatar'];
            } else {
                return '../assets/img/default_avatar.png';
            }
        } catch(PDOException $e) {
            return null;
        }
    }
}
?>
