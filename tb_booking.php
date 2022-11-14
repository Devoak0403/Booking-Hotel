<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $updatestmt = $conn->prepare("UPDATE room_all SET status = 'ว่าง' WHERE id_room ='$delete_id'");
        $updatestmt->execute();

        $deletestmt = $conn->query("SELECT pathfile FROM reservation WHERE id_room='$delete_id'");
        $deletestmt->execute();
        $rows = $deletestmt->fetchAll();

        foreach ($rows as $row) {

            $location=$row['pathfile'];
            if(unlink($location)){
                $deletestmt = $conn->query("DELETE FROM reservation WHERE id_room='$delete_id'");
                }
                if ($deletestmt) {
                    echo "<script>alert('ข้อมูลถูกลบเสร็จสมบูรณ์');</script>";
                    $_SESSION['success'] = "ข้อมูลถูกลบเสร็จสมบูรณ์";
                    header("refresh:1; url=tb_booknig.php");
                }
            }
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
                            <h2 class="pageheader-title"> ข้อมูลการจอง </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index_admin.php" class="breadcrumb-link">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลการจอง</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">รายการรอตรวจสอบ</h3>
                                        <hr>
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr align="center">
                                                        <th width='3%'>#</th>
                                                        <th width='10%'>เลขห้อง</th>
                                                        <th width='15%'>ชื่อ นามสกุลผู้จอง</th>
                                                        <th width='20%'>สถานะ</th>
                                                        <th width='20%'>วันที่ทำรายการ</th>
                                                        <th width='15%'>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php 
                                                    $stmt = $conn->query("SELECT * FROM reservation WHERE status_reser = 'รอการตรวจสอบ' ORDER BY r_id DESC");
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    
                                                    if (!$rows) {
                                                        echo "<tr><td colspan='10' class='text-center'>ไม่มีการทำรายการ</td></tr>";
                                                    } else {
                                                        foreach ($rows as $row) {
                                                ?>

                                                    <tr align="center">
                                                        <td><div align="center"><?= $row['r_id']; ?></th>
                                                        <td><?= $row['id_room']; ?></td>
                                                        <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                                        <td class="badge badge-warning mt-2"><?= $row['status_reser'] ?></td>
                                                        <td><?= $row['dateCreate']; ?></td>
                                                        <td>
                                                            <a href="tb_reservation.php?r_id=<?= $row['r_id']; ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"> ตรวจสอบ </i>
                                                            </a>
                                                            
                                                    </tr>
                                                    <?php } 
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">รายการจองสำเร็จ</h3>
                                        <hr>
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr align="center">
                                                        <th width='3%'>#</th>
                                                        <th width='10%'>เลขห้อง</th>
                                                        <th width='15%'>ชื่อ นามสกุลผู้จอง</th>
                                                        <th width='20%'>สถานะ</th>
                                                        <th width='20%'>วันที่ทำรายการ</th>
                                                        <th width='15%'>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php 
                                                    $stmt = $conn->query("SELECT * FROM reservation WHERE status_reser = 'จองสำเร็จ' ORDER BY r_id DESC");
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    
                                                    if (!$rows) {
                                                        echo "<tr><td colspan='10' class='text-center'>ไม่มีการทำรายการ</td></tr>";
                                                    } else {
                                                        foreach ($rows as $row) {
                                                ?>

                                                    <tr align="center">
                                                        <td><div align="center"><?= $row['r_id']; ?></th>
                                                        <td><?= $row['id_room']; ?></td>
                                                        <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                                        <td class="badge badge-success mt-2"><?= $row['status_reser'] ?></td>
                                                        <td><?= $row['dateCreate']; ?></td>
                                                        <td>
                                                            <a data-id="<?= $row['id_room']; ?>" href="?delete=<?= $row['id_room']; ?>" class="btn btn-danger delete-btn">Check Out</a>
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
                            url: 'tb_booking.php',
                            type: 'GET',
                            data: 'delete=' + envId,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ข้อมูลถูกลบเรียบร้อย!',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = 'tb_booking.php';
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