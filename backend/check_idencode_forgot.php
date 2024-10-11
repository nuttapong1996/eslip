<?php
// รับค่าจาก AJAX
if ( isset($_POST['empcode']) && isset($_POST['idencode'])) {
    //เรียกใช้งานฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_POST['empcode'];    
    $idencode = $_POST['idencode'];

    //Query  ยืนยันตัวตนในฐานข้อมูลก่อนทำการลงทะเบียน 
    $iden_active ="SELECT emp_code,iden_code FROM tbl_regis WHERE emp_code = :empcode AND iden_code = :idencode";
    $stmt_iden_active = $conn->prepare($iden_active);
    $stmt_iden_active->bindParam(':empcode', $empcode);
    $stmt_iden_active->bindParam(':idencode', $idencode);
    $stmt_iden_active->execute();

    // ตรวจสอบเลขบัตรประชาชนบนฐานข้อมูลพนักงาน tbl_emp
    if ($stmt_iden_active->rowCount() > 0) {
        echo 'found'; // มีเลขบัตรประชาชนในระบบ
    } else {
        echo 'none';  // ไม่พบเลขบัตรประชาชนในฐานข้อมูล
    }
    //ปิดการเชื่อมต่อฐานข้อมูล
    $conn=null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>
