<?php 
session_start();
if(isset($_SESSION['empcode'])){
// $title = "แก้ไขรหัสผ่าน";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include  './components/head.php'; ?>
    <title>ตั้งรหัสผ่านใหม่</title>
</head>
<body class="bg-gray ibm-plex-sans-thai-regular">
    <?php
        switch ($_GET['type']) {
            case 'password':
                include './manage/password.php';
                break;
            case 'user':
                include './manage/user.php';
                break;
            default:
                include './manage/user.php';
                break;
        }
    ?>
</body>
</html>
<?php }else{
    header('location:../login');
}