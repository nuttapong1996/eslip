
<!-- // require_once __DIR__ . '/vendor/autoload.php';
// $mpdf = new \Mpdf\Mpdf();

// $stylesheet = file_get_contents('css/bootstrap.min.css');


// $mpdf->WriteHTML($stylesheet,1);



// $content =' -->
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
</style>
<body>
    <div class="container">
        <!-- Slip Head -->
        <table class="table table-borderless border-0">
            <tr>
                <td colspan="2"><b>Sahakol Equipment Pubilc Company Limited</b></td>
                <td colspan="2" class="text-end"><b class="border border-dark px-5 py-2">ใบจ่ายเงินเดือน/PAY SLIP</b></td>
            </tr>
            <tr>
                <td width="20%"><b>รหัสพนักงาน (EMP.NO.)</b></td>
                <td class="text-start">xxxxxxx</td>
                <td width="20%"><b>ชื่อ(NAME)</b></td>
                <td class="text-start">xxxxxxx     xxxxxxx</td>
            </tr>
            <tr>
                <td><b>ประจำงวด(FOR PERIOD)</b></td>
                <td class="text-start">xx (xx/xx/xxxx)</td>
                <td><b>ฝากเข้าเลขที่บัญชี</b></td>
                <td>xxxxxxxxxx</td>
            </tr>
        </table>
        <!-- Slip Detail -->
        <table class="table table-borderless mt-3">
            <thead class="border-top border-bottom border-start border-end border-dark fw-bold">
                <tr>
                    <th class="" colspan="2">รายการได้(INCOME)</th>
                    <th class="text-end">บาท(Bath)</th>
                    <th class="border-start border-dark" colspan="2">รายการหัก(DEDUCTION)</th>
                    <th class="text-end">บาท(Bath)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Detail part -->
                <tr>
                    <td class="border-start border-dark" colspan="2">ค่าแรง/เงินเดือน</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2">ภาษี</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                </tr>
                <tr>
                    <td class="border-start border-dark" colspan="2">ค่าครองชีพ</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2">ประกันสังคม</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                </tr>
                <tr>
                    <td class="border-start border-dark" width="20%">OT 1</td>
                    <td >00:00</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2">กองทุนสำรองเลี้ยงชีพ</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                </tr>
                <tr>
                    <td class="border-start border-dark">OT 1.5</td>
                    <td >00:00</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2"></td>
                    <td class="border-end border-dark text-end"></td>
                </tr>
                <tr>
                    <td class="border-start border-dark">OT 2</td>
                    <td >00:00</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2"></td>
                    <td class="border-end border-dark text-end"></td>
                </tr>
                <tr>
                    <td class="border-start border-dark">OT 3</td>
                    <td>00:00</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td class="border-start border-dark" colspan="2"></td>
                    <td class="border-end border-dark text-end"></td>
                </tr>
                <tr>
                    <td class="border-start border-dark" colspan="2">ค่าทำงานต่างประเทศ</td>
                    <td class="border-end border-dark text-end">#,###,###.##</td>
                    <td colspan="2"></td>
                    <td class="border-end border-dark text-end"></td>
                </tr>

                <!-- Summary part -->
                <tr>
                    <th class="border-start border-top border-bottom border-dark" >รวมรายได้</th>
                    <td class="border-top border-bottom  border-dark text-end">#,###,###.##</td>
                    <th class="border-end border-top border-bottom  border-dark text-end">บาท(Bath)</th>
                    <th class="border-top border-bottom  border-dark">รวมรายหัก</th>
                    <td class="border-top border-bottom  border-dark text-end">#,###,###.##</tdc>
                    <th class="border-end border-top border-bottom  border-dark text-end">บาท(Bath)</>
                </tr>
                <tr>
                    <th class="border-start border-bottom border-dark">รายได้สุทธิ(NET INCOME)</th>
                    <td class="border-bottom border-dark text-end">#,###,###.##</td>
                    <th class="border-bottom border-end border-dark text-center"colspan="4" >บาท(Bath)</th>
                </tr>
                <tr class="text-center">
                    <th class="border-start border-bottom border-end border-dark">เงินได้สะสม</th>
                    <th class="border-start border-bottom border-end border-dark" colspan="2">ภาษีสะสม</th>
                    <th class="border-start border-bottom border-end border-dark">ประกันสังคมสะสม</th>
                    <th class="border-start border-bottom border-end border-dark" colspan="2">กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr class="text-center">
                    <td class="border-start border-bottom border-end border-dark">##.##</td>
                    <td class="border-start border-bottom border-end border-dark" colspan="2">##.##</td>
                    <td class="border-start border-bottom border-end border-dark">##.##</td>
                    <td class="border-start border-bottom border-end border-dark" colspan="2">##.##</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
</html>
<!--';

 $mpdf->AddPage('L');
$mpdf->WriteHTML($content);
$mpdf->Output();
?> -->
