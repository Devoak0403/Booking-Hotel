
    <?php 

session_start();
require_once "config/db.php";
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: loginpage.php');
}


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM users WHERE u_id = $delete_id");
    $deletestmt->execute();
    
    if ($deletestmt) {
        echo "<script>alert('ข้อมูลถูกลบเสร็จสมบูรณ์');</script>";
        $_SESSION['success'] = "ข้อมูลถูกลบเสร็จสมบูรณ์";
        header("refresh:1; url=dev_user.php");
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
<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>จองห้องพัก | Admin</title>
</head>


<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">

        <?php 

        if (isset($_SESSION['admin_login'])) {
            $admin_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE u_id = $admin_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>

        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index_admin.php">BPIHospital | Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div>
                    </li>
                    <div class="nav-user-info">
                        <p><?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
                        <br>สถานะ : <?php echo $row['urole']?></p>
                    </div>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>บัญชีของฉัน</a>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
        
<!-- left sidebar -->
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<!-- ============================================================== -->
<!-- end left sidebar -->

    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        
                        <div class="page-header">
                            <h2 class="pageheader-title"> เพิ่มห้อง </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index_admin.php" class="breadcrumb-link">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">เพิ่มห้อง</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">เพิ่มห้อง</h4>
                                </div>
                                <div class="card-body">
                                    <form action="room_insert.php" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                    <label for="firstname" class="col-form-label">รหัสห้อง :</label>
                                        <input type="text" required class="form-control" name="id_room">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastname" class="col-form-label" >ประเภทห้อง :</label>
                                        <select class="custom-select" name="group_room">
                                        <?php 
                                        require_once 'config/db.php';
                                            $stmt = $conn->query("SELECT * FROM group_room  ORDER BY id ASC");
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();

                                            if (!$rows) {
                                                echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                                            } else {
                                                foreach ($rows as $row) {
                                                    ?>
                                            <option value="<?= $row['id']; ?>"><?php echo $row['room_name']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastname" class="col-form-label" >ชื่อห้อง :</label>
                                        <select class="custom-select" name="room_name">
                                        <?php 
                                            $stmt = $conn->query("SELECT * FROM group_room  ORDER BY id ASC");
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();

                                            if (!$rows) {
                                                echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                                            } else {
                                                foreach ($rows as $row) {
                                                    ?>
                                            <option value="<?= $row['room_name']; ?>"><?php echo $row['room_name']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="col-form-label">ราคา :</label>
                                        <input type="text" required class="form-control" name="price">
                                    </div>
                                        <div class="modal-footer">
                                            <button type="reset" name="submit" class="btn btn-danger">ล้าง</button>
                                            <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
<!-- ============================================================== -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/js/data-table.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="assets/libs/js/main-js.js"></script>

</body>

</html>










