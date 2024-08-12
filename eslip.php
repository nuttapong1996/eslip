<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <script src="../js/fontawezome-6.3.0.js"></script>
    <title>SQ : e-Payslip</title>
</head>
<style>
    table{
        border: 1px solid  #000!important;
    }
</style>
<?php 
 $mpdf->WriteHTML(' <body>

    <nav class="sb-topnav navbar navbar-expand navbar-dark d-flex justify-content-between p-4 ibm-plex-sans-thai-regular">
       <div class="container">
       <a onclick="history.back()" class="fs-2 text-white text-decoration-none" style="cursor:pointer"><i class="fas fa-arrow-left fs-1 text-white"></i></a>
       <a onclick="window.print()" class="fs-2 text-white text-decoration-none" style="cursor:pointer"><i class="fas fa-print"></i></a>
       </div>
    </nav>
    <div class="container mt-5">

        <div class="row mb-3">
            <div class="col-md-9"><div class="col-md text-start"><b>Sahakol Equipment Pubilc Company Limited</b></div> </div>
            <div class="col-md-3"><div class="col-md text-end"><b>ใบจ่ายเงินเดือน/PAY SLIP</b></div> </div>
        </div>
        <div class="row">
            <div class="col-md-2"><div class="col-md"><b>รหัสพนักงาน (EMP.NO.)</b></div></div>
            <div class="col-md-3"><div class="col-md"><i>2630065</i></div></div>
            <div class="col-md-2"><div class="col-md"><b>ชื่อ(NAME)</b></div></div>
            <div class="col-md-5"><div class="col-md"><i>นาย ณัฐพงษ์ ธิเชื้อ</i></div></div>
        </div>
        <div class="row">
            <div class="col-md-2"><div class="col-md"><b>ประจำงวด(FOR PERIOD)</b></div></div>
            <div class="col-md-3"><div class="col-md"><i>10 (31/05/2024)</i></div></div>
            <div class="col-md-2"><div class="col-md"><b>ฝากเข้าเลขที่บัญชี</b></div></div>
            <div class="col-md-3"><div class="col-md"><i>8802503228</i></div></div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="fw-bold">
                <tr  class="">
                    <th colspan="2">รายการได้(INCOME)</th>
                    <th class="text-end">บาท(Bath)</th>
                    <th colspan="2">รายการหัก(DEDUCTION)</th>
                    <th class="text-end">บาท(Bath)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">ค่าแรง/เงินเดือน</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2">ภาษี</td>
                    <td class="text-end">##.##</td>
                </tr>
                <tr>
                    <td colspan="2">ค่าครองชีพ</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2">ประกันสังคม</td>
                    <td class="text-end">##.##</td>
                </tr>
                <tr>
                    <td colspan="1">OT 1</td>
                    <td >0:00</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2">กองทุนสำรองเลี้ยงชีพ</td>
                    <td class="text-end">##.##</td>
                </tr>
                <tr>
                    <td colspan="1">OT 1.5</td>
                    <td >0:00</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2"></td>
                    <td class="text-end"></td>
                </tr>
                <tr>
                    <td colspan="1">OT 2</td>
                    <td >0:00</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2"></td>
                    <td class="text-end"></td>
                </tr>
                <tr>
                    <td colspan="1">OT 3</td>
                    <td >0:00</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2"></td>
                    <td class="text-end"></td>
                </tr>
                <tr>
                    <td colspan="2">ค่าทำงานต่างประเทศ</td>
                    <td class="text-end">##.##</td>
                    <td colspan="2"></td>
                    <td class="text-end"></td>
                </tr>
                <tr>
                    <th>รวมรายได้</th>
                    <td>##.##</tdc>
                    <th class="text-end">บาท(Bath)</>
                    <th>รวมรายหัก</th>
                    <td>##.##</tdc>
                    <th class="text-end">บาท(Bath)</>
                </tr>
                <tr>
                    <th>รายได้สุทธิ(NET INCOME)</th>
                    <td colspan="2" class="">##.##</tdc>
                    <th class="text-center">บาท(Bath)</t>
                </tr>
                <tr class="text-center">
                    <th>เงินได้สะสม</th>
                    <th colspan="2">ภาษีสะสม</th>
                    <th>ประกันสังคมสะสม</th>
                    <th colspan="2">กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr class="text-center">
                    <td>##.##</td>
                    <td colspan="2">##.##</td>
                    <td>##.##</td>
                    <td colspan="2">##.##</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</body>');
?>
</html> 

<?php

$mpdf->Output();
?>