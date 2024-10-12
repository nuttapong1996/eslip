<?php 
require_once 'backend/session.php';
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am"){
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
        </head>
        <body class="sb-nav-fixed bg-light ibm-plex-sans-thai-regular">
            <!-- topnav -->
            <?php include 'components/topnav.php'; ?>
            <div id="layoutSidenav">
                <!-- sidenav -->
                <?php include 'components/sidenav.php'; ?>
                <div id="layoutSidenav_content">
                    <?php 
                        switch ($_GET['manage']){
                            case 'users':
                                include './manage/manage_users.php';
                            break;
                            case 'edit':
                                include './manage/edit_user.php';
                            break;
                            case 'stat_user':
                                include './manage/stat_users.php';
                            break;
                            default:
                                include './manage/manage_users.php';
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
?>