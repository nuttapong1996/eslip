<?php 
require_once 'backend/session.php';
if(isset($_SESSION['empcode'])){
$title = "ข้อมูลผู้ใช้งาน";
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="manifest" href="manifest.json">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
            <?php include 'components/head.php'; ?>
        <title><?php echo $title; ?></title>
        </head>
        <script>
                // ฟังก์ชันตรวจสอบขนาดหน้าจอและเปลี่ยนไปหน้าหลัก
                function checkScreenSize() {
                    var width = window.innerWidth;
                    
                    // สมมติว่าขนาดจอเดสก์ท็อปมีความกว้างมากกว่า 1024px
                    if (width >= 1024) {
                        window.location.href = 'login';
                    }
                }
                // ตรวจสอบเมื่อทำการรีไซส์หน้าต่าง
                window.addEventListener('resize', checkScreenSize);
                // ตรวจสอบขนาดหน้าจอเมื่อหน้าโหลดครั้งแรก
                window.addEventListener('load', checkScreenSize);
        </script>
        <body class="sb-nav-fixed bg-light ibm-plex-sans-thai-regular">
            <!-- topnav -->
            <?php include 'components/topnav.php'; ?>
            <div id="layoutSidenav">
                <div id="layoutSidenav_content">
                    <nav class="sb-sidenav bg-light " id="sidenavAccordion">
                        <div class="sb-sidenav-menu bg-light">
                            <div class="nav">
                                <div class="user_profile text-sq mb-2">
                                <div class="sb-sidenav-menu-heading text-center fs-6 pt-0">รหัสพนักงาน :<?php echo $_SESSION['empcode']; ?> </div>
                                    <div class="user-pic">
                                        <?php include 'components/emp_pic_b.php'; ?>
                                    </div>
                                    <h6 class="mt-3 mb-0 fs-5"><?php echo $_SESSION['name']; ?> </h6>
                                    <small class="mt-0"><b>ตำแหน่ง :</b> <?php echo $_SESSION['position']; ?> <br><b> แผนก/ฝ่าย :</b> <?php echo $_SESSION['dept_emp']; ?> </small>
                                </div>
                                <div class="menu_section bg-white">
                                    <div class="sb-sidenav-menu-heading p-2 fs-6 bg-sq-dark text-white">การจัดการ</div>
                                    <a class="nav-link text-sq p-3 fs-5 border-bottom" href="user?manage=user_detail">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                                        รายละเอียดผู้ใช้งาน
                                    </a>
                                    <a class="nav-link text-sq p-3 fs-5" href="user?manage=password">
                                        <div class="sb-nav-link-icon"><i class="fas fa-unlock-alt"></i></div>
                                        เปลี่ยนรหัสผ่าน
                                    </a>
                                    
                                    <?php if(trim($_SESSION['role']) == "am"){?>
                                    <div class="sb-sidenav-menu-heading p-2 fs-6 bg-warning text-sq-dark">ส่วนของ Admin</div>
                                    <a class="nav-link text-sq p-3 fs-5 border-bottom" href="./admin?manage=users">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                                        การจัดการผู้ใช้งาน
                                    </a>
                                    <a class="nav-link text-sq p-3 fs-5 border-bottom" href="./admin?manage=stat_user">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                        ยอดผู้สมัครใช้งาน
                                    </a>                           
                                <?php } ?>

                                    <a class="nav-link text-white bg-danger " href="logout.php">
                                        <div class="sb-nav-link-icon">ออกจากระบบ &nbsp;<i class="fas fa-right-from-bracket"></i></div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <small class="text-danger text-center mt-2"><span id="session-time">Loading...</span></small>
                        <div class="sb-sidenav-footer text-center" style="font-size: 0.5rem">
                            <a class="text-decoration-none text-muted">Developed by IT Department (Maemoh)<br>Copyright &copy; Sahakol Equipment PCL. 2024 - <?php echo date('Y'); ?></a>
                        </div>
                    </nav>
                </div>
            </div>
            
            <div class="mobilenav">
                <?php include 'components/bottomnav.php'; ?>
            </div>
        </body>
    </html>
<?php 
}else{
    header('location:login');
}
?>
