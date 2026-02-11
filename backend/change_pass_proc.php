<?php
session_start();
if(isset($_POST['newpassword']) && isset($_SESSION['empcode_elip'])){
    //เรียกใช้ฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $newpassword = $_POST['newpassword'];
    $empcode = $_SESSION['empcode_elip'];

    $newhash = password_hash($newpassword, PASSWORD_DEFAULT);

    //Query reset new password and clear token
    $newpass = 'UPDATE tbl_regis SET password = :newpassword WHERE emp_code = :empcode';
    $stmt_newpass = $conn->prepare($newpass);
    $stmt_newpass->bindParam(':newpassword', $newhash);
    $stmt_newpass->bindParam(':empcode', $empcode);
    
    if($stmt_newpass->execute()){
        header("location: ../user?manage=password&reset_success");
    }else{
        header("location: ../user?manage=password&pass_error");
    
    }
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    header("location: ../user?manage=password&pass_error");
}
?>