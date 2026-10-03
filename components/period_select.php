<?php
if(isset($_SESSION['empcode_elip'])){
    require_once('./includes/connect_db.php');

    // แสดงเฉพาะปีที่พนักงานที่เข้าสู่ระบบมีสลิป เพื่อไม่ให้เลือกงวดของผู้อื่น
    $yearlist = "SELECT year_payslip FROM tbl_payslip WHERE code_emp_payslip = :empcode GROUP BY year_payslip ORDER BY year_payslip DESC";
    $year_stmt = $conn->prepare($yearlist);
    $year_stmt->bindValue(':empcode', $_SESSION['empcode_elip']);
    $year_stmt->execute();
    $year_row = $year_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="input-group mb-3">
    <span class="input-group-text">ปี : </span>
    <select class="form-select form-select-sm" name="year" id="yearSelect" required>
    <option value="">เลือกปี</option>
        <?php foreach($year_row as $year){ ?>
            <option value="<?php echo $year['year_payslip']; ?>"><?php echo $year['year_payslip']; ?></option>
        <?php 
            }
            
        ?>
    </select>
</div>

<div class="input-group mb-3">
<span class="input-group-text">งวดที่ : </span>
    <select class="form-select form-select-sm" name="period1" id="salaryPeriods1" required>
        <option value="">เลือกงวด</option>
    </select>
</div>

<div class="input-group mb-3">
<span class="input-group-text">งวดที่ : </span>
    <select class="form-select form-select-sm" name="period2" id="salaryPeriods2" required>
        <option value="">เลือกงวด</option>
    </select>
</div>

<?php
    $conn = null;
}else{
    echo "<script>window.location.href = 'login';</script>";
}
?>
