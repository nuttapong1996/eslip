<?php 
    $year = date("Y");
    $empcode = "2630065";

    require_once('./includes/connect_db.php');

    $sql ="SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year ORDER BY period_payslip DESC";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':empcode', $empcode);
   $stmt->bindParam(':year', $year);
   $stmt->execute();

?>

<div class="card border-sq-orange text-sq-dark mb-4 p-0">
    <div class="card-header bg-sq-orange text-sq-dark fw-bold">
        <i class="fas fa-table me-1"></i><?php echo "รายการย้อนหลังปี ".$year; ?>
    </div>
    <div class="card-body text-sq-dark">
        <table id="datatablesSimple">
            <thead>
                <th>งวดที่</th>
                <th>วันที่</th>
                <th>รายได้สุทธิ</th>
                <th><i class="fa-solid fa-circle-info"></i></th>
            </thead>
            <tbody class="text-sq-dark">

                <?php
                foreach($stmt as $row){
                    echo"<tr>";
                    echo"<td>". $row['period_payslip']."</td>";
                    echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                    echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                    echo"<td><a class='btn btn-sm btn-primary' href='./select_income.php?id=". $row['code_tbl_payslip']."&prd=". $row['period_payslip']."&dp=". $row['date_payslip']."'><i class='fa-solid fa-eye'></i></a></td>";
                    echo"</tr>";                
                }  ?>
            </tbody>
        </table>
    </div> 
</div>
