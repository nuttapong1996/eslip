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
    <?php include 'components/head.php'; ?>
   <title><?php echo $title; ?></title>
</head>
<body class="sb-nav-fixed bg-light ibm-plex-sans-thai-regular">
    <!-- topnav -->
    <?php include 'components/topnav.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <nav class="sb-sidenav bg-light " id="sidenavAccordion">
                <div class="sb-sidenav-menu bg-light mb-2">
                    <div class="nav">
                        <div class="user_profile text-sq">
                        <div class="sb-sidenav-menu-heading text-center">ข้อมูลผู้ใช้งาน</div>
                            <div class="user-pic">
                                <img src="assets/images/test.png" class="rounded-circle" width="100px" alt="">                       
                            </div>
                            <!-- <i class="fas fa-user-circle fa-4x"></i> -->
                            <h6 class="mt-3 fs-5"><?php echo $_SESSION['name']; ?> </h6>
                            <h6 class="fw-normal fs-6 mb-0"><?php echo $_SESSION['empcode']; ?> </h6>
                            <h6 class="mt-1 fs-6">แผนก/ฝ่าย : <?php echo $_SESSION['dept_emp']; ?> </h6>
                            <h6 class="fw-normal fs-6">ตำแหน่ง : <?php echo $_SESSION['position']; ?> </h6>
                            <div class="small text-danger"><span id="session-time">Loading...</span></div>
                        </div>
                        <div class="menu_section bg-white">
                            <div class="sb-sidenav-menu-heading p-2 fs-6 bg-sq-dark text-white">การจัดการ</div>
                            <a class="nav-link text-sq p-3 fs-5 border-bottom" href="user?manage=user_detail">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                                ข้อมูลผู้ใช้งาน
                            </a>
                            <a class="nav-link text-sq p-3 fs-5" href="user?manage=password">
                                <div class="sb-nav-link-icon"><i class="fas fa-unlock-alt"></i></div>
                                เปลี่ยนรหัสผ่าน
                            </a>
                           
                            <a class="nav-link text-white bg-danger" href="logout.php">
                                <div class="sb-nav-link-icon ">ออกจากระบบ &nbsp;<i class="fas fa-right-from-bracket"></i></div>
                            </a>
                           
                        </div>
                    </div>
                </div>
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
<?php }else{
    header('location:login');
}
?>
