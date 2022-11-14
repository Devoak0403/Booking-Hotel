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
                        <div class="col-xl-12">
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success">
                                <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger">
                                <?php 
                                    echo $_SESSION['error']; 
                                    unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">

                                    <form action="user_bookingsql.php" method="post" enctype="multipart/form-data">
                                        
                                        <input type="text" value="<?= $row['u_id']; ?>" required class="form-control" name="u_id" hidden>
                                        
                                        <?php 
                                            if (isset($_GET['id_room'])) {
                                                $id = $_GET['id_room'];
                                                $stmt = $conn->query("SELECT * FROM room_all  WHERE id_room = '$id'");
                                                $stmt->execute();
                                                $data = $stmt->fetch();
                                            }
                                        ?>
                                        
                                        <input type="text" readonly value="<?= $data['id']; ?>" required class="form-control" name="id" hidden>
                                        
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                <label for="firstname" class="col-form-label">เลขห้อง :</label>
                                                    <input type="text" required class="form-control" name="id_room" value="<?= $data['id_room']; ?>" readonly>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="lastname" class="col-form-label">ราคา :</label>
                                                    <input type="text" required class="form-control" name="price_room" value="<?= $data['price']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label for="position" class="col-form-label">ชื่อผู้จอง :</label>
                                                    <input type="text" required class="form-control" name="firstname" value="">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="firstname" class="col-form-label">นามสกุลผู้จอง :</label>
                                                    <input type="text" required class="form-control" name="lastname" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label for="firstname" class="col-form-label">เบอร์โทรศัพท์ :</label>
                                                    <input type="tel" required class="form-control" name="tel" value="">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="firstname" class="col-form-label">อีเมล :</label>
                                                    <input type="email" required class="form-control" name="email" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label for="position" class="col-form-label">Check IN :</label>
                                                    <input type="datetime-local" required class="form-control" name="start_datetime" value="">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="firstname" class="col-form-label">Check OUT :</label>
                                                    <input type="datetime-local" required class="form-control" name="end_datetime" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <p class="mt-3">
                                        มัดจำค่าห้องจำนวนเงิน 500 บาท
                                        บัญชีธนาคาร : ไทยพานิชณ์ <br>
                                        เลขที่บัญชี : 045-2-00-00-000-0 <br>
                                        ชื่อบัญชี : นายสมชาย สมบูรณ์ 
                                        </p>

                                            <div class="mb-3">
                                                <label for="firstname" class="col-form-label">ธนาคาร :</label>
                                                <select class="custom-select" name="bank"> 
                                                    <option selected disabled="disabled">... เลือกธนาคารที่โอน ...</option>
                                                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                                    <option value="ธนาคารทหารไทย">ธนาคารทหารไทย</option>
                                                    <option value="ธนาคารแลนด์ แอนด์ เฮ้าส์">ธนาคารแลนด์ แอนด์ เฮ้าส์</option>
                                                    <option value="ธนาคารเกียรตินาคิน">ธนาคารเกียรตินาคิน</option>
                                                    <option value="ธนาคารซิตี้แบงก์">ธนาคารซิตี้แบงก์</option>
                                                    <option value="ธนาคารทิสโก้">ธนาคารทิสโก้</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstname" class="col-form-label">สลิปการชำระเงิน :</label>
                                                <input type="file" required class="form-control" name="filepayment" accept=".jpg,.png,.jpeg">
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

    <script type="text/javascript">
        
        $(function() {
            if ($('.ct-chart-pie').length) {
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($urole); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#1F618D",
                                "#F39C12"
                                
                            ],
                            data:<?php echo json_encode($cnt_user); ?>,
                            hoverBackgroundColor: [
                                "#5499C7",
                                "#F4D03F"
                            ]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'left',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Noto Sans Thai', 
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
                    }
                })
    </script>
    
    <script type="text/javascript">
      var ctx = document.getElementById(".ct-chart-pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($urole); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#1F618D",
                                "#F39C12"
                                
                            ],
                            data:<?php echo json_encode($cnt_user); ?>,
                            hoverBackgroundColor: [
                                "#5499C7",
                                "#F4D03F"
                            ]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'left',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Noto Sans Thai', 
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
                
    </script>
 
</html>