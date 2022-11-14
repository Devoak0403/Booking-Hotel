<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 

    session_start();
    require_once "config/db.php";

    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $bank = $_POST['bank'];
        $id_room = $_POST['id_room'];
        $price_room = $_POST['price_room'];
        $start_datetime = $_POST['start_datetime'];
        $end_datetime = $_POST['end_datetime'];
        $u_id = $_POST['u_id'];
        $status_reser = 'รอการตรวจสอบ';
        

        $date1 = date("Ymd_His");
        $numrand = (mt_rand());
        $filepayment = (isset($_POST['filepayment']) ? $_POST['filepayment'] : '');
        $upload=$_FILES['filepayment']['name'];

        if($upload !='') {
        $typefile = strrchr($_FILES['filepayment']['name'],".");
        if($typefile =='.jpg' || $typefile =='.png' || $typefile =='.jpeg' || $typefile =='.gif'){
        $path="uploadpayment/";
        $newname = 'payment_'.$numrand.$date1.$typefile;
        $path_copy=$path.$newname;
        move_uploaded_file($_FILES['filepayment']['tmp_name'],$path_copy);
        
        $sql = $conn->prepare("INSERT INTO reservation(firstname, lastname, email, bank,tel ,id_room,price_room,start_datetime,end_datetime,status_reser, filepayment,pathfile,u_id  ) 
        VALUES(:firstname, :lastname, :email,  :bank,  :tel, :id_room,:price_room, :start_datetime, :end_datetime,:status_reser, '$newname','$path_copy',:u_id)");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":tel", $tel);
        $sql->bindParam(":bank", $bank);
        $sql->bindParam(":id_room", $id_room);
        $sql->bindParam(":price_room", $price_room);
        $sql->bindParam(":start_datetime", $start_datetime);
        $sql->bindParam(":end_datetime", $end_datetime);
        $sql->bindParam(":status_reser", $status_reser);
        $sql->bindParam(":u_id", $u_id);
        $sql->execute();

        $sql2 = $conn->prepare("UPDATE room_all SET status = 'เต็ม' WHERE id_room = :id_room");
        $sql2->bindParam(":id_room", $id_room);
        $sql2->execute();

        


        if ($sql && $sql2) {
            $_SESSION['success'] = "ข้อมูลถูกบันทึกเรียบร้อย";
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'จองห้องพักสำเร็จ',
                        text: 'ข้อมูลถูกบันทึกเรียบร้อย!',
                        icon: 'success',
                        timer: 7000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=index_user.php");
        } else {
            $_SESSION['error'] = "ข้อมูลบันทึกไม่สำเร็จ!";
        }
    }
}
}?>