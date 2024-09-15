<?php 

require_once('includes/connect_db.php');

// ตรวจสอบการส่งค่าจากฟอร์มเลือกปี 
if(isset($_POST['slipyear'])){
    $year = $_POST['slipyear']; //ใช้ปีที่เลือก
}else{
    $year = date("Y"); //หากไม่ได้เลือกปีให้ใช้ปีปัจจุบัน
}
$empcode = "2630065";

$sql = "SELECT * FROM tbl_payslip WHERE year_payslip = :year and code_emp_payslip = :empcode ORDER BY code_tbl_payslip DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':empcode', $empcode);
$stmt->bindParam(':year', $year);
$stmt->execute();

//โค้ดสำหรับสร้างตัวเลือกปี
function generateYearOptions($startYear, $endYear, $selectedYear=null) {
    $options = '';
    for ($year = $startYear; $year <= $endYear; $year++) {
        
        $selected = ($year == $selectedYear) ? 'selected' : '';

        $options .= "<option value=\"$year\" $selected>$year</option>\n";
    }
    return $options;
}

    $title = "ตารางรายการย้อนหลัง";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title><?php echo $title ?></title>
</head>
<body class="sb-nav-fixed bg-gray ibm-plex-sans-thai-regular">
    <!-- topnav -->
     <?php include 'components/topnav.php'; ?> 
    <div id="layoutSidenav">
        <!-- sidenav -->
        <?php include 'components/sidenav.php'; ?>
        <div id="layoutSidenav_content">
            <main  class="mt-3 mb-3">
                <div class="container-fluid px-4">
                    <!-- Breadcrumb -->
                     <?php //breadcrumb($title); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <form action="history_income.php" method="post" class="input-group text-black mb-3">
                                        <label class="input-group-text" for="slipyear">ปี</label>
                                        <select class="form-select form-select-sm" name="slipyear" id="slipyear">
                                            <?php echo generateYearOptions(2023, date("Y") , date("Y")); ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">เรียกดู</button>
                                    </form>
                                </div>
                            </div>
                           
                                    <table id="datatablesSimple" class="table tabble-bordered bg-light text-center shadow-sm" style="background-color: #fff;" >
                                        <thead >
                                            <!-- <th class="hidden">No.</th>
                                            <th class="hidden">รหัสพนง</th> -->
                                            <th>งวด</th>
                                            <th>วันที่</th>
                                            <th>รายได้สุทธิ</th>
                                            <th>เพิ่มเติม</th>
                                        </thead>
                                        <tbody class="text-sq-dark">
                                            <?php
                                            foreach($stmt as $row){
                                                echo"<tr>";
                                                echo"<td >". $row['period_payslip']."</td>";
                                                echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                                                echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                                                echo"<td><a class='btn btn-sm text-secondary ' href='./detail.php?id=".$row['code_tbl_payslip']."'> <i class='fa-solid fa-right-to-bracket'></i></a></td>";
                                                echo"</tr>";        
                                            }  ?>
                                        </tbody>
                                    </table>
                                    <!-- <table id="datatablesSimple">
                                        <thead>
                                            <th>งวด</th>
                                            <th>วันที่</th>
                                            <th>รายได้สุทธิ</th>
                                            <th><i class="fa-solid fa-circle-info"></i></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            // foreach($stmt as $row){
                                            //     echo"<tr>";
                                            //     echo"<td>". $row['period_payslip']."</td>";
                                            //     echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                                            //     echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                                            //     echo"<td><a class='btn btn-sm btn-primary' href='./select_income.php?id=". $row['code_tbl_payslip']."&prd=". $row['period_payslip']."&dp=". $row['date_payslip']."'><i class='fa-solid fa-eye'></i></a></td>";
                                            //     echo"</tr>";                
                                            // }  
                                            ?>
                                        </tbody>
                                    </table> -->
                                
                        </div>
                    </div>
                </div>
            </main>
            <div class="py-5"></div>
            <!-- footer -->
             <div class="desktop">
                <?php include 'components/foot.php'; ?>
             </div>
        </div>
    </div>
    <div class="mobilenav">
        <?php include 'components/bottomnav.php'; ?>
    </div>
</body>
</html>

