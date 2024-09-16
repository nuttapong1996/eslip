
<?php 
       require_once('../includes/connect_db.php');

// รับค่าปีจาก AJAX
$year = $_POST['year'];


// สร้าง SQL query เพื่อดึงข้อมูลจำนวนงวดเงินเดือนจากฐานข้อมูล
$sql = "SELECT period_payslip FROM tbl_payslip  WHERE year_payslip =:year GROUP BY period_payslip ORDER BY period_payslip ASC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':year', $year);
$stmt->execute();

// เก็บข้อมูลเป็น array
$salaryPeriods = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $salaryPeriods[] = $row;
}

// ส่งผลลัพธ์กลับไปในรูปแบบ JSON

echo json_encode($salaryPeriods);
$conn=null;
?>
