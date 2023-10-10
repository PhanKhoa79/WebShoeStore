<?php
session_start();
ob_start();
include_once('../../Controller/ProductController.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productController = new ProductController();
    $result = $productController->deleteProduct($productId);
}

if(isset($_GET['sid'])) {
    $productId = $_GET['sid'];
    if (isset($_POST['save'])) {
        $data = array(
            'id' => $productId,
            'name' => $_POST['name'],
            'quantity' => $_POST['quantity'],
            'category' => $_POST['category'],
            'image' => basename($_FILES['fileupload']['name']),
            'price' => $_POST['price'],
            'status' => $_POST['status']
        );
        $productController = new ProductController();
        $productController->updateProduct($data);
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
                    if(isset($_GET['sid'])) {
                        $sid = $_GET['sid'];
                        $productController = new ProductController();
                        $result = $productController->getProductById($sid);
                        print_r($result);
                    }

                ?> 
                <?php 
                ?>
                <div class="content">
                    <div class="title-content">
                        <ul class="list-select">
                                <a href="../default/product.php">Danh sách sản phẩm</a>
                            </li>
                        </ul>
                        <span id="current-time"></span>
                    </div>

                    <div class="main-content">
                        <div class="nav-main-content">
                            <div class="item-nav">
                                <a href="../layouts/dashboard.php">
                                    <i class="bx bx-plus bx-xs"></i>
                                    <span>Thêm sản phẩm</span>
                                </a>
                            </div>
                            <div class="item-nav">
                                <a href="">
                                    <i class="bx bxs-cloud-upload bx-xs"></i>
                                    <span>Tải từ file</span>
                                </a>
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
                                        sản phẩm
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
                                            <th style="width: 151px;">Mã sản phẩm</th>
                                            <th style="width: 320px;">Tên sản phẩm</th>
                                            <th style="width: 176px;">Ảnh</th>
                                            <th style="width: 106px;">Số lượng</th>
                                            <th style="width: 120px;">Tình trạng</th>
                                            <th style="width: 147px;">Giá tiền</th>
                                            <th style="width: 187px;">Danh mục</th>
                                            <th style="width: 128px;">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $productController = new ProductController();
                                        $products = $productController->getAllProducts();
                                        $index = 1;
                                        foreach ($products as $product) {
                                    ?> 
                                            <tr>
                                                <td><?php echo $index ?></td>
                                                <td> <?php echo $product['IdProduct'] ?> </td>
                                                <td> <?php echo $product['NameProduct'] ?> </td>
                                                <td><img src="../../assets/img/<?php echo $product['ImageProduct'] ?>"> </td>                                           
                                                <td> <?php echo $product['QuantityProduct'] ?> </td>
                                                <td>
                                                    <p class="<?php echo ($product['Status'] == 'Còn hàng') ? 'text-success' : 'text-danger'; ?> ">
                                                        <?php echo $product['Status'] ?> 
                                                    </p>
                                                </td>
                                                <td><?php echo $product['Price'] ?></td>
                                                <td> <?php echo $product['CategoryProduct'] ?> </td>
                                                <td>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="product.php?id=<?php echo $product['IdProduct']; ?>"
                                                     title="Xóa" id="btn-delete">
                                                        <i class="bx bx-trash bx-sm"></i>
                                                    </a>
                                                    <a href="product.php?sid=<?php echo $product['IdProduct']; ?>" title="Sửa" id="btn-update">
                                                        <i class="bx bx-edit bx-sm"></i>
                                                    </a> 
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
                                    
<!--------- MODAL ----------->

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

     
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa thông tin sản phẩm</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      
      <div class="modal-body">
          <form action="product.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Số lượng</label>
                        <input class="form-control" type="number" name="quantity">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Tình trạng</label>
                        <select class="form-control" name="status">
                            <option value="">-- Chọn tình trạng --</option>
                            <option value="Còn hàng">Còn hàng</option>
                            <option value="Hết hàng">Hết hàng</option>
                        </select>
                    </div>
    
                    <div class="form-group col-md-12">
                        <label>Danh mục</label>
                        <select class="form-control" name="category">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="Giày adidas">Giày Adidas</option>
                            <option value="Giày converse">Giày Converse</option>
                            <option value="Giày gucci">Giày Gucci</option>
                            <option value="Giày mlb">Giày MLB</option>
                            <option value="Giày nb">Giày NB</option>
                            <option value="Giày vans">Giày Vans</option>
                            <option value="Giày nike">Giày Nike</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Giá bán</label>
                        <input class="form-control" type="text" name="price">
                    </div>
                    <div class="form-group col-md-12">
                          <span>Ảnh sản phẩm</span> 
                          <input type="file" name="fileupload" id="fileupload">
                    </div>
                    <div class="form-group col-md-12">
                      <button type="submit" name="save" class="btn btn-success">Lưu</button>
                    </div>  
                </div>
          </form>
      </div>

      
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>                                        
                                            

        <script src="../../assets/main.js"></script>
                                       
    </body>
</html> 