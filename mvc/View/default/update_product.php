<?php
include_once('../../Controller/ProductController.php');
    if(isset($_POST['updatedata'])) {
        $data = array(
            'id' => $_POST['update_id'],
            'name' => $_POST['name'],
            'quantity' => $_POST['quantity'],
            'category' => $_POST['category'],
            'image' => basename($_FILES['fileupload']['name']),
            'price' => $_POST['price'],
            'status' => $_POST['status']
        );
        $productController = new ProductController();
        $result = $productController->updateProduct($data);
        if($result) {
            header('location: product.php');
        }
    }
?>