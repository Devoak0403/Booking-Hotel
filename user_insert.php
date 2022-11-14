<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 

    session_start();
    require_once "config/db.php";

    if (isset($_POST['signup'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $urole = $_POST['urole'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = $conn->prepare("INSERT INTO users(firstname, lastname, email, urole,tel, password) VALUES(:firstname, :lastname, :email,  :urole,  :tel, :password)");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":tel", $tel);
        $sql->bindParam(":password", $passwordHash);
        $sql->bindParam(":urole", $urole);
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
            header("refresh:2; url=tb_user.php");
        } else {
            $_SESSION['error'] = "ข้อมูลบันทึกไม่สำเร็จ!";
        }
    }
?>