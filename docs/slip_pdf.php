<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/connect_db.php';

// $mpdf = new \Mpdf\Mpdf(['debug' => true]);
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage'); 
$mpdf->AddPage('L'); 

date_default_timezone_set('Asia/Bangkok');

$year1 = "2024";
$year2 = "2024";
$period1 ="15";
$period2 ="16";

$empcode = "2630065";
// $empcode = "2530151"; //ค่าไฟ พี่แซ็ก
// $empcode = "2600217"; // test ค่าไฟ
// $empcode = "2600051"; //กยศ
// $empcode ="2620268"; //พี่ตูน
// $empcode ="2670087"; //พี่ท็อป


$sql = "SELECT * FROM tbl_payslip WHERE code_emp_payslip =:empcode 
        AND  year_payslip BETWEEN :year1 AND :year2
        AND period_payslip  BETWEEN :period1 AND :period2 ORDER BY code_tbl_payslip ASC";


$stmt = $conn->prepare($sql);
$stmt->bindParam(':empcode', $empcode);
$stmt->bindParam(':year1', $year1);
$stmt->bindParam(':year2', $year2);
$stmt->bindParam(':period1', $period1);
$stmt->bindParam(':period2', $period2);
$stmt->execute();


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

//รายการได้
    // ประกาศตัวแปร Label 
        $in1="";
        $in2="";
        $in3="";
        $in4="";
      

    // ประกาศตัวแปร Value 
        $in_val1="";
        $in_val2="";
        $in_val3="";
        $in_val4="";


    // 1.ค่าชั่วโมง
        //บรรทัด 1
        if($row['in_hr01'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าชั่วโมง";
            $in_val1 = number_format($row['in_hr01'],2);
        //บรรทัด 2
        }else if($row['in_hr01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าชั่วโมง";
            $in_val2 =   number_format($row['in_hr01'],2);
        //บรรทัด 3
        }else if($row['in_hr01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าชั่วโมง";
            $in_val3 =  number_format($row['in_hr01'],2);
        //บรรทัด 4
        }else if($row['in_hr01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าชั่วโมง";
            $in_val4 =  number_format($row['in_hr01'],2);
        }

    // 2.ค่าเที่ยว
        //บรรทัด 1
        if($row['in_tr01'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าเที่ยว";
            $in_val1 = number_format($row['in_tr01'],2);
        //บรรทัด 2
        }else if($row['in_tr01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าเที่ยว";
            $in_val2 =   number_format($row['in_tr01'],2);
        //บรรทัด 3
        }else if($row['in_tr01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าเที่ยว";
            $in_val3 =  number_format($row['in_tr01'],2);
        //บรรทัด 4
        }else if($row['in_tr01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าเที่ยว";
            $in_val4 =  number_format($row['in_tr01'],2);
        }
    
    // 3.ค่าเข้ากะเช้า
        //บรรทัด 1
        if($row['in_a01'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าเข้ากะเช้า";
            $in_val1 = number_format($row['in_a01'],2);
        //บรรทัด 2
        }else if($row['in_a01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าเข้ากะเช้า";
            $in_val2 =   number_format($row['in_a01'],2);
        //บรรทัด 3
        }else if($row['in_a01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าเข้ากะเช้า";
            $in_val3 =  number_format($row['in_a01'],2);
        //บรรทัด 4
        }else if($row['in_a01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าเข้ากะเช้า";
            $in_val4 =  number_format($row['in_a01'],2);
        }
    
    // 4.ค่าทำงานต่างประเทศ
        //บรรทัด 1
        if($row['in_al02'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าทำงานต่างประเทศ";
            $in_val1 = number_format($row['in_al02'],2);
        //บรรทัด 2
        }else if($row['in_al02'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าทำงานต่างประเทศ";
            $in_val2 =   number_format($row['in_al02'],2);
        //บรรทัด 3
        }else if($row['in_al02'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าทำงานต่างประเทศ";
            $in_val3 =  number_format($row['in_al02'],2);
        //บรรทัด 4
        }else if($row['in_al02'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าทำงานต่างประเทศ";
            $in_val4 =  number_format($row['in_al02'],2);
        }
    
    // 5.รายได้อื่นๆ
        //บรรทัด 1
        if($row['in_al03'] <> 0 && $in1 == "" ){ 
            $in1 ="รายได้อื่นๆ";
            $in_val1 = number_format($row['in_al03'],2);
        //บรรทัด 2
        }else if($row['in_al03'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="รายได้อื่นๆ";
            $in_val2 =   number_format($row['in_al03'],2);
        //บรรทัด 3
        }else if($row['in_al03'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="รายได้อื่นๆ";
            $in_val3 =  number_format($row['in_al03'],2);
        //บรรทัด 4
        }else if($row['in_al03'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="รายได้อื่นๆ";
            $in_val4 =  number_format($row['in_al03'],2);
        }

    // 6.โบนัส
        //บรรทัด 1
        if($row['in_bo01'] <> 0 && $in1 == "" ){ 
            $in1 ="โบนัส";
            $in_val1 = number_format($row['in_bo01'],2);
        //บรรทัด 2
        }else if($row['in_bo01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="โบนัส";
            $in_val2 =   number_format($row['in_bo01'],2);
        //บรรทัด 3
        }else if($row['in_bo01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="โบนัส";
            $in_val3 =  number_format($row['in_bo01'],2);
        //บรรทัด 4
        }else if($row['in_bo01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="โบนัส";
            $in_val4 =  number_format($row['in_bo01'],2);
        }

    // 7.ค่าตอบแทนตามผลงาน
        //บรรทัด 1
        if($row['in_in01'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าตอบแทนตามผลงาน";
            $in_val1 = number_format($row['in_in01'],2);
        //บรรทัด 2
        }else if($row['in_in01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าตอบแทนตามผลงาน";
            $in_val2 =   number_format($row['in_in01'],2);
        //บรรทัด 3
        }else if($row['in_in01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าตอบแทนตามผลงาน";
            $in_val3 =  number_format($row['in_in01'],2);
        //บรรทัด 4
        }else if($row['in_in01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าตอบแทนตามผลงาน";
            $in_val4 =  number_format($row['in_in01'],2);
        }

    // 8.ค่าตอบแทนพิเศษ
        //บรรทัด 1
        if($row['in_sc01'] <> 0 && $in1 == "" ){ 
            $in1 ="ค่าตอบแทนพิเศษ";
            $in_val1 = number_format($row['in_sc01'],2);
        //บรรทัด 2
        }else if($row['in_sc01'] != 0 && $in1 != "" && $in2 ==""){ 
            $in2 ="ค่าตอบแทนพิเศษ";
            $in_val2 =   number_format($row['in_sc01'],2);
        //บรรทัด 3
        }else if($row['in_sc01'] != 0 && $in2 != "" && $in3 ==""){
            $in3 ="ค่าตอบแทนพิเศษ";
            $in_val3 =  number_format($row['in_sc01'],2);
        //บรรทัด 4
        }else if($row['in_sc01'] != 0 && $in3 != "" && $in4 ==""){
            $in4 ="ค่าตอบแทนพิเศษ";
            $in_val4 =  number_format($row['in_sc01'],2);
        }
//    

// รายการหัก
    // ประกาศตัวแปร Label
        $de1="";
        $de2="";
        $de3="";
        $de4="";
    // ประกาศตัวแปร Value 
        $val1="";
        $val2="";
        $val3="";
        $val4="";
    
    // ค่าไฟ
        //บรรทัด 1
        if($row['de_de02'] <> 0 && $de1 == "" ){ 
            $de1 ="ค่าไฟ";
            $val1 = number_format($row['de_de02'],2);
        //บรรทัด 2
        }else if($row['de_de02'] != 0 && $de1 != "" && $de2==""){ 
            $de2 ="ค่าไฟ";
            $val2 =   number_format($row['de_de02'],2);
        //บรรทัด 3
        }else if($row['de_de02'] != 0 && $de2 != "" && $de3==""){
            $de3 ="ค่าไฟ";
            $val3 =  number_format($row['de_de02'],2);
        //บรรทัด 4
        }else if($row['de_de02'] != 0 && $de3 != "" && $de4==""){
            $de4 ="ค่าไฟ";
            $val4 =  number_format($row['de_de02'],2);
        }
    // เงินค้ำประกัน
        //บรรทัด 1
        if($row['de_de05'] <> 0 && $de1 == "" ){ 
            $de1 ="เงินค้ำประกัน";
            $val1 = number_format($row['de_de05'],2);
        //บรรทัด 2
        }else if($row['de_de05'] != 0 && $de1 != "" && $de2==""){ 
            $de2 ="เงินค้ำประกัน";
            $val2 =   number_format($row['de_de05'],2);
        //บรรทัด 3
        }else if($row['de_de05'] != 0 && $de2 != "" && $de3==""){
            $de3 ="เงินค้ำประกัน";
            $val3 =  number_format($row['de_de05'],2);
        //บรรทัด 4
        }else if($row['de_de05'] != 0 && $de3 != "" && $de4==""){
            $de4 ="เงินค้ำประกัน";
            $val4 =  number_format($row['de_de05'],2);
        }
    // หักอื่นๆ
        //บรรทัด 1
        if($row['de_de06'] <> 0 && $de1 == "" ){ 
            $de1 ="หักอื่นๆ";
            $val1 = number_format($row['de_de06'],2);
        //บรรทัด 2
        }else if($row['de_de06'] != 0 && $de1 != "" && $de2==""){ 
            $de2 ="หักอื่นๆ";
            $val2 =   number_format($row['de_de06'],2);
        //บรรทัด 3
        }else if($row['de_de06'] != 0 && $de2 != "" && $de3==""){
            $de3 ="หักอื่นๆ";
            $val3 =  number_format($row['de_de06'],2);
        //บรรทัด 4
        }else if($row['de_de06'] != 0 && $de3 != "" && $de4==""){
            $de4 ="หักอื่นๆ";
            $val4 =  number_format($row['de_de06'],2);
        }
    // กยศ.
        //บรรทัด 1
        if($row['de_slf1'] <> 0 && $de1 == "" ){ 
            $de1 ="กยศ.";
            $val1 = number_format($row['de_slf1'],2);
        //บรรทัด 2
        }else if($row['de_slf1'] != 0 && $de1 != "" && $de2==""){ 
            $de2 ="กยศ.";
            $val2 =   number_format($row['de_slf1'],2);
        //บรรทัด 3
        }else if($row['de_slf1'] != 0 && $de2 != "" && $de3==""){
            $de3 ="กยศ.";
            $val3 =  number_format($row['de_slf1'],2);
        //บรรทัด 4
        }else if($row['de_slf1'] != 0 && $de3 != "" && $de4==""){
            $de4 ="กยศ.";
            $val4 =  number_format($row['de_slf1'],2);
        }
// 

$mpdf->WriteHTML("
    <style>
        body{
            font-family: Garuda;
            font-size: 12pt;
        }
        table{
            width: 100%;
            border-spacing: 0px;
            page-break-inside: avoid;
        }
        td ,th{
            padding: 8px;
            
        }
        #payslip{
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
    </style>
    <body>
        <!-- Slip Head -->
        <table>
            <tr>
                <th colspan='2' style='text-align:left;'><b>Sahakol Equipment Pubilc Company Limited</b></th>
                <th colspan='2' style='text-align:right;'>
                    <p id='payslip'>&nbsp;&nbsp;ใบจ่ายเงินเดือน/PAY SLIP&nbsp;&nbsp;</p>
                </th>
            </tr>
            <tr>
                <th style='text-align: left; width: 20%'><b>รหัสพนักงาน (EMP.NO.)</b></th>
                <td>".$row['code_emp_payslip']."</td>
                <th style='text-align: left; width: 20%'><b>ชื่อ(NAME)</b></th>
                <td>".$row['title_name_emp_payslip']." ".$row['name_emp_payslip']." ".$row['surname_emp_payslip']."</td>
            </tr>
            <tr>
                <th style='text-align: left; width: 20%'><b>ประจำงวด(FOR PERIOD)</b></th>
                <td>".$row['period_payslip']." (".date_format(date_create($row['date_payslip']),"d/m/Y").")</td>
                <th style='text-align: left; width: 20%'><b>ฝากเข้าเลขที่บัญชี</b></th>
                <td>".$row['id_bank_payslip']."</td>
            </tr>
        </table>
        <!-- Slip Detail -->
        <table style='border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black'>
            <thead >
                <tr>
                    <th style='border-bottom: 1px solid black;' colspan='2'>รายการได้(INCOME)</th>
                    <th style='border-bottom: 1px solid black;' >บาท(Bath)</th>
                    <th style='border-left: 1px solid black; border-bottom: 1px solid black;' colspan='2'>รายการหัก(DEDUCTION)</th>
                    <th style='border-bottom: 1px solid black;'>บาท(Bath)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='2'>ค่าแรง/เงินเดือน</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_salary_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;'  colspan='2'>ภาษี</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_tax_payslip'],2)."</td>
                </tr>
                <tr>
                    <td colspan='2'>ค่าครองชีพ</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['in_co1'],2)."</td>
                    <td style='border-left: 1px solid black;'  colspan='2'>ประกันสังคม</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_sso_payslip'],2)."</td>
                </tr>
                <tr>
                    <td>OT 1</td>
                    <td>".sprintf('%02d:00',$row['ot1_hr_payslip'])."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot1_baht_payslip'],2)."</td>

                    <td style='border-left: 1px solid black;' colspan='2'>กองทุนสำรองเลี้ยงชีพ</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_provident_fund_payslip'],2)."</td>
                </tr>
                <tr>
                    <td>OT 1.5</td>
                    <td>".sprintf('%02d:00',$row['ot15_hr_payslip'])."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot15_baht_payslip'],2)."</td>

                    <td style='border-left: 1px solid black;' colspan='2'>".$de1."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$val1."</td>
                </tr>
                <tr>
                    <td>OT 2</td>
                    <td>".sprintf('%02d:00',$row['ot2_hr_payslip'])."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot2_baht_payslip'],2)."</td>

                    <td style='border-left: 1px solid black;' colspan='2'>".$de2."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$val2."</td>
                </tr>
                <tr>
                    <td>OT 3</td>
                    <td>".sprintf('%02d:00',$row['ot3_hr_payslip'])."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot3_baht_payslip'],2)."</td>

                    <td style='border-left: 1px solid black;' colspan='2'>".$de3."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$val3."</td>
                </tr>
                <tr>
                    <td colspan='2'>".$in1."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$in_val1."</td>
                    <td style='border-left: 1px solid black;' colspan='2'>".$de4."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$val4."</td>
                </tr>
                <tr>
                    <td colspan='2'>".$in2."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$in_val2."</td>
                    <td style='border-left: 1px solid black;' colspan='2'></td>
                    <td style='text-align: right; padding-right: 20px;'></td>
                </tr>
                <tr>
                    <td colspan='2'>".$in3."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$in_val3."</td>
                    <td style='border-left: 1px solid black;' colspan='2'></td>
                    <td style='text-align: right; padding-right: 20px;'></td>
                </tr>
                <tr>
                    <td colspan='2'>".$in4."</td>
                    <td style='text-align: right; padding-right: 20px;'>".$in_val4."</td>
                    <td style='border-left: 1px solid black;' colspan='2'></td>
                    <td style='text-align: right; padding-right: 20px;'></td>
                </tr>

                    
                <!-- Slip Footer -->
                <tr>
                    <th style='border-top: 1px solid black;'>รวมรายได้</th>
                    <td style='border-top: 1px solid black;'>".number_format($row['total_income_payslip'],2)."</td>
                    <th style='border-top: 1px solid black;'>บาท(Bath)</th>
                    <th style='border-left: 1px solid black; border-top: 1px solid black'>รวมรายหัก</th>
                    <td style='border-top: 1px solid black;'>".number_format($row['total_deductions_payslip'],2)."</tdc>
                    <th style='border-top: 1px solid black;'>บาท(Bath)<th/>
                </tr>
                <tr>
                    <th style='border-top: 1px solid black;'>รายได้สุทธิ(NET INCOME)</th>
                    <td style='border-top: 1px solid black;'>".number_format($row['total_net_income_payslip'],2)."</td>
                    <th style='text-align: center; border-top: 1px solid black' colspan='4' >บาท(Bath)</th>
                </tr>
                <tr>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>เงินได้สะสม</th>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center' colspan='2'>ภาษีสะสม</th>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>ประกันสังคมสะสม</th>
                    <th style='border-top: 1px solid black; text-align:center' colspan='2'>กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>".number_format($row['salary_or_year'],2)."</td>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center' colspan='2'>".number_format($row['tax_or_year'],2)."</td>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>".number_format($row['sso_or_year'],2)."</td>
                    <td style='border-top: 1px solid black; text-align:center' colspan='2'>".number_format($row['pf_com_money_or_year'],2)."</td>
                </tr>
            </tbody>
        </table>
        <pagebreak>
    </body>");

}
// $mpdf->SetProtection(array(),'12032539');
$mpdf->Output('slip.pdf','I');

