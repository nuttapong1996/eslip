<?php 

if(isset($_SESSION['empcode_elip'])){

    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once('includes/connect_db.php');

    // ตรวจสอบการส่งค่าจากฟอร์มเลือกปี พร้อมตั้งค่าตัวแปร $year
    if(isset($_POST['slipyear'])){
        $year = $_POST['slipyear']; //ใช้ปีที่เลือก
    }else{
        $year = date("Y"); //หากไม่ได้เลือกปีให้ใช้ปีปัจจุบัน
    }


    $empcode = $_SESSION['empcode_elip'];

    $sql = "SELECT * FROM tbl_payslip WHERE year_payslip = :year and code_emp_payslip = :empcode ORDER BY code_tbl_payslip DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':empcode', $empcode);
    $stmt->bindParam(':year', $year);
    $stmt->execute();

?>
<style>
    .table, .datatable-table{
        background: #fff !important;
    }
    .datatable-empty{
        text-align: center;
    }
</style>
    <h4 class="mt-3 mb-2 fw-normal text-center">ตารางรายการเงินเดือนปี <?php if(isset($_POST['slipyear'])){ echo $_POST['slipyear']; }else{ echo date("Y");} ?></h4>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form action="records" method="post" class="input-group text-black mb-3">
                <?php include 'components/year_select.php'; ?>
                <button type="submit" class="btn btn-sm btn-primary">เรียกดู</button>
            </form>
        </div>
    </div>
    <table id="datatablesSimple" class="table tabble-bordered bg-light text-center shadow-sm" style="background-color: #fff;" >
        <thead >
            <th>งวด</th>
            <th>วันที่</th>
            <!-- <th>รายได้สุทธิ</th> -->
            <th>เพิ่มเติม</th>
        </thead>
        <tbody class="text-sq-dark">
            <?php
            foreach($stmt as $row){
                echo"<tr>";
                echo"<td >". $row['period_payslip']."</td>";
                echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                // echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                echo"<td><a class='btn btn-sm text-primary ' href='./detail?id=".$row['code_tbl_payslip']."'> <i class='fa-solid fa-right-to-bracket'></i></a></td>";
                echo"</tr>";        
            }  ?>
        </tbody>
    </table>

<?php 
        //ปิดการเชื่อมต่อฐานข้อมูล
        $conn=null;

}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>