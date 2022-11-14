<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])) {
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
    
    <title>จองห้องพัก | User</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php include 'sidebar_user.php'; ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="ecommerce-widget">
                        <div class="row">
                           <div class="col-12">
                               <div class="card-body">
                                    <h2 class="card-title">รายการจองห้องพัก Standard</h2>
                                    <hr>
                                    <div class="row">
                                        <?php 
                                                $stmt = $conn->query("SELECT * FROM room_all,group_room WHERE room_all.group_room = '1' AND room_all.status = 'ว่าง' AND room_all.group_room = group_room.id");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();

                                                if (!$rows) {
                                                    echo " <div class='col-12'>
                                                                <div class='card-body text-center'>
                                                                    <tr><div colspan='6' class='alert alert-primary'>---------- ไม่มีห้องว่าง ---------- </div></tr>
                                                                    </div></tr>
                                                                </div>
                                                            </div>";
                                                } else {
                                                    foreach ($rows as $row) {
                                            ?>

                                            <tr>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                    
                                                        <h3 class="card-title mb-2 text-center">รหัสห้อง : <?php echo $row['id_room']; ?></h3>
                                                        <strong class="card-title text-center">ห้องพักแบบ <?php echo $row['room_name']; ?></strong>  
                                                    </div>
                                                    <img class="img-fluid" src="assets/img/std-room.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <strong class="card-title text-center mb-2">ราคา : <?php echo $row['price']; ?> </strong><br>    
                                                        <span class="text-center badge badge-primary mt-2 mb-2">
                                                                สถานะ : <?php echo $row['status']; ?>
                                                        </span>

                                                        <div class="card-footer text-center">
                                                            <a href="#" class="btn btn-brand">ดูเพิ่มเติม</a>
                                                            <a href="user_booking.php?id_room=<?php echo $row['id_room']; ?>" class="btn btn-primary ">จอง</a>
                                                        </div>    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </tr>
                                            <?php } 
                                            } ?>
                                    </div>
                               </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-12">
                               <div class="card-body">
                                    <h2 class="card-title">รายการจองห้องพัก Superior</h2>
                                    <hr>
                                    <div class="row">
                                        <?php 
                                                $stmt = $conn->query("SELECT * FROM room_all,group_room WHERE room_all.group_room = '2' AND room_all.status = 'ว่าง' AND room_all.group_room = group_room.id");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();

                                                if (!$rows) {
                                                    echo " <div class='col-12'>
                                                                <div class='card-body text-center'>
                                                                    <tr><div colspan='6' class='alert alert-primary'>---------- ไม่มีห้องว่าง ---------- </div></tr>
                                                                    </div></tr>
                                                                </div>
                                                            </div>";
                                                } else {
                                                    foreach ($rows as $row) {
                                            ?>

                                            <tr>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title mb-2 text-center">รหัสห้อง : <?php echo $row['id_room']; ?></h3>
                                                        <strong class="card-title text-center">ห้องพักแบบ <?php echo $row['room_name']; ?></strong>  
                                                    </div>
                                                    <img class="img-fluid" src="assets/img/sup-room.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <strong class="card-title text-center mb-2">ราคา : <?php echo $row['price']; ?> </strong><br>    
                                                        <span class="text-center badge badge-primary mt-2 mb-2">
                                                                สถานะ : <?php echo $row['status']; ?>
                                                        </span>

                                                        <div class="card-footer text-center">
                                                            <a href="#" class="btn btn-brand">ดูเพิ่มเติม</a>
                                                            <a href="user_booking.php?id_room=<?php echo $row['id_room']; ?>" class="btn btn-primary ">จอง</a>
                                                        </div>    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </tr>
                                            <?php } 
                                            } ?>
                                    </div>
                               </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-12">
                               <div class="card-body">
                                    <h2 class="card-title">รายการจองห้องพัก Deluxe</h2>
                                    <hr>
                                    <div class="row">
                                        <?php 
                                                $stmt = $conn->query("SELECT * FROM room_all,group_room WHERE room_all.group_room = '3' AND room_all.status = 'ว่าง' AND room_all.group_room = group_room.id");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();

                                                if (!$rows) {
                                                    echo " <div class='col-12'>
                                                                <div class='card-body text-center'>
                                                                    <tr><div colspan='6' class='alert alert-primary'>---------- ไม่มีห้องว่าง ---------- </div></tr>
                                                                    </div></tr>
                                                                </div>
                                                            </div>";
                                                } else {
                                                    foreach ($rows as $row) {
                                            ?>

                                            <tr>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title mb-2 text-center">รหัสห้อง : <?php echo $row['id_room']; ?></h3>
                                                        <strong class="card-title text-center">ห้องพักแบบ <?php echo $row['room_name']; ?></strong>  
                                                    </div>
                                                    <img class="img-fluid" src="assets/img/deluxe-room.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <strong class="card-title text-center mb-2">ราคา : <?php echo $row['price']; ?> </strong><br>    
                                                        <span class="text-center badge badge-primary mt-2 mb-2">
                                                                สถานะ : <?php echo $row['status']; ?>
                                                        </span>

                                                        <div class="card-footer text-center">
                                                            <a href="#" class="btn btn-brand">ดูเพิ่มเติม</a>
                                                            <a href="user_booking.php?id_room=<?php echo $row['id_room']; ?>" class="btn btn-primary ">จอง</a>
                                                        </div>    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </tr>
                                            <?php } 
                                            } ?>
                                    </div>
                               </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-12">
                               <div class="card-body">
                                    <h2 class="card-title">รายการจองห้องพัก Suite</h2>
                                    <hr>
                                    <div class="row">
                                        <?php 
                                                $stmt = $conn->query("SELECT * FROM room_all,group_room WHERE room_all.group_room = '4' AND room_all.status = 'ว่าง' AND room_all.group_room = group_room.id");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();

                                                if (!$rows) {
                                                    echo " <div class='col-12'>
                                                                <div class='card-body text-center'>
                                                                    <tr><div colspan='6' class='alert alert-primary'>---------- ไม่มีห้องว่าง ---------- </div></tr>
                                                                    </div></tr>
                                                                </div>
                                                            </div>";
                                                } else {
                                                    foreach ($rows as $row) {
                                            ?>

                                            <tr>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title mb-2 text-center">รหัสห้อง : <?php echo $row['id_room']; ?></h3>
                                                        <strong class="card-title text-center">ห้องพักแบบ <?php echo $row['room_name']; ?></strong>  
                                                    </div>
                                                    <img class="img-fluid" src="assets/img/suite-room.png" alt="Card image cap">
                                                    <div class="card-body">
                                                        <strong class="card-title text-center mb-2">ราคา : <?php echo $row['price']; ?> </strong><br>    
                                                        <span class="text-center badge badge-primary mt-2 mb-2">
                                                                สถานะ : <?php echo $row['status']; ?>
                                                        </span>

                                                        <div class="card-footer text-center">
                                                            <a href="#" class="btn btn-brand">ดูเพิ่มเติม</a>
                                                            <a href="user_booking.php?id_room=<?php echo $row['id_room']; ?>" class="btn btn-primary ">จอง</a>
                                                        </div>    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </tr>
                                            <?php } 
                                            } ?>
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