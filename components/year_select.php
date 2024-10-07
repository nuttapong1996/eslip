<?php
    require_once('./includes/connect_db.php');

    $yearlist= "SELECT year_payslip FROM tbl_payslip GROUP BY year_payslip ORDER BY year_payslip DESC";
    $year_stmt = $conn->prepare($yearlist);
    $year_stmt->execute();
    $year_row = $year_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <label class="input-group-text" for="slipyear">ปี : </label>
    <select class="form-select form-select-sm" name="slipyear" id="slipyear" required>
    <option value="">กรุณาเลือกปี</option>
        <?php foreach($year_row as $year){ ?>
            <option value="<?php echo $year['year_payslip']; ?>"><?php echo $year['year_payslip']; ?></option>
        <?php 
            $conn = null;
            }
        ?>
    </select>