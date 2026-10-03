<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['empcode_elip']) && isset($_POST['year'])) {

    // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once('../includes/connect_db.php');

    // รับค่าปีจาก AJAX
    $year = $_POST['year'];
    $empcode = $_SESSION['empcode_elip'];

    // สร้าง SQL query เพื่อดึงข้อมูลจำนวนงวดเงินเดือนจากฐานข้อมูล
    $sql = "SELECT period_payslip FROM tbl_payslip WHERE year_payslip = :year AND code_emp_payslip = :empcode GROUP BY period_payslip ORDER BY period_payslip ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':empcode', $empcode);
    $stmt->execute();

    // เก็บข้อมูลเป็น array
    $salaryPeriods = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $salaryPeriods[] = $row;
    }

    // ส่งผลลัพธ์กลับไปในรูปแบบ JSON
    echo json_encode($salaryPeriods);
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn=null;
}else{
    http_response_code(401);
    echo json_encode(['error' => 'กรุณาเข้าสู่ระบบใหม่']);
}
?>
