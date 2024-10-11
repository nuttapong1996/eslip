<?php
// รับค่าจาก AJAX
if (isset($_POST['empcode'])) {
     //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_POST['empcode'];
    // $empcode = "2630065";
    
    //Query  ยืนยันตัวตนในฐานข้อมูลก่อนทำการลงทะเบียน 
    $user_active ="SELECT code_emp,name_thai_emp ,id_card_number_emp FROM tbl_emp WHERE code_emp =:empcode AND status_emp = 10";
    $stmt_user_active = $conn->prepare($user_active);
    $stmt_user_active->bindParam(':empcode', $empcode);
    $stmt_user_active->execute();

    $user_detail = array();

    //ตรวจสอบรหัสพนักงานบนฐานข้อมูลพนักงาน tbl_emp
    if ($stmt_user_active->rowCount() > 0) {
        while($row = $stmt_user_active->fetch(PDO::FETCH_ASSOC)) {
            $user_detail[] = $row; 
            
        }
        echo json_encode($user_detail);
        // echo 'active'; // มีรหัสพนักงานในระบบ
    } else {
        echo 'none';  // ไม่พบรหัสพนักงานในฐานข้อมูล
    }
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn=null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}



?>
