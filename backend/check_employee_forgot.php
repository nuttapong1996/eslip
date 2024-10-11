<?php
// รับค่าจาก AJAX
if (isset($_POST['empcode'])) {
     //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_POST['empcode'];
    
    //Query  ยืนยันตัวตนในฐานข้อมูลก่อนทำการลงทะเบียน 
    $user_active ="SELECT emp_code FROM tbl_regis WHERE emp_code =:empcode";
    $stmt_user_active = $conn->prepare($user_active);
    $stmt_user_active->bindParam(':empcode', $empcode);
    $stmt_user_active->execute();

    //ตรวจสอบรหัสพนักงานบนฐานข้อมูลพนักงาน tbl_emp
    if ($stmt_user_active->rowCount() > 0) {
        echo 'active'; // มีรหัสพนักงานในระบบ
    } else {
        echo 'none';  // ไม่พบรหัสพนักงานในฐานข้อมูล
    }
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn=null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}



?>
