<?php 

            if (isset($_SESSION['user_login'])) {
                $admin_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE u_id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <!-- ============================================================== -->
<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="../index_admin.php">จองห้องพัก | TECHSCAPE </a>
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
            </ul>
        </div>
    </nav>
</div>
<div class="nav-left-sidebar sidebar-dark"> 
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">เมนู</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <div class="nav-user-info">
                        <div class="row">
                            <div class="col-12 ">
                                <p class="text-center">
                                    <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
                                    <br>สถานะ : <?php echo $row['urole']?>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link " href="logout.php"  aria-expanded="false" ><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a>
                    </li>
                    <li class="nav-divider">
                        แดชบอร์ด
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="index_user.php"  aria-expanded="false" ><i class="fas fa-cog"></i>หน้าหลัก</a>
                    </li>
                    <li class="nav-divider">
                        การจัดการฐานข้อมูล
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link " href="user_viewreser.php"  aria-expanded="false" ><i class="fas fa-book"></i>ดูรายงานการจอง</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>
</div>