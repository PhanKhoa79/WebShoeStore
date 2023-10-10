<?php 
session_start();
include_once('../../Controller/UserController.php');
//login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userController = new UserController();

    $result = $userController->login($email, $password);
    if($result !== true) {
      $text_err = "Email or password is invalid!";
    } 
}

//register
if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $email = $_POST['email-signup'];
    $password = $_POST['psw'];
    $confirm_pw = $_POST['psw-repeat'];
    $userController = new UserController();
    //Kiểm tra xem mật khẩu đã đủ 8 kí tự chưa
    if(strlen($password) >= 8) {
    //Kiểm tra xem mật khẩu xác nhận đúng chưa
        if($password === $confirm_pw) {
          $result = $userController->register($username, $email, $password);
          if($result === true) {
            echo '<script>alert("Đăng ký thành công!");</script>';
          } else {
            $text_err = "Email or Username already exists!";
          }
        } else {
          $text_error = "Password incorrect!";
        }
    } 
}

?>
<header class="header">
          <div class="header-top">
            <div class="header-top__left">
                <ul>
                    <li>
                        <a href="home.php?act=introduce">Giới thiệu VKHA Shoes Store 
                        - Shope bán giày chính hãng số 1 Việt Nam
                        </a>
                    </li>
                    <li><a href="home.php?act=blog">Blog</a></li>
                    <li><a href="home.php?act=contact">Liên hệ</a></li>
                </ul>
            </div>

            <div class="header-top__right">
                <ul class="header-top__item-right">
                    <?php 
                        if(isset($_SESSION['login']['user'])){ 
                    ?>
                        <li><a href=""><?php echo $_SESSION['login']['user'];?></a></li>
                        <li><a href="../default/logOutUser.php" style="margin-left: 12px">Log out</a></li>
                    <?php 
                        } else {
                    ?>
                        <button type="button" class="btnn btn_login" onclick="document.getElementById('modalLogin').style.display='block'">
                            Đăng nhập
                        </button>
                        <button type="button" class="btnn btn_signUp" onclick="document.getElementById('modalSignUp').style.display='block'">
                            Đăng kí
                        </button>
                    <?php 
                        }
                    ?>
                </ul>
            </div>

          </div>

          <div class="header-bottom">

            <div class="wrapper header-wrapper">
                <div class="mascot">
                    <img src="../../assets/img/chicken-martrix-60.png" alt="">
                </div>
                <div class="logo">
                    <a href="home.php?act=list-product.php">
                        <img src="../../assets/img/logo.png" alt="logo" width="96" height="96">
                    </a>
                </div>

                <div class="header-nav_main-wrapper header-nav__main">
                        <li class="header-nav__main-left">
                            <div class="header-menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                <div class="header-menu__selector">
                                    <span style="font-size: 12px;">Danh mục</span>
                                    <span style="font-size: 16px;">
                                        Sản phẩm
                                        <i class='bx bx-caret-down'></i>
                                    </span>
                                </div>
                                <ul class="sub-menu">
                                    <li class="menu-item" id="all-products">
                                        <a href="">Tất cả sản phẩm</a>
                                        <strong>New</strong>
                                    </li>
                                    <li class="menu-item" id="flash-sale">
                                        <a href="">Flash Sale</a>
                                        <strong>Hot</strong>
                                    </li>
                                    <li class="menu-item"><a href="">Giày Nike Rep 1:1</a></li>
                                    <li class="menu-item"><a href="">Jordan 1</a></li>
                                    <li class="menu-item"><a href="">Jordan 4</a></li>
                                    <li class="menu-item"><a href="">Air Force 1</a></li>
                                    <li class="menu-item"><a href="">Giày adidas</a></li>
                                    <li class="menu-item"><a href="">EQT</a></li>
                                    <li class="menu-item"><a href="">Ultra Boost</a></li>
                                    <li class="menu-item"><a href="">Superstar</a></li>
                                </ul>
                            </div>
                        </li>

                    <div class="header-nav__main-right">
                        <form action="" method="get" class="form_search">
                            <div class="header-nav__search">
                                <input type="search" name="search" id="nav_search" placeholder="Tìm kiếm sản phẩm">
                            </div>
                            
                            <div class="header-nav__submit">
                                <button type="submit" name="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <nav class="header-nav" style="margin-right:8px">
                    <ul class="header-nav__list">
                        <li class="header-nav__item item-cart">
                            <a href="" class="header-nav__link cart">
                                <bdi style="display:flex; margin-left:4px">
                                    0
                                    <span>₫</span>
                                </bdi>
                                <div class="header-nav__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <li class="header-nav__item">
                            <a href="tel:039.342.6897" class="header-nav__link contact">
                                <div class="header-nav__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                </div>
                                039.342.6897
                             </a>
                        </li>
                    </ul>
                </nav>
            </div>
          </div>
           
        </header>

<!-- Modal Login-->
<div id="modalLogin" class="modal">
  <span onclick="document.getElementById('modalLogin').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <form class="modal-content animate" action="home.php" method="post">
    <div class="imgcontainer">
        <img src="../../assets/img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <label for="uname"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <span class="psw">If you don't already have an account? <button type="button" style="color:rgb(21, 101, 192)" onclick="document.getElementById('modalSignUp').style.display='block'">Sign Up</button></span>
      <button type="submit" name="login" class="btnLogin" style=" background-color: #04AA6D;">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('modalLogin').style.display='none'" class="cancelbtn" style=" background-color: #f44336;">Cancel</button>
    </div>
  </form>
</div>

<script>
var modal = document.getElementById('modalLogin');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<!-- Modal SignUp -->
<div id="modalSignUp" class="modal">
  <span onclick="document.getElementById('modalSignUp').style.display='none'" class="close-signup" title="Close Modal">&times;</span>
  <form class="modal-content" action="home.php" method="post" style="padding:15px">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr style="margin-bottom:25px">

      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email-signup" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('modalSignUp').style.display='none'" class="cancelbtn-signup" style="background-color: #f44336;">Cancel</button>
        <button type="submit" name="signUp" class="signup" style="background-color: #04AA6D;">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('modalSignUp');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>