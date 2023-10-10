<?php
include_once('../../Controller/CategoryController.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $categoryController = new CategoryController();
    $types = $categoryController -> getTypeByCategory($category_id);
    echo json_encode($types); // Trả về danh sách các hãng dưới dạng JSON
} else {
    echo json_encode([]);
}
?>