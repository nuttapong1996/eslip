<?php 
require_once 'backend/session.php';
if(isset($_SESSION['empcode_elip'])){
$title = "การจัดการ";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="manifest" href="manifest.json">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <?php include  './components/head.php'; ?>
        <!-- <title><?php //echo $title ?></title> -->
    </head>
    <body class="sb-nav-fixed bg-gray ibm-plex-sans-thai-regular">
        <!-- topnav -->
        <?php include 'components/topnav.php'; ?>
            <div id="layoutSidenav">
            <!-- sidenav -->
                <?php include 'components/sidenav.php'; ?>
                <div id="layoutSidenav_content">
                    <?php
                        switch ($_GET['manage']) {
                            case 'password':                
                                include './manage/newpass.php';
                            break;
                            case 'user_detail':
                                include './manage/user_detail.php';
                            break;
                            default:
                                include './manage/user_detail.php';
                            break;
                        }
                    ?>
                    <div class="py-5"></div>
                    <!-- footer -->
                    <div class="desktop">
                        <?php include 'components/foot.php'; ?>  
                    </div>
                </div>
            </div>
            <div class="mobilenav">
                <?php include 'components/bottomnav.php'; ?>
            </div>
    </body>
    </html>
<?php 
}else{
    echo "<script>window.location.href = 'login';</script>";
}

if(isset($_GET['pass_error'])){
    echo "<script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณาตรวจสอบและทำรายการอีกครั้ง',
                icon: 'error',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=password';
            })
        </script>";    
}
if(isset($_GET['reset_success'])){
    echo "<script>
            Swal.fire({
                title: 'เปลี่ยนรหัสผ่านสําเร็จ',
                icon: 'success',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=password';
            })
        </script>";    
}
?>