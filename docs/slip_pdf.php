<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/connect_db.php';

$mpdf = new \Mpdf\Mpdf();



$year = date("Y");
$period ="15";
$empcode = "2630065";

$sql ="SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year and period_payslip = :period ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':empcode', $empcode);
$stmt->bindParam(':year', $year);
$stmt->bindParam(':period', $period);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$rowcount = $stmt->rowCount();


//เช็คค่าชั่วโมง
    if($row['hourly_rate_payslip'] > 0){
        $hourly = "<tr>
                        <td colspan='2'>ค่าชั่วโมง</td>
                        <td>#,###,###.##</td>
                        <td style='border-left: 1px solid black;' colspan='2'></td>
                        <td></td>
                    </tr>"; 
    }else{ $hourly = ""; }
//เช็คค่าไฟ
if($row['electricity_bill_payslip'] > 0){ $ebill = "<td style='border-left: 1px solid black;'  colspan='2'>ค่าไฟ</td><td>".$row['electricity_bill_payslip']."</td>"; }else{ $ebill = "<td style='border-left: 1px solid black;'  colspan='2'></td>";}



$html ="
<style>
    body{
        font-family: Garuda;
        font-size: 12pt;
    }
    table{
        width: 100%;
        border-spacing: 0px;
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
                <!-- Detail part -->
                <tr>
                    <td colspan='2'>ค่าแรง/เงินเดือน</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_salary_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;'  colspan='2'>ภาษี</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_tax_payslip'],2)."</td>
                </tr>
                <tr>
                    <td colspan='2'>ค่าครองชีพ</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['costofliving_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;'  colspan='2'>ประกันสังคม</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_sso_payslip'],2)."</td>
                </tr>
                <tr>
                    <td>OT 1</td>
                    <td>".date('H:i',mktime($row['ot1_hr_payslip'],0))."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot1_hr_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;' colspan='2'>กองทุนสำรองเลี้ยงชีพ</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['period_provident_fund_payslip'],2)."</td>
                </tr>
                <tr>
                    <td>OT 1.5</td>
                    <td>".date('H:i',mktime($row['ot15_hr_payslip'],0))."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot15_hr_payslip'],2)."</td>".
                    $ebill."
                </tr>
                <tr>
                    <td>OT 2</td>
                    <td>".date('H:i',mktime($row['ot2_hr_payslip'],0))."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot2_hr_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;'  colspan='2'></td>
                    <td></td>
                </tr>
                <tr>
                    <td>OT 3</td>
                    <td>".date('H:i',mktime($row['ot3_hr_payslip'],0))."</td>
                    <td style='text-align: right; padding-right: 20px;'>".number_format($row['ot3_hr_payslip'],2)."</td>
                    <td style='border-left: 1px solid black;' colspan='2'></td>
                    <td></td>
                </tr>
                ".$hourly."
                <tr>
                    <td colspan='2'>ค่าเที่ยว</td>
                    <td>#,###,###.##</td>
                    <td style='border-left: 1px solid black;' colspan='2'></td>
                    <td></td>
                </tr>

                <!-- Summary part -->
                <tr>
                    <th style='border-top: 1px solid black;'>รวมรายได้</th>
                    <td style='border-top: 1px solid black;'>#,###,###.##</td>
                    <th style='border-top: 1px solid black;'>บาท(Bath)</th>
                    <th style='border-left: 1px solid black; border-top: 1px solid black'>รวมรายหัก</th>
                    <td style='border-top: 1px solid black;'>#,###,###.##</tdc>
                    <th style='border-top: 1px solid black;'>บาท(Bath)<th/>
                </tr>
                <tr>
                    <th style='border-top: 1px solid black;'>รายได้สุทธิ(NET INCOME)</th>
                    <td style='border-top: 1px solid black;'>#,###,###.##</td>
                    <th style='text-align: center; border-top: 1px solid black' colspan='4' >บาท(Bath)</th>
                </tr>
                <tr>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>เงินได้สะสม</th>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center' colspan='2'>ภาษีสะสม</th>
                    <th style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>ประกันสังคมสะสม</th>
                    <th style='border-top: 1px solid black; text-align:center' colspan='2'>กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>##.##</td>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center' colspan='2'>##.##</td>
                    <td style='border-top: 1px solid black; border-right: 1px solid black; text-align:center'>##.##</td>
                    <td style='border-top: 1px solid black; text-align:center' colspan='2'>##.##</td>
                </tr>
            </tbody>
        </table>
</body>";







while ($rowcount > 0) {
    $mpdf->AddPage('L');
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->WriteHTML($html);
    $rowcount--;
}
// $mpdf->SetProtection(array(),'12032539');
$mpdf->Output('slip.pdf','I');
?> 
