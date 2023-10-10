
<?php
session_start();
ob_start();
include_once('../../Controller/CategoryController.php');


//Add Category
if (isset($_POST['saveCategory'])) {
    $data = array(
        'id' => $_POST['id_category'],
        'name' => $_POST['name_category']
    );

    $categoryController = new CategoryController();
    $result = $categoryController->addCategory($data);
}   
//Add Type
if (isset($_POST['saveType'])) {
    $data = array(
        'name' => $_POST['name_type'],
        'id' => $_POST['category']
    );

    $categoryController = new CategoryController();
    $result = $categoryController->addType($data);
    header("Location: manage-category.php");
    exit(); 
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
        <link href="../../assets/modal.css" rel="stylesheet">

        <script src="../../ckeditor/ckeditor.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body onload="displayCurrentTime()">
         <div class="wrapper">
            <?php include_once('../admin/slider_bar.php') ?>

            <div class="main">
                <header class="header">
                    <span>Xin chào <?php echo $_SESSION['login']['user']?></span>
                    <a href="../default/logOut.php" title="Log out">
                        <i class="bx bx-log-out bx-rotate-180 bx-sm"></i>
                    </a>
                </header>
                <?php 
                ?>
                <div class="content">
                    <div class="title-content">
                        <ul class="list-select">
                                <a href="../default/product.php">Danh mục sản phẩm</a>
                            </li>
                        </ul>
                        <span id="current-time"></span>
                    </div>

                    <div class="main-content">
                        <div class="nav-main-content">
                            <div class="item-nav">
                                <button type="button" onclick="document.getElementById('addCategory').style.display='block'">
                                    <i class="bx bx-plus bx-xs"></i>
                                    <span>Thêm danh mục sản phẩm</span>
                                </button>
                            </div>
                            <div class="item-nav">
                                <button type="button" onclick="document.getElementById('addType').style.display='block'">
                                    <i class="bx bxs-cloud-upload bx-xs"></i>
                                    <span>Thêm hãng sản phẩm</span>
                                </button>
                            </div>
                            <div class="item-nav">
                                <a href="">
                                    <i class="bx bxs-trash bx-xs"></i>
                                    <span>Xóa tất cả</span>
                                </a>
                            </div>
                        </div>

                        <div class="list-product">
                            <div class="nav-product">
                                <div class="quantity-product">
                                    <span>Hiện
                                        <select style="background:rgb(241, 241, 241); border:1px solid rgb(218, 218, 218); border-radius:4px; padding: 4px 4px">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        danh mục
                                    </span>
                                </div>
                                <div class="search-product">
                                    <button type="submit" name="submit" id="btn-search">Tìm kiếm: </button>
                                    <input type="search" name="search" id="search">
                                </div>
                            </div> 

                            <div class="item-product">
                                <table class="table">
                                    <thead>
                                        <tr class="title-table">
                                            <th width="20">#</th>
                                            <th style="width: 151px;">Mã danh mục</th>
                                            <th style="width: 250px;">Tên danh mục</th>
                                            <th style="width: 176px;">Tên hãng</th>
                                            <th style="width: 128px;">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $categoryController = new CategoryController();
                                            $categorys = $categoryController->getAllCategorys();
                                            $index = 1;
                                            foreach ($categorys as $category) {
                                                $categoryId = $category['id_category'];
                                                $categoryController = new CategoryController();
                                                $brands = $categoryController -> getTypeByCategory($categoryId);
                                        ?> 
                                            <tr>
                                                <td><?php echo $index ?></td>
                                                <td> <?php echo $category['id_category'] ?> </td>
                                                <td> <?php echo $category['name_category'] ?> </td> 
                                                <td> 
                                                    <?php  
                                                        foreach ($brands as $brand) {
                                                            echo $brand['name_type'] . "<br>";
                                                        }
                                                    ?> 
                                                 </td>          
                                                <td>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="product.php?id=<?php echo $product['IdProduct']; ?>"
                                                     title="Xóa" id="btn-delete">
                                                        <i class="bx bx-trash bx-sm"></i>
                                                    </a>
                                                    <button  title="Sửa" id="btn-update" class="editbtn">
                                                        <i class="bx bx-edit bx-sm"></i>
                                                    </button> 
                                                </td>
                                            </tr>
                                       <?php 
                                            $index++;
                                        } 
                                        ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

<!--------- MODAL ADD CATEGORY ----------->

    <div class="modal" id="addCategory">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm danh mục sản phẩm</h4>
                    <span onclick="document.getElementById('addCategory').style.display='none'"
                    class="close" title="Close Modal">&times;</span>
                </div>

            <!-- Modal body -->
                <div class="modal-body">
                    <form action="manage-category.php" method="post">
                                <div class="form-group col-md-12">
                                    <label>Mã danh mục</label>
                                    <input class="form-control" type="text" name="id_category">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Tên danh mục</label>
                                    <input class="form-control" type="text" name="name_category">
                                </div>
                                <div class="form-group col-md-12">
                                <button type="submit" name="saveCategory" onclick="return confirm('Thêm thành công!')" class="btn btn-success">Lưu</button>
                                </div>  
                    </form>
                </div>

            <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" onclick="document.getElementById('addCategory').style.display='none'" class="cancelbtn">Cancel</button>
                </div>

            </div>
        </div>
    </div>                                        
          
<!-- OPEN MODAL ADD CATEGORY -->
    <script>
    // Get the modal
    var modal = document.getElementById('addCategory');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
<!-- end -->

<!--------- MODAL ADD TYPE PRODUCT ----------->

    <div class="modal" id="addType">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm hãng</h4>
                    <span onclick="document.getElementById('addType').style.display='none'"
                    class="close" title="Close Modal">&times;</span>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="manage-category.php" method="post">   
                        <div class="form-group col-md-12">
                            <label>Tên danh mục</label>
                            <select class="form-control" name="category">
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
                        <div class="form-group col-md-12">
                            <label>Tên hãng</label>
                            <input type="text" name="name_type" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" name="saveType" class="btn btn-success" onclick="return confirm('Thêm thành công!')">Lưu</button>
                        </div>    
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" onclick="document.getElementById('addType').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>   
                           
<!-- OPEN MODAL ADD TYPE PRODUCT -->
    <script>
    // Get the modal
    var modal = document.getElementById('addType');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
<!-- end -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="../../assets/main.js"></script>

                                       
    </body>
</html>
                                    