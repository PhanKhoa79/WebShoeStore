<?php
session_start();
include_once('../../Controller/CategoryController.php');
include_once('../../Controller/ProductController.php');

if (isset($_POST['save'])) {
    $data = array(
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description'],
        'image' => basename($_FILES['fileupload']['name']),
        'size' => $_POST['size'],
        'price' => $_POST['price'],
        'status' => $_POST['status'],
        'provider' => $_POST['provider'],
        'category' => $_POST['category'],
        'brand' => $_POST['type']
    );

    $productController = new ProductController();
    $result = $productController->addProduct($data);
    if($result) {
        header('location: ../default/product.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="../../assets/admin.css" rel="stylesheet">

        <script src="../../ckeditor/ckeditor.js"></script>

        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body onload="displayCurrentTime()">

        <div class="wrapper">
            <?php include_once('../admin/slider_bar.php') ?>
            
            <div class="main">
                <header class="header">
                    <span>Xin chào <?php echo $_SESSION['login']['user']?></span>
                    <a href="logOut.php" title="Log out">
                        <i class="bx bx-log-out bx-rotate-180 bx-sm"></i>
                    </a>
                </header>
                <div class="content">
                    <div class="title-content">
                        <ul class="list-select">
                            <li>
                                <a href="../default/product.php">Danh sách sản phẩm</a>
                            </li>
                            <i class='bx bx-chevrons-right'></i>
                            <li>
                                <a href="#">Thêm sản phẩm</a>
                            </li>
                        </ul>
                        <span id="current-time"></span>
                    </div>
                    
                    <div class="main-content">
                        <div class="title-main-content">
                            <strong>Tạo mới sản phẩm</strong>
                        </div>

                        <div class="nav-main-content">
                            <div class="item-nav">
                                <a href="">
                                    <i class="bx bxs-folder-plus bx-xs"></i>
                                    <span>Thêm nhà cung cấp</span>
                                </a>
                            </div>
                            <div class="item-nav">
                                <a href="">
                                    <i class="bx bxs-folder-plus bx-xs"></i>
                                    <span>Thêm danh mục</span>
                                </a>
                            </div>
                            <div class="item-nav">
                                <a href="">
                                    <i class="bx bxs-folder-plus bx-xs"></i>
                                    <span>Thêm tình trạng</span>
                                </a>
                            </div>
                        </div>
                    
                    <form class="body-content" action="add-product.php" method="post" enctype="multipart/form-data">
                        <div class="detail-product">
                            <div class="top-detail">
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Mã sản phẩm</label>
                                    <input class="form-control mt-1" type="text" name="id">
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Tên sản phẩm</label>
                                    <input class="form-control mt-1" type="text" name="name">
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Số lượng</label>
                                    <input class="form-control mt-1" type="number" name="quantity">
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Tình trạng</label>
                                    <select class="form-control mt-1" name="status">
                                        <option value="">-- Chọn tình trạng --</option>
                                        <option value="Còn hàng">Còn hàng</option>
                                        <option value="Hết hàng">Hết hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bot-detail" style="display: flex; flex-wrap:wrap; justify-content:start">
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Danh mục</label>
                                    <select class="form-control mt-1" name="category" id="categorySelect" onchange="showBrand(this.value)">
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php  
                                            $categoryController = new CategoryController();
                                            $categorys = $categoryController -> getAllCategorys();
                                            foreach ($categorys as $category) {
                                        ?>
                                            <option value="<?php echo $category['id_category'] ?>"><?php echo $category['name_category']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                    
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Hãng</label>
                                    <select class="form-control mt-1" name="type" id="typeSelect">
                                        
                                    </select>
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Nhà cung cấp</label>
                                    <select class="form-control mt-1" name="provider">
                                        <option value="">-- Chọn nhà cung cấp --</option>
                                        <option value="NH">Chợ Ninh Hiệp</option>
                                        <option value="DX">Chợ Đông Xuân</option>
                                        <option value="PK">Chợ Phùng Khoang</option>
                                    </select>
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Giá bán</label>
                                    <input class="form-control mt-1" type="text" name="price">
                                </div>
                                <div class="item-detail">
                                    <label class="text-xs font-semibold mt-2">Size</label>
                                    <select class="form-control mt-1" name="size">
                                        <option value="">-- Chọn size --</option> 
                                        <option value="36">Size 36</option>
                                        <option value="37">Size 37</option>
                                        <option value="38">Size 38</option>
                                        <option value="39">Size 39</option>
                                        <option value="40">Size 40</option>
                                        <option value="41">Size 41</option>
                                        <option value="42">Size 42</option>
                                        <option value="43">Size 43</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="img-product">
                            <span class="text-xs font-semibold mt-2 h-6">Ảnh sản phẩm</span> 
                            <input type="file" name="fileupload" id="fileupload" class="h-5">
                        </div>
                        <div class="des-product">
                            <span class="text-xs font-semibold mt-2">Mô tả sản phẩm</span>
                            <textarea class="form-control" name="description" id="editor1"></textarea>
                            <script>CKEDITOR.replace('description');</script>
                        </div>
                        <div class="btn-control">
                            <button type="submit" name="save" id="save" onclick="return confirm('Thêm thành công!')">Lưu</button>
                            <a href="#" id="delete" onclick="resetForm()">Hủy</a>
                        </div>
                    </form>
                    </div>
                </div>
                 
            </div>

            
        </div>

        <script src="../../assets/main.js"></script>
        <script src="../../assets/script.js"></script>
       
    </body>
</html>
