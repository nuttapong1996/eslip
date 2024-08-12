<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$content ='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQ : e-Payslip</title>
</head>
 <style>
    body{
        font-family: Garuda;
        font-size: 16px;
    }
    table{
        width: 100%;
    }
    td ,th{
        padding: 5px;
    }
     #payslip{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
     }
</style>
<body>
    <div class="container">
        <!-- Slip Head -->
        <table>
            <tr>
                <th colspan="2"><b>Sahakol Equipment Pubilc Company Limited</b></th>
                <th colspan="2" style="text-align:right;">
                    <p id="payslip">ใบจ่ายเงินเดือน/PAY SLIP</p>
                </th>
            </tr>
            <tr>
                <th style="width: 20%"><b>รหัสพนักงาน (EMP.NO.)</b></th>
                <td class="text-start">xxxxxxx</td>
                <th style="width: 20%"><b>ชื่อ(NAME)</b></th>
                <td class="text-start">xxxxxxx     xxxxxxx</td>
            </tr>
            <tr>
                <th><b>ประจำงวด(FOR PERIOD)</b></th>
                <td class="text-start">xx (xx/xx/xxxx)</td>
                <th><b>ฝากเข้าเลขที่บัญชี</b></th>
                <td>xxxxxxxxxx</td>
            </tr>
        </table>
        <!-- Slip Detail -->
        <table style="border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
            <thead>
                <tr style="border-bottom: 1px solid black;">
                    <th colspan="2">รายการได้(INCOME)</th>
                    <th class="text-end">บาท(Bath)</th>
                    <th style="border-left: 1px solid black;" colspan="2">รายการหัก(DEDUCTION)</th>
                    <th class="text-end">บาท(Bath)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Detail part -->
                <tr>
                    <td colspan="2">ค่าแรง/เงินเดือน</td>
                    <td >#,###,###.##</td>
                    <td style="border-left: 1px solid black;"  colspan="2">ภาษี</td>
                    <td >#,###,###.##</td>
                </tr>
                <tr>
                    <td colspan="2">ค่าครองชีพ</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;"  colspan="2">ประกันสังคม</td>
                    <td>#,###,###.##</td>
                </tr>
                <tr>
                    <td>OT 1</td>
                    <td>00:00</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;" colspan="2">กองทุนสำรองเลี้ยงชีพ</td>
                    <td>#,###,###.##</td>
                </tr>
                <tr>
                    <td>OT 1.5</td>
                    <td>00:00</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;"  colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>OT 2</td>
                    <td >00:00</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;"  colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>OT 3</td>
                    <td>00:00</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;" colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">ค่าทำงานต่างประเทศ</td>
                    <td>#,###,###.##</td>
                    <td style="border-left: 1px solid black;" colspan="2"></td>
                    <td></td>
                </tr>

                <!-- Summary part -->
                <tr style="border-top: 1px solid black;">
                    <th>รวมรายได้</th>
                    <td>#,###,###.##</td>
                    <th>บาท(Bath)</th>
                    <th style="border-left: 1px solid black;">รวมรายหัก</th>
                    <td>#,###,###.##</tdc>
                    <th>บาท(Bath)<th/>
                </tr>
                <tr style="border-top: 1px solid black;">
                    <th>รายได้สุทธิ(NET INCOME)</th>
                    <td>#,###,###.##</td>
                    <th style="text-align: center" colspan="4" >บาท(Bath)</th>
                </tr>
                <tr style="border-top: 1px solid black;">
                    <th style="border-right: 1px solid black; text-align:center">เงินได้สะสม</th>
                    <th style="border-right: 1px solid black; text-align:center" colspan="2">ภาษีสะสม</th>
                    <th style="border-right: 1px solid black; text-align:center">ประกันสังคมสะสม</th>
                    <th style="text-align:center" colspan="2">กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr style="border-top: 1px solid black;">
                    <td style="border-right: 1px solid black; text-align:center">##.##</td>
                    <td style="border-right: 1px solid black; text-align:center" colspan="2">##.##</td>
                    <td style="border-right: 1px solid black; text-align:center">##.##</td>
                    <td style="text-align:center" colspan="2">##.##</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
</html>';

$mpdf->AddPage('L');
$mpdf->WriteHTML($content);
$mpdf->Output();
?> 
