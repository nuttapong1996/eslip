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
<body class="sb-nav-fixed ibm-plex-sans-thai-regular">
    <!-- topnav -->
     <?php include 'components/topnav.php'; ?> 
    <div id="layoutSidenav">
        <!-- sidenav -->
        <?php include 'components/sidenav.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- Breadcrumb -->
                     <?php breadcrumb($title); ?>
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
                            <div class="card border-sq-orange text-sq-dark fw-bold">
                                <div class="card-header bg-sq-orange">
                                    <i class="fas fa-table me-1"></i>รายการย้อนหลัง
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <th>งวด</th>
                                            <th>วันที่</th>
                                            <th>รายได้สุทธิ</th>
                                            <th><i class="fa-solid fa-circle-info"></i></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            foreach($stmt as $row){
                                                echo"<tr>";
                                                echo"<td>". $row['period_payslip']."</td>";
                                                echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                                                echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                                                echo"<td><a class='btn btn-sm btn-primary' href='./select_income.php?id=". $row['code_tbl_payslip']."&prd=". $row['period_payslip']."&dp=". $row['date_payslip']."'><i class='fa-solid fa-eye'></i></a></td>";
                                                echo"</tr>";                
                                            }  ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- footer -->
            <?php include 'components/foot.php'; ?>
        </div>
    </div>
</body>
</html>