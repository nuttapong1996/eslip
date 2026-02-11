<?php
session_start();
if(isset($_SESSION['empcode'_elip]) && isset($_POST['email']) && isset($_POST['birhtday'])){

    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'_elip];
    $email = $_POST['email'];
    $birhtday = $_POST['birhtday'];

    if(isset($_POST['update'])){
        if(isset($_POST['email'])){
            $user_update = "UPDATE tbl_regis SET email = :email ,birthdate = :birhtday WHERE emp_code = :empcode";
            $stmt = $conn->prepare($user_update);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':empcode', $empcode);
            $stmt->bindParam(':birhtday', $birhtday);
            $stmt->execute();
            header('location: ../user?manage=user_detail&update_success');

        }else{
            header('location: ../user?manage=user_detail&update_fail');
        }
    }
    //ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}


?>