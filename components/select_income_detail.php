<?php 
    require_once('./includes/connect_db.php');

    $empcode = "2630065";

    if(!empty($empcode) && isset($_GET['id'])){
        $id = $_GET['id'];
        $empcode = $empcode;
       
        $sql ="SELECT * FROM tbl_payslip WHERE code_tbl_payslip = :id and code_emp_payslip = :empcode";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':empcode', $empcode);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="card border-primary text-white mb-4">
    <!-- card header -->
        <div class="card-header bg-sq d-flex justify-content-between">
            <h5 class="m-0"><?php echo"งวดที่ : ".$row['period_payslip']; ?></h5>
            <h5 class="m-0"><?php echo"วันที่ : ".date_format(date_create($row['date_payslip']),"d/m/Y"); ?></h5>
        </div>
    <!-- card body -->
        <div class="accordion" id="currentincome">
            <div class="accordion-item">
                <!-- Summary Headline -->
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed d-flex flex-column" type="button" data-bs-toggle="collapse" data-bs-target="#curincomedata" aria-expanded="false" aria-controls="curincomedata">                                
                            <p class="m-0 fs-4 fw-bolder text-success">รวมรายได้สุทธินี้</p><br>
                            <p class="m-0 fs-4 fw-bolder text-success"><?php echo number_format($row['total_net_income_payslip'],2); ?> บาท</p><br>
                            <p class="m-0 fs-6 fw-bold text-primary"><?php echo"รวมรายได้งวดนี้ : ".number_format($row['total_income_payslip'],2); ?> บาท</p><br>
                            <p class="m-0 fs-6 fw-bold text-danger"><?php echo "รวมรายการหักงวดนี้ : ". number_format($row['total_deductions_payslip'],2); ?> บาท</p>
                        </button>
                    </h2>
                <!-- Detail -->
                    <div id="curincomedata" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#currentincome">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table border-start border-end"> 
                                    <!-- รายการได้ (INCOME) -->                                             
                                        <tbody class="text-success ">
                                            <tr><th class="bg-success text-white" colspan="4">รายการได้ (INCOME)</th></tr>
                                            <!-- รายละเอียดรรายการได้ (INCOME)-->
                                            <?php 
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ค่าแรง/เงินเดือน</td>";
                                                    echo "<td>".number_format($row['period_salary_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ค่าครองชีพ</td>";
                                                    echo "<td>".number_format($row['costofliving_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                // OT หากไม่มีจะไม่แสดง
                                                if($row['ot1_hr_payslip'] > 0 || $row['ot15_hr_payslip'] > 0 || $row['ot2_hr_payslip'] > 0 || $row['ot3_hr_payslip'] > 0){
                                                echo"<tr>";
                                                    echo "<td>OT 1</td>";
                                                    echo "<td>".date('H:i',mktime($row['ot1_hr_payslip'],0))."</td>";
                                                    echo "<td>".number_format($row['ot1_baht_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td>OT 1.5</td>";
                                                    echo "<td>".date('H:i',mktime($row['ot15_hr_payslip'],0))."</td>";
                                                    echo "<td>".number_format($row['ot15_baht_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td>OT 2</td>";
                                                    echo "<td>".date('H:i',mktime($row['ot2_hr_payslip'],0))."</td>";
                                                    echo "<td>".number_format($row['ot2_baht_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td>OT 3</td>";
                                                    echo "<td>".date('H:i',mktime($row['ot3_hr_payslip'],0))."</td>";
                                                    echo "<td>".number_format($row['ot3_baht_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                }
                                                // ค่าชั่วโมง หากไม่มีจะไม่แสดง
                                                if($row['hourly_rate_payslip'] > 0){
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ค่าชั่วโมง</td>";
                                                    echo "<td>".number_format($row['hourly_rate_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                }
                                                // ค่าเที่ยว หากไม่มีจะไม่แสดง
                                                if($row['trip_cost_payslip'] > 0){
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ค่าเที่ยว</td>";
                                                    echo "<td>".number_format($row['trip_cost_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                }
                                            ?>
                                            <tr class="text-success text-decoration-underline">
                                                <th colspan="2">รวม</th>
                                                <th><?php echo number_format($row['total_income_payslip'],2)?></th>
                                                <th>บาท</th>
                                            </tr>
                                        </tbody>
                                    <!-- end รายการได้ (INCOME) -->
                                     
                                    <!-- รายการหัก(DEDUCTION) -->
                                        <tbody class="text-danger">
                                            <tr><th class="bg-danger text-white" colspan="4">รายการหัก(DEDUCTION)</th></tr>
                                            <!-- รายละเอียดรายการหัก(DEDUCTION) -->
                                            <?php
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ภาษี</td>";
                                                    echo "<td>".number_format($row['period_tax_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ประกันสังคม</td>";
                                                    echo "<td>".number_format($row['period_sso_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                echo"<tr>";
                                                    echo "<td colspan='2'>กองทุนสำรองเลี้ยงชีพ</td>";
                                                    echo "<td>".number_format($row['period_provident_fund_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";

                                                // ค่าไฟ หากไม่มีจะไม่แสดง
                                                if($row['electricity_bill_payslip'] > 0){
                                                echo"<tr>";
                                                    echo "<td colspan='2'>ค่าไฟ</td>";
                                                    echo "<td>".number_format($row['electricity_bill_payslip'],2)."</td>";
                                                    echo "<td>บาท</td>";
                                                echo"</tr>";
                                                }

                                            ?>
                                            <tr class="text-danger text-decoration-underline">
                                                <th colspan="2">รวม</th>
                                                <th><?php echo number_format($row['total_deductions_payslip'],2)?></th>
                                                <th>บาท</th>
                                            </tr>
                                        </tbody>
                                    <!-- end รายการหัก(DEDUCTION) -->
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- end Detail -->
            </div>                                    
        </div>
    <!-- end card body-->
</div>
<?php }else{ echo "<div class='alert alert-danger text-center'>ไม่พบข้อมูล</div>";} ?>
