<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 

    session_start();
    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $r_id = $_POST['r_id'];
        $status_reser = $_POST['status_reser'];
        
        

        $sql = $conn->prepare("UPDATE reservation SET status_reser = 'จองสำเร็จ' WHERE r_id = :r_id");
        $sql->bindParam(":r_id", $r_id);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "ข้อมูลถูกแก้ไขเรียบร้อย";
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'อนุมัติการจองเรียบร้อย!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=tb_booking.php");
        } else {
            $_SESSION['error'] = "แก้ไขข้อมูลไม่สำเร็จ";
            header("location: tb_booking.php");
        }
    }

?>
