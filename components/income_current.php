<?php
if(isset($_SESSION['empcode'])){
    
    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once('./includes/connect_db.php');

    //ตัวแปรปีปัจจุบัน
    $year = date("Y");
    //ตัวแปรรหัสพนักงาน
    $empcode = $_SESSION['empcode'];

    //Query เงินเดือนปัจจุบัน
    $recurent_in ="SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year ORDER BY code_tbl_payslip DESC LIMIT 1";
    $recur_stmt = $conn->prepare($recurent_in);
    $recur_stmt->bindParam(':empcode', $empcode);
    $recur_stmt->bindParam(':year', $year);
    $recur_stmt->execute();
    $recur_row = $recur_stmt->fetch(PDO::FETCH_ASSOC);

    //Query เงินของปีปัจจุบัน
    $curent_year_in = "SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year ORDER BY period_payslip DESC";
    $cur_year_stmt = $conn->prepare($curent_year_in);
    $cur_year_stmt->bindParam(':empcode', $empcode);
    $cur_year_stmt->bindParam(':year', $year);
    $cur_year_stmt->execute();
?>
<h5 class="fw-normal">เงินเดือนปัจจุบัน</h5>
<div class="card rounded-0 mb-2 border-0 shadow-sm">
     <div class="card-body d-flex flex-column">
     <div class="text-start" style="font-size: 0.9rem;">
            <p> <i class="fa-solid fa-calendar-days"></i> <?php echo"งวดที่ : ".$recur_row['period_payslip'] ." "."วันที่ : ".date_format(date_create($recur_row['date_payslip']),"d/m/Y"); ?></p>
        </div>
        <div class="text-start">            
            <p class="mt-2 mb-3 fs-5 mb-0 text-dark text-decoration-none">รายได้สุทธิ (NET INCOME)</p>
            <div class="d-flex flex-column justify-content-end">
                <input type="hidden" id="net_income_value" value="<?php echo number_format($recur_row['total_net_income_payslip'],2); ?>">
                <p class="m-0 fs-2 px-3 text-end text-dark text-decoration-none " id="net_income">บาท</p><br>                
                <button class="btn  btn-outline-dark rounded-pill" id="net_income_btn"><b id="net_income_icon_text" class="" >แสดงยอดเงิน</b> <i class="fa-solid fa-eye" id="net_income_icon" ></i></button>
            </div>           
        </div>
     </div>
     <div class="card-footer bg-white text-end">
        <a class="btn text-secondary m-0 p-0" href="./detail?id=<?php echo $recur_row['code_tbl_payslip']; ?>">กดเพื่อดูรายละเอียดเพิ่มเติม</a>
     </div>
</div>

<h5 class="mt-4 fw-normal">ตารางรายการเงินเดือนปี <?php echo $year; ?></h5>
<table id="datatablesSimple" class="table tabble-bordered text-center shadow-sm" style="background-color: #fff;" >
    <thead >
        <th>งวด</th>
        <th>วันที่</th>
        <!-- <th>รายได้สุทธิ</th> -->
        <th>เพิ่มเติม</th>
    </thead>
    <tbody class="text-sq-dark">
        <?php
        foreach($cur_year_stmt as $row){
            echo"<tr>";
            echo"<td >". $row['period_payslip']."</td>";
            echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";   
            // echo "<td>". number_format($row['total_net_income_payslip'], 2) . "</td>";
            echo"<td><a class='btn btn-sm text-primary ' href='./detail?id=".$row['code_tbl_payslip']."'> <i class='fa-solid fa-right-to-bracket'></i></a></td>";
            echo"</tr>";        
        }  ?>
    </tbody>
</table>
<?php 
    //ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>



