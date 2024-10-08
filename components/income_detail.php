<?php
if(isset($_SESSION['empcode']) && isset($_GET['id'])){
    
    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once('./includes/connect_db.php');

    //ตัวแปร id รับค่าจากฟอร์ม
    $code_slip =$_GET['id'];
    //ตัวแปรรหัสพนักงาน
    $empcode =$_SESSION['empcode'];

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
                <p><?php echo"งวดที่ : ".$detail_row['period_payslip'] ." "."วันที่ : ".date_format(date_create($detail_row['date_payslip']),"d/m/Y"); ?></p>
            </div>
            <div class="text-start">
                <p class="mt-2 mb-3 fs-6 text-dark text-decoration-none">รายได้สุทธิ (NET INCOME)</p>
                <p class="m-0 fs-4 text-end text-sq-dark text-decoration-none"><?php echo number_format($detail_row['total_net_income_payslip'],2); ?> บาท</p><br>
            </div>
            <div class="card-footer bg-white">
            </div>
        </div>
    </div>

    <h5  class="mt-4 fw-normal">รายละเอียดเพิ่มเติม</h5>
    <div class="table-responsive">
        <!-- รายการได้ (INCOME) -->   
            <table class="table table-borderless shadow-sm" style="background-color: #fff;">                              
                <tbody>
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
                            // OT 
                                echo"<tr>";
                                    echo "<td>OT 1</td>";
                                    echo "<td style='width:30px;'>".sprintf('%02d:00',$detail_row['ot1_hr_payslip'])."</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['ot1_baht_payslip'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                echo"<tr>";
                                    echo "<td>OT 1.5</td>";
                                    echo "<td>".sprintf('%02d:00',$detail_row['ot15_hr_payslip'])."</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['ot15_baht_payslip'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                echo"<tr>";
                                    echo "<td>OT 2</td>";
                                    echo "<td>".sprintf('%02d:00',$detail_row['ot2_hr_payslip'])."</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['ot2_baht_payslip'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                echo"<tr>";
                                    echo "<td>OT 3</td>";
                                    echo "<td>".sprintf('%02d:00',$detail_row['ot3_hr_payslip'])."</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['ot3_baht_payslip'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                            // 1.โบนัส หากไม่มีจะไม่แสดง
                                if($detail_row['in_bo01'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>โบนัส</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_bo01'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 2.ค่าเข้ากะเช้า หากไม่มีจะไม่แสดง
                                if($detail_row['in_a01'] > 0){
                                    echo"<tr>";
                                        echo "<td colspan='2'>ค่าเข้ากะเช้า</td>";
                                        echo "<td class='text-end'>".number_format($detail_row['in_a01'],2)."</td>";
                                        echo "<td>บาท</td>";
                                    echo"</tr>";
                                    }
                            // 3.ค่าชั่วโมง หากไม่มีจะไม่แสดง
                                if($detail_row['in_hr01'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าชั่วโมง</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_hr01'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 4.ค่าเที่ยว หากไม่มีจะไม่แสดง
                                if($detail_row['in_tr01'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าเที่ยว</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_tr01'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 5.ค่าตอบแทนพิเศษ หากไม่มีจะไม่แสดง
                                if($detail_row['in_sc01'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าตอบแทนพิเศษ</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_sc01'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 6.ค่าตอบแทนตามผลงาน หากไม่มีจะไม่แสดง
                                if($detail_row['in_in01'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าตอบแทน<br>ตามผลงาน</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_in01'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 7.ค่าทำงานต่างประเทศ หากไม่มีจะไม่แสดง
                                if($detail_row['in_al02'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าทำงานต่างประเทศ</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_al02'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 8.รายได้อื่นๆ หากไม่มีจะไม่แสดง
                                if($detail_row['in_al03'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>รายได้อื่นๆ</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['in_al03'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                        ?>
                        <tr class="text-success border-top">
                            <th colspan="2">รวมรายได้</th>
                            <th class="text-end"><?php echo number_format($detail_row['total_income_payslip'],2)?></th>
                            <th>บาท</th>
                        </tr>
                    <!-- end รายละเอียดรรายการได้ -->
                </tbody>
            </table>
        <!-- end รายการได้ (INCOME) -->
        <!-- รายการหัก(DEDUCTION) -->
            <table class="table table-borderless shadow-sm" style="background-color: #fff;">
                <tbody >
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

                            // 1.ค่าไฟ หากไม่มีจะไม่แสดง
                                if($detail_row['de_de02'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>ค่าไฟ</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['de_de02'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 2.เงินค้ำประกัน หากไม่มีจะไม่แสดง
                                if($detail_row['de_de05'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>เงินค้ำประกัน</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['de_de05'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 3.กยศ. หากไม่มีจะไม่แสดง
                                if($detail_row['de_slf1'] > 0){
                                echo"<tr>";
                                    echo "<td colspan='2'>กยศ.</td>";
                                    echo "<td class='text-end'>".number_format($detail_row['de_slf1'],2)."</td>";
                                    echo "<td>บาท</td>";
                                echo"</tr>";
                                }
                            // 4.หักอื่นๆ หากไม่มีจะไม่แสดง
                                if($detail_row['de_de06'] > 0){
                                    echo"<tr>";
                                        echo "<td colspan='2'>หักอื่นๆ</td>";
                                        echo "<td class='text-end'>".number_format($detail_row['de_de06'],2)."</td>";
                                        echo "<td>บาท</td>";
                                    echo"</tr>";
                                    }
                        ?>
                        <tr class="text-danger border-top ">
                            <th colspan="2">รวมรายหัก</th>
                            <th class="text-end"><?php echo number_format($detail_row['total_deductions_payslip'],2)?></th>
                            <th>บาท</th>
                        </tr>
                    <!-- end รายละเอียดรายการหัก(DEDUCTION) -->
                </tbody>
            </table>
        <!-- end รายการหัก(DEDUCTION) -->
        <!-- รายการสะสม -->
            <table class="table table-borderless shadow-sm" style="background-color: #fff;">
                <tbody >
                    <tr>
                        <th class="text-dark" colspan="4" style="border-bottom: 1.5px solid gray;">
                        รายการสะสม
                        </th>
                    </tr>
                    <!-- รายละเอียดรายการสะสม -->
                        <?php
                            echo"<tr>";
                                echo "<th colspan='2'>เงินได้สะสม</th>";
                                echo "<td class='text-end' style='width:120px;'>".number_format($detail_row['salary_or_year'],2)."</td>";
                                echo "<td style='width:10px;'>บาท</td>";
                            echo"</tr>";
                            echo"<tr>";
                                echo "<th colspan='2'>ภาษีสะสม</th>";
                                echo "<td class='text-end'>".number_format($detail_row['tax_or_year'],2)."</td>";
                                echo "<td>บาท</td>";
                            echo"</tr>";
                            echo"<tr>";
                                echo "<th colspan='2'>ประกันสังคมสะสม</th>";
                                echo "<td class='text-end'>".number_format($detail_row['sso_or_year'],2)."</td>";
                                echo "<td>บาท</td>";
                            echo"</tr>";
                            echo"<tr>";
                                echo "<th colspan='2'>กองทุนสำรอง<br>เลี้ยงชีพสะสม</th>";
                                echo "<td class='text-end'>".number_format($detail_row['pf_com_money_or_year'],2)."</td>";
                                echo "<td>บาท</td>";
                            echo"</tr>";
                        ?>
                </tbody>
        <!-- end รายละเอียดรายการสะสม -->
            </table>
    </div>
<?php 
    //ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    header('location: ../login');
}
?>