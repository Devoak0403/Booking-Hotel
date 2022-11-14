<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM room_all WHERE id='$delete_id'");
        }
        if ($deletestmt) {
            echo "<script>alert('ข้อมูลถูกลบเสร็จสมบูรณ์');</script>";
            $_SESSION['success'] = "ข้อมูลถูกลบเสร็จสมบูรณ์";
            header("refresh:1; url=index_admin.php");
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
                    
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <?php 

                                $stmt = $conn->query("SELECT *,COUNT(*) AS c_roomall FROM room_all");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">จำนวนห้องพักทั้งหมด</h5>
                                            <h2 class="mb-0"><?php echo $row['c_roomall']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary mt-1">
                                            <i class="fas fa-building fa-fw fa-sm text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <?php 

                                $stmt = $conn->query("SELECT *,COUNT(*) AS c_room1 FROM room_all WHERE status = 'ว่าง'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">จำนวนห้องว่างขณะนี้</h5>
                                            <h2 class="mb-0"><?php echo $row['c_room1']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary mt-1">
                                            <i class="fas fa-bed fa-fw fa-sm text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <?php 

                                $stmt = $conn->query("SELECT *,COUNT(*) AS c_room2 FROM room_all WHERE status = 'เต็ม'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">จำนวนห้องถูกจองขณะนี้</h5>
                                            <h2 class="mb-0"><?php echo $row['c_room2']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-success mt-1">
                                            <i class="fas fa-bed fa-fw fa-sm text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <?php 

                                $stmt = $conn->query("SELECT *,COUNT(*) AS c_res FROM reservation WHERE status_reser = 'รอการตรวจสอบ'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">จำนวนรายการรออนุมัติ</h5>
                                            <h2 class="mb-0"><?php echo $row['c_res']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-brand mt-1">
                                            <i class="fas fa-hand-holding-usd fa-fw fa-sm text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">

                                    <a href="tb_addroom.php" class="btn  btn-success" ><i class="fas fa-plus"></i> เพิ่มห้องพัก</a>

                                    
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">ห้องว่าง</h2>
                                        <hr>
                                        <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                            <thead>
                                                <tr align="center">
                                                    <th width='10%'>เลขห้อง</th>
                                                    <th width='15%'>ราคา</th>
                                                    <th width='10%'>สถานะ</th>
                                                    <th width='10%'>ประเภทห้อง</th>
                                                    <th width='5%'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            
                                            <?php 
                                                $stmt = $conn->query("SELECT * FROM room_all WHERE status = 'ว่าง' ORDER BY group_room ASC");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
            
                                                if (!$rows) {
                                                    echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                                                } else {
                                                    foreach ($rows as $row) {
                                            ?>
            
                                                <tr align="center">
                                                    <td><?= $row['id_room']; ?></td>
                                                    <td><?= $row['room_name']; ?></td>
                                                    <td><?= $row['price']; ?></td>
                                                    <td><?= $row['status']; ?></td>
                                                    <td>
                                                        
                                                    <a data-id="<?= $row['id']; ?>" href="?delete=<?= $row['id']; ?>" class="btn btn-danger delete-btn">ลบห้อง</a>
                                                </tr>
                                                <?php } 
                                                } ?>
                                            </tbody>
                                        </table>
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
   
	<script>

    $(".delete-btn").click(function(e) {
        var envId = $(this).data('id');
        e.preventDefault();
        deleteConfirm(envId);
    })
    
    function deleteConfirm(envId) {
        Swal.fire({
            title: 'คุณแน่ใจไหม ?',
            text: "ข้อมูลจะถูกลบอย่างถาวร !",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่ ฉันต้องการลบ!',
            cancelButtonText: 'ยกเลิก!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'index_admin.php',
                            type: 'GET',
                            data: 'delete=' + envId,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ข้อมูลถูกลบเรียบร้อย!',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = 'index_admin.php';
                            })
                        })
                        .fail(function() {
                            Swal.fire('มีบางอย่างผิดพลาด!', 'error')
                            window.location.reload();
                        });
                });
            },
        });
    }
</script>
    
</body>
</html>