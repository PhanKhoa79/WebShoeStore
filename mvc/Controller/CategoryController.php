<?php
include_once(__DIR__ . '/../Model/CategoryModel.php');

class CategoryController {
    public function addCategory($data) {
    
        $categoryModel = new CategoryModel();
        $result = $categoryModel->addCategory($data);
        if ($result) {
            return true;
        }
    }

    public function addType($data) {
    
        $categoryModel = new CategoryModel();
        $result = $categoryModel->addType($data);
        if ($result) {
            return true;
        }
    }

    public function getAllCategorys() {
        $categoryModel = new CategoryModel();
        return $categoryModel->getAllCategorys();     
    }

    public function getTypeByCategory($categoryId) {
        $categoryModel = new CategoryModel();
        return $categoryModel->getTypeByCategory($categoryId);     
    }
}

?>