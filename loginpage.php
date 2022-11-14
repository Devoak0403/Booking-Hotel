<?php session_start(); ?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>เข้าสู่ระบบ</title>
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="assets/images/logopage/003-speedometer-1.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;500;700;800&display=swap" rel="stylesheet">
    
</head>
<style>
    html,
    body {
        height: 100%;
        font-family: 'Noto Sans Thai', sans-serif;
    }

    body {
        font-family: 'Noto Sans Thai', sans-serif;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
</style>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="loginpage.php"><img class="logo-img" src="assets/img/logob.jpg" width="100%" alt="logo"></a><span class="splash-description">กรุณาป้อนข้อมูลผู้ใช้ของคุณ.</span></div>
            <div class="card-body">
                <form action="signin_db.php" method="post">

                    <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <input class="form-control form-control-lg" id="email" type="text" placeholder="อีเมล" autocomplete="off" name="email">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="รหัสผ่าน" name="password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">จดจำฉัน</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="signin">เข้าสู่ระบบ</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  " align="center">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="registerpage.php" class="footer-link">สร้างบัญชีผู้ใช้</a></div>
                <div class="card-footer-item card-footer-item-bordered" >
                    <a href="#" class="footer-link">ลืมรหัสผ่าน ?</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>