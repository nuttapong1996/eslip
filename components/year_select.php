<?php
if(isset($_SESSION['empcode'])){
    // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once('./includes/connect_db.php');

    // Query เลือกปี
    $yearlist= "SELECT year_payslip FROM tbl_payslip GROUP BY year_payslip ORDER BY year_payslip DESC";
    $year_stmt = $conn->prepare($yearlist);
    $year_stmt->execute();
    $year_row = $year_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <label class="input-group-text" for="slipyear">ปี : </label>
    <select class="form-select form-select-sm" name="slipyear" id="slipyear" required>
    <option value="">กรุณาเลือกปี</option>
        <?php foreach($year_row as $year){ 
            if(isset($_POST['slipyear']) && $_POST['slipyear'] == $year['year_payslip']){?>
            <option value="<?php echo $year['year_payslip']; ?>" selected><?php echo $year['year_payslip']; ?></option>
        <?php }else{ ?>
            <option value="<?php echo $year['year_payslip']; ?>" ><?php echo $year['year_payslip']; ?></option>
        <?php  }
        }?>
    </select>
<?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>