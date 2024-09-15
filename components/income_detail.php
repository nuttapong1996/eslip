<?php
    require_once('./includes/connect_db.php');

    $code_slip =$_GET['id'];
    $empcode ='2630065';

    $detail = "SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND code_tbl_payslip = :code_slip";
    $detail_stmt = $conn->prepare($detail);
    $detail_stmt->bindParam(':empcode', $empcode);
    $detail_stmt->bindParam(':code_slip', $code_slip);
    $detail_stmt->execute();
    $detail_row = $detail_stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="card rounded-0 mb-2 border-0 shadow-sm">
     <div class="card-body d-flex flex-column">
        <div class="text-start" style="font-size: 0.9rem;">
            <!-- <p class="text-muted">รายได้สุทธิ</p> -->
            <p><?php echo"งวดที่ : ".$detail_row['period_payslip'] ." "."วันที่ : ".date_format(date_create($detail_row['date_payslip']),"d/m/Y"); ?></p>
        </div>
        <div class="text-start">
            <p class="mt-2 mb-0 fs-5 text-dark text-decoration-none">รายได้สุทธิ</p>
            <p class="m-0 fs-4 text-end text-sq-dark text-decoration-none"><?php echo number_format($detail_row['total_net_income_payslip'],2); ?> บาท</p><br>
        </div>
        <div class="card-footer bg-white">
        <div class="text-start text-success">
            <p class="mt-2 mb-0  text-decoration-none">รายได้รวม</p>
            <p class="text-end mb-0"><?php echo number_format($detail_row['total_income_payslip'],2); ?> บาท</p>
        </div>
        <div class="text-start text-danger">
            <p class="mt-2 mb-0  text-decoration-none">รวมรายหัก</p>
            <p class="text-end mb-0"><?php echo number_format($detail_row['total_deductions_payslip'],2); ?> บาท</p>
        </div>
        </div>
     </div>
</div>

<h5  class="mt-4 fw-normal">รายละเอียดเพิ่มเติม</h5>
<div class="table-responsive">
    <table class="table table-borderless shadow-sm" style="background-color: #fff;"> 
        <!-- รายการได้ (INCOME) -->                                             
            <tbody  style="">
                <tr>
                    <th class="text-success" colspan="4" style="border-bottom: 1.5px solid green;">
                        รายการได้ (INCOME)
                    </th>
                </tr>
                <!-- รายละเอียดรรายการได้ (INCOME)-->
                <?php 
                    echo"<tr>";
                        echo "<td colspan='2'>ค่าแรง/เงินเดือน</td>";
                        echo "<td class='text-end' style='width:120px;'>".number_format($detail_row['period_salary_payslip'],2)."</td>";
                        echo "<td style='width:10px;'>บาท</td>";
                    echo"</tr>";
                    echo"<tr>";
                        echo "<td colspan='2'>ค่าครองชีพ</td>";
                        echo "<td class='text-end'>".number_format($detail_row['in_co1'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    // OT หากไม่มีจะไม่แสดง
                    if($detail_row['ot1_hr_payslip'] > 0 || $detail_row['ot15_hr_payslip'] > 0 || $detail_row['ot2_hr_payslip'] > 0 || $detail_row['ot3_hr_payslip'] > 0){
                    echo"<tr>";
                        echo "<td>OT 1</td>";
                        echo "<td style='width:30px;'>".date('H:i',mktime($detail_row['ot1_hr_payslip'],0))."</td>";
                        echo "<td class='text-end'>".number_format($detail_row['ot1_baht_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    echo"<tr>";
                        echo "<td>OT 1.5</td>";
                        echo "<td>".date('H:i',mktime($detail_row['ot15_hr_payslip'],0))."</td>";
                        echo "<td class='text-end'>".number_format($detail_row['ot15_baht_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    echo"<tr>";
                        echo "<td>OT 2</td>";
                        echo "<td>".date('H:i',mktime($detail_row['ot2_hr_payslip'],0))."</td>";
                        echo "<td class='text-end'>".number_format($detail_row['ot2_baht_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    echo"<tr>";
                        echo "<td>OT 3</td>";
                        echo "<td>".date('H:i',mktime($detail_row['ot3_hr_payslip'],0))."</td>";
                        echo "<td class='text-end'>".number_format($detail_row['ot3_baht_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    }
                    // ค่าชั่วโมง หากไม่มีจะไม่แสดง
                    if($detail_row['in_hr01'] > 0){
                    echo"<tr>";
                        echo "<td colspan='2'>ค่าชั่วโมง</td>";
                        echo "<td class='text-end'>".number_format($detail_row['hourly_rate_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    }
                    // ค่าเที่ยว หากไม่มีจะไม่แสดง
                    if($detail_row['in_tr01'] > 0){
                    echo"<tr>";
                        echo "<td colspan='2'>ค่าเที่ยว</td>";
                        echo "<td class='text-end'>".number_format($detail_row['trip_cost_payslip'],2)."</td>";
                        echo "<td>บาท</td>";
                    echo"</tr>";
                    }
                ?>
                <tr class="text-success">
                    <th colspan="2">รวม</th>
                    <th><?php echo number_format($detail_row['total_income_payslip'],2)?></th>
                    <th>บาท</th>
                </tr>
            </tbody>
        </table>
        <!-- end รายการได้ (INCOME) -->
        <!-- รายการหัก(DEDUCTION) -->
            <table class="table table-borderless shadow-sm" style="background-color: #fff;">
                <tbody class="text-danger">
                    <tr>
                        <th class="text-danger" colspan="4" style="border-bottom: 1.5px solid red;">
                            รายการหัก(DEDUCTION)
                        </th>
                    </tr>
                    <!-- รายละเอียดรายการหัก(DEDUCTION) -->
                    <?php
                        echo"<tr>";
                            echo "<td colspan='2'>ภาษี</td>";
                            echo "<td class='text-end' style='width:120px;'>".number_format($detail_row['period_tax_payslip'],2)."</td>";
                            echo "<td style='width:10px;'>บาท</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo "<td colspan='2'>ประกันสังคม</td>";
                            echo "<td class='text-end'>".number_format($detail_row['period_sso_payslip'],2)."</td>";
                            echo "<td>บาท</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo "<td colspan='2'>กองทุนสำรองเลี้ยงชีพ</td>";
                            echo "<td class='text-end'>".number_format($detail_row['period_provident_fund_payslip'],2)."</td>";
                            echo "<td>บาท</td>";
                        echo"</tr>";

                        // ค่าไฟ หากไม่มีจะไม่แสดง
                        if($detail_row['de_de02'] > 0){
                        echo"<tr>";
                            echo "<td colspan='2'>ค่าไฟ</td>";
                            echo "<td class='text-end'>".number_format($detail_row['de_de02'],2)."</td>";
                            echo "<td>บาท</td>";
                        echo"</tr>";
                        }

                    ?>
                    <tr class="text-danger">
                        <th colspan="2">รวม</th>
                        <th><?php echo number_format($detail_row['total_deductions_payslip'],2)?></th>
                        <th>บาท</th>
                    </tr>
                </tbody>
            </table>
        <!-- end รายการหัก(DEDUCTION) -->
</div>