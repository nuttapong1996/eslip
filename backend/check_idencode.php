<?php

// รับค่าจาก AJAX
if ( isset($_POST['empcode']) && isset($_POST['idencode'])) {
// if (isset($_POST['idencode'])) {
     //เรียกใช้งานไฟล์ connect_db.php
 require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_POST['empcode'];    
    $idencode = $_POST['idencode'];

    //Query  ยืนยันตัวตนในฐานข้อมูลก่อนทำการลงทะเบียน 
    $iden_active ="SELECT * FROM tbl_emp WHERE code_emp = :empcode AND id_card_number_emp = :idencode AND status_emp = 10";
    // $iden_active ="SELECT * FROM tbl_emp WHERE id_card_number_emp = :idencode AND status_emp = 10";
    $stmt_iden_active = $conn->prepare($iden_active);
    $stmt_iden_active->bindParam(':empcode', $empcode);
    $stmt_iden_active->bindParam(':idencode', $idencode);
    $stmt_iden_active->execute();

    // 1.ตรวจสอบรหัสพนักงานบนฐานข้อมูลพนักงาน tbl_emp
    if ($stmt_iden_active->rowCount() > 0) {
        echo 'found'; // มีรหัสพนักงานในระบบ
    } else {
        echo 'none';  // ไม่พบรหัสพนักงานในฐานข้อมูล
    }
    $conn=null;
}else{
    header('location: ../login');
}
?>
