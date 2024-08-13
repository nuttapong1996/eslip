<?php
require_once __DIR__ . '/../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$page =2;

$content ='
<style>
    body{
        font-family: Garuda;
        font-size: 16px;
    }
    table{
        width: 100%;
        border-spacing: 0px;
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
        <!-- Slip Head -->
        <table>
            <tr>
                <th colspan="2" style="text-align:left;"><b>Sahakol Equipment Pubilc Company Limited</b></th>
                <th colspan="2" style="text-align:right;">
                    <p id="payslip">&nbsp;&nbsp;ใบจ่ายเงินเดือน/PAY SLIP&nbsp;&nbsp;</p>
                </th>
            </tr>
            <tr>
                <th style="text-align: left; width: 20%"><b>รหัสพนักงาน (EMP.NO.)</b></th>
                <td>xxxxxxx</td>
                <th style="text-align: left; width: 20%"><b>ชื่อ(NAME)</b></th>
                <td>xxxxxxx     xxxxxxx</td>
            </tr>
            <tr>
                <th style="text-align: left; width: 20%"><b>ประจำงวด(FOR PERIOD)</b></th>
                <td>xx (xx/xx/xxxx)</td>
                <th style="text-align: left; width: 20%"><b>ฝากเข้าเลขที่บัญชี</b></th>
                <td>xxxxxxxxxx</td>
            </tr>
        </table>
        <!-- Slip Detail -->
        <table style="border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
            <thead >
                <tr>
                    <th style="border-bottom: 1px solid black;" colspan="2">รายการได้(INCOME)</th>
                    <th style="border-bottom: 1px solid black;" >บาท(Bath)</th>
                    <th style="border-left: 1px solid black; border-bottom: 1px solid black;" colspan="2">รายการหัก(DEDUCTION)</th>
                    <th style="border-bottom: 1px solid black;">บาท(Bath)</th>
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
                <tr>
                    <th style="border-top: 1px solid black;">รวมรายได้</th>
                    <td style="border-top: 1px solid black;">#,###,###.##</td>
                    <th style="border-top: 1px solid black;">บาท(Bath)</th>
                    <th style="border-left: 1px solid black; border-top: 1px solid black">รวมรายหัก</th>
                    <td style="border-top: 1px solid black;">#,###,###.##</tdc>
                    <th style="border-top: 1px solid black;">บาท(Bath)<th/>
                </tr>
                <tr>
                    <th style="border-top: 1px solid black;">รายได้สุทธิ(NET INCOME)</th>
                    <td style="border-top: 1px solid black;">#,###,###.##</td>
                    <th style="text-align: center; border-top: 1px solid black" colspan="4" >บาท(Bath)</th>
                </tr>
                <tr>
                    <th style="border-top: 1px solid black; border-right: 1px solid black; text-align:center">เงินได้สะสม</th>
                    <th style="border-top: 1px solid black; border-right: 1px solid black; text-align:center" colspan="2">ภาษีสะสม</th>
                    <th style="border-top: 1px solid black; border-right: 1px solid black; text-align:center">ประกันสังคมสะสม</th>
                    <th style="border-top: 1px solid black; text-align:center" colspan="2">กองทุนสำรองเลี้ยงชีพสะสม</th>
                </tr>
                <tr>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; text-align:center">##.##</td>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; text-align:center" colspan="2">##.##</td>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; text-align:center">##.##</td>
                    <td style="border-top: 1px solid black; text-align:center" colspan="2">##.##</td>
                </tr>
            </tbody>
        </table>
</body>';







while ($page > 0) {
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($content);
    $page--;
}
// $mpdf->SetProtection(array(),'12032539');
$mpdf->Output('slip.pdf','I');
?> 
