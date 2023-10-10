<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>500+ Mẫu Giày Rep Tại Shop Giày Replica - VKHA STORE</title>

        <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">
               
        <!-- slick slide -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
        
        <link href="../../assets/base.css" rel="stylesheet">
        <link href="../../assets/style.css" rel="stylesheet">
        <link href="../../assets/modal.css" rel="stylesheet">

        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400;600&family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    </head>

    <body>

        <?php
            include("../default/header.php");
        ?>
        
        <?php 
            if(isset($_GET['act'])) {
                $action = $_GET['act'];
                switch($action) {
                    case 'introduce':
                        include_once '../default/introduce.php';
                        break;
                    case 'blog':
                        include_once '../default/blog.php';
                        break;
                    case 'contact':
                        include_once '../default/blog-contact.php';
                        break;
                    default: 
                        include_once '../default/list-product.php';
                        break;
                }
            } else {
                include_once '../default/list-product.php';
            }
        ?>

        <?php
            include("../default/footer.php");
        ?>

        <?php
            include("../default/contact.php");
        ?>
    
        <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

        <script src="https://cdn.tailwindcss.com"></script>

        <!-- slick slide -->
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        
        <script type="text/javascript" src="../../assets/main.js"></script>

    </body>
</html>

