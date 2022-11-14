<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 

    session_start();
    require_once "config/db.php";

    if (isset($_POST['submit'])) {
        $id_room = $_POST['id_room'];
        $group_room = $_POST['group_room'];
        $price = $_POST['price'];
        $room_name = $_POST['room_name'];
        $status = 'ว่าง';

        $sql = $conn->prepare("INSERT INTO room_all(id_room, group_room, price, room_name,status) VALUES(:id_room, :group_room, :price, :room_name, :status)");
        $sql->bindParam(":id_room", $id_room);
        $sql->bindParam(":group_room", $group_room);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":room_name", $room_name);
        $sql->bindParam(":status", $status);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "ข้อมูลถูกบันทึกเรียบร้อย";
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ข้อมูลถูกบันทึกเรียบร้อย!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=index_admin.php");
        } else {
            $_SESSION['error'] = "ข้อมูลบันทึกไม่สำเร็จ!";
        }
    }
?>