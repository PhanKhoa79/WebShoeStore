<?php
if (session_status() == PHP_SESSION_NONE) {
    // Chỉ khởi tạo session nếu chưa tồn tại
    session_start();
}
include_once(__DIR__ . '/../Model/UserModel.php');

class UserController {
    public function register($username, $email, $password) {
        // Kiểm tra xem username hoặc email đã tồn tại trong cơ sở dữ liệu chưa
        if (UserModel::isCheckUserName($username) || UserModel::isCheckEmail($email)) {
            return false;
        } else {
            UserModel::addUser($username, $email, $password);
            return true;
        }
    }

    public function login($email, $password) {
        // Kiểm tra xem thông tin đăng nhập có hợp lệ không
        if (UserModel::isValidLogin($email, $password)) {
            $userName = UserModel::getUserNamebyEmail($email);
            if($userName !== null) {
                $userRole = UserModel::getRolebyEmail($email);
                $userAvatar = UserModel::getAvatarbyEmail($email);
                if($userRole !== null || $userAvatar !== null) {
                    //lưu lại tên đăng nhập và quyền vào biến SESSION
                    $_SESSION['login']['user'] = $userName;
                    $_SESSION['login']['role'] = $userRole;
                    $_SESSION['login']['avatar'] = $userAvatar;
                    if (!($userRole == 1)) {
                        header('Location: home.php');
                    } else {
                        header('Location: ../layouts/dashboard.php');
                    }
                    exit();
                }
            }
            return true;
        }
        return false; 
    }
    
}
?>
