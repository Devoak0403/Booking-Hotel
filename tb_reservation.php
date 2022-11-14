<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');
    }

?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="assets/images/logopage/003-speedometer-1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
    
    <title>จองห้องพัก | Admin</title>
</head>


<body>
    <div class="dashboard-main-wrapper">
        
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php include 'sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        
                        <div class="page-header">
                            <h2 class="pageheader-title"> รายงานการจอง </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index_admin.php" class="breadcrumb-link">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item"><a href="tb_booking.php" class="breadcrumb-link">ข้อมูลการจอง</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">รายงานการจอง</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="ecommerce-widget">
                        <div class="row">
                           <div class="col-12">
                               <div class="card-body">
                                    <button class="btn btn-warning mb-4 " onclick="window.print()"> พิมพ์การจอง</button>
                                    
                                        <div class="row">
                                            <?php 
                                                if (isset($_GET['r_id'])) {
                                                    $id = $_GET['r_id'];
                                                    $stmt = $conn->query("SELECT * FROM reservation WHERE r_id = '$id'");
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();

                                                if (!$rows) {
                                                    echo " <div class='col-12'>
                                                                <div class='card-body text-center'>
                                                                    <tr><div colspan='6' class='alert alert-primary'>---------- ไม่รายการจองของคุณ ---------- </div></tr>
                                                                    </div></tr>
                                                                </div>
                                                            </div>";
                                                } else {
                                                    foreach ($rows as $row) {
                                                }
                                            ?>

                                                <tr>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <form action="tb_reservationsql.php" method="POST">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title mb-2 text-center">รหัสห้อง : <?php echo $row['id_room']; ?></h3>
                                                            <input type="text" name="status_reser" value="<?= $row['status_reser']; ?>" hidden>
                                                            <input type="text" name="r_id" value="<?= $row['r_id']; ?>" hidden>
                                                            <h4 class="card-title mb-1 badge badge-success">สถานะการจอง : <?php echo $row['status_reser']; ?></h4>
                                                            
                                                            </h3> 
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-5">
                                                                <h5 class="card-text mb-1">ชื่อผู้จอง : </h5>  
                                                                <h5 class="card-text mb-1">ราคา : </h5>  
                                                                <h5 class="card-text mb-1">วันที่เข้าพัก : </h5>
                                                                <h5 class="card-text mb-1">วันที่ออก : </h5>
                                                                <h5 class="card-text mb-1">เบอร์โทรศัพท์ : </h5>
                                                                <h5 class="card-text mb-1">อีเมล : </h5>
                                                                <h5 class="card-text mb-1">บัญชีธนาคาร : </h5>
                                                                <h5 class="card-text mb-1">สลิปการชำระเงิน : </h5>
                                                                
                                                                </div>
                                                                <div class="col-7">
                                                                <h5 class="card-text mb-1"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?> </h5>  
                                                                <h5 class="card-text mb-1"><?php echo $row['price_room']; ?> </h5>  
                                                                <h5 class="card-text mb-1"><?php echo $row['start_datetime']; ?> </h5>
                                                                <h5 class="card-text mb-1"><?php echo $row['end_datetime']; ?> </h5>
                                                                <h5 class="card-text mb-1"><?php echo $row['tel']; ?> </h5>
                                                                <h5 class="card-text mb-1"><?php echo $row['email']; ?> </h5>
                                                                <h5 class="card-text mb-1"><?php echo $row['bank']; ?> </h5>
                                                                <a class="mt-1" href="uploadpayment/<?php echo $row['filepayment']; ?>" target="_blank">
                                                                    <img class="mt-1 img-fulid" src="uploadpayment/<?php echo $row['filepayment']; ?>" width="150px" height="250px">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="text-right mt-2">
                                                            <small>วันที่ทำรายการ : <?php echo $row['dateCreate']; ?></small><br>
                                                            <!-- <a class="btn btn-success mt-2" href="tb_reservationsql.php?id_room=<?= $data['id_room']; ?>">อนุมัติการจอง</a> -->
                                                            <button type="submit" name="update" class="btn btn-success mt-2">อนุมัติการจอง</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </tr>
                                            </form> 
                                                <?php } } ?>
                                        </div>
                                    
                               </div>
                           </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
   
	
    
</body>
</html>