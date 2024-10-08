<?php
// รับค่าจาก AJAX
if (isset($_POST['empcode'])) {
     //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_POST['empcode'];
    
    //Query  ยืนยันตัวตนในฐานข้อมูลก่อนทำการลงทะเบียน 
    $user_active ="SELECT code_emp FROM tbl_emp WHERE code_emp =:empcode AND status_emp = 10";
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
    header('location: ../login');
}



?>
