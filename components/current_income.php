<?php
    require_once('./includes/connect_db.php');

    $year = date("Y");
    $empcode = "2630065";

    $recurent_in ="SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year ORDER BY code_tbl_payslip DESC LIMIT 1";
    $recur_stmt = $conn->prepare($recurent_in);
    $recur_stmt->bindParam(':empcode', $empcode);
    $recur_stmt->bindParam(':year', $year);
    $recur_stmt->execute();
    $recur_row = $recur_stmt->fetch(PDO::FETCH_ASSOC);

    $curent_year_in = "SELECT * FROM tbl_payslip WHERE code_emp_payslip = :empcode AND year_payslip = :year ORDER BY period_payslip DESC";
    $cur_year_stmt = $conn->prepare($curent_year_in);
    $cur_year_stmt->bindParam(':empcode', $empcode);
    $cur_year_stmt->bindParam(':year', $year);
    $cur_year_stmt->execute();
 

?>
<div class="card rounded-0 mb-2">
     <div class="card-body d-flex flex-column">
        <div class="text-start" style="font-size: 0.9rem;">
            <p class="text-muted">เงินเดือนได้สุทธิ</p>
            <p><?php echo"งวดที่ : ".$recur_row['period_payslip'] ." "."วันที่ : ".date_format(date_create($recur_row['date_payslip']),"d/m/Y"); ?></p>
        </div>
        <div class="text-end">
            <a class="m-0 fs-5 text-dark text-decoration-none"><?php echo number_format($recur_row['total_net_income_payslip'],2); ?> บาท</a><br>
        </div>
     </div>
     <div class="card-footer bg-white text-end">
        <a class="btn text-primary m-0 p-0" href="./detail.php">กดเพื่อดูรายละเอียดเพิ่มเติม</a>
     </div>
</div>

<!-- <div class="card rounded-0">
    <div class="card-body"> -->
        <table id="datatablesSimple">
            <thead>
                <!-- <th>รหัส</th> -->
                <th>งวดที่</th>
                <th>วันที่</th>
                <th>รายได้สุทธิ</th>
            </thead>
            <tbody class="text-sq-dark">
                <?php
                foreach($cur_year_stmt as $row){
                    echo"<tr>";
                    // echo "<td>". $row['code_tbl_payslip'] ."</td>";
                    // echo"<td><a class='text-decoration-none' href='./select_income.php?id=". $row['code_tbl_payslip']."&prd=". $row['period_payslip']."&dp=". $row['date_payslip']."'>". $row['period_payslip']."</a></td>";
                    echo"<td>". $row['period_payslip']."</td>";
                    echo"<td>". date_format(date_create($row['date_payslip']),"d/m/Y")."</td>";
                    echo"<td>". number_format($row['total_net_income_payslip'],2)."</td>";
                    echo"</tr>";        
                }  ?>
            </tbody>
        </table>
    <!-- </div>
</div> -->


<!-- <script>

        // ฟังก์ชันสำหรับจับเหตุการณ์คลิกบนแถว
        document.querySelector('#datatablesSimple tbody').addEventListener('click', function(e) {
            // ตรวจสอบว่าเราคลิกที่แถว
            let row = e.target.closest('tr');
            if (!row) return; // ถ้าไม่ได้คลิกที่แถวก็ไม่ต้องทำอะไร

            // ดึงข้อมูลจากแถวที่ถูกคลิก
            let id = row.cells[0].innerText; // ดึงค่า ID จากเซลล์แรก
            let name = row.cells[1].innerText; // ดึงค่า Name จากเซลล์ที่สอง

            // นำไปยังหน้าใหม่พร้อมกับส่งค่า ID และ Name ไป
            window.location.href = './select_income.php?id=' + id + '&name='+name ;
        });
    </script> -->


