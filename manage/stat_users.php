<?php
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am"){
    // ชื่อหน้าเว็บ
    $title = "ยอดผู้สมัครใช้งาน";

    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    //Query จำนวนพนักงานแต่ละแผนกทั้งหมดปัจจุบัน
    $total_emp_sql ="SELECT
                        tbl_dept_emp.short_name_deptemp AS dept,
                        COUNT(*) AS emp
                      FROM
                        tbl_emp AS table_emp
                        JOIN tbl_dept_emp ON table_emp.dept_emp = tbl_dept_emp.code_tbl_deptemp 
                      WHERE tbl_dept_emp.short_name_deptemp IN ('MO', 'MP', 'EE', 'CO', 'INV', 'SHE', 'AM', 'HR', 'AC', 'IT', 'PU', 'ME', 'MC', 'EXEC') AND table_emp.status_emp = 10
                      GROUP BY tbl_dept_emp.short_name_deptemp
                      ORDER BY tbl_dept_emp.short_name_deptemp";

    $total_emp_stmt = $conn->prepare($total_emp_sql);
    $total_emp_stmt->execute();
    $total_emp_row = $total_emp_stmt->fetchAll(PDO::FETCH_ASSOC);


  //Query จำนวนผู้สมัครแต่ละแผนก
    $number_emp_sql ="SELECT
                        tbl_dept_emp.short_name_deptemp AS dept,
                        COUNT(table_regis.emp_code) AS emp_num
                      FROM
                        tbl_dept_emp
                        LEFT JOIN tbl_emp AS table_emp ON tbl_dept_emp.code_tbl_deptemp = table_emp.dept_emp
                        LEFT JOIN tbl_regis AS table_regis ON table_emp.code_emp = table_regis.emp_code
                      WHERE tbl_dept_emp.short_name_deptemp IN ('MO','MP','EE','CO','INV','SHE','AM','HR','AC','IT','PU','ME','MC','EXEC') 
                      GROUP BY
                        tbl_dept_emp.short_name_deptemp 
                      ORDER BY
                        tbl_dept_emp.short_name_deptemp;";

    $number_emp_stmt = $conn->prepare($number_emp_sql);
    $number_emp_stmt->execute();
    $number_emp_row = $number_emp_stmt->fetchAll(PDO::FETCH_ASSOC);


    $dept = array_map(function($item){ return $item['dept'];}, $number_emp_row);

    $dept ='["'.implode('", "', $dept).'"]';

    $number_emp = array_map(function($item){ return $item['emp_num'];}, $number_emp_row);   

    $number_emp ='["'.implode('", "', $number_emp).'"]';

    $total_regis = array_map(function($item){ return $item['emp_num'];}, $number_emp_row);

    $total_emp = array_map(function($item){ return $item['emp'];}, $total_emp_row);


?>
<title> <?php echo $title ?></title>
<main>
    <div class="container px-4">
        <div class="row justify-content-center mt-5 mb-3">
          <h1 class="mb-3"><i class="fa-solid fa-chart-simple"></i> ยอดผู้สมัครใช้งาน</h1>
          <p class="text-muted">(Updated <?php echo date('d-m-Y') ?>)</p>
        </div>
        <div class="row justify-content-center  mb-3">            
            <div class="col-sm-9 mb-3">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">จำนวนผู้สมัครทั้งหมด</h5>
                        <p class="card-text text-success text-end fs-4"><?php echo number_format(array_sum($total_regis),0)?> คน</p>
                        <hr>
                        <p class="card-text text-danger text-end fs-5">คงเหลือ <?php echo number_format((array_sum($total_emp)) - array_sum($total_regis),0)?> คน</p>
                        <p class="card-text text-end">จาก <?php echo number_format(array_sum($total_emp),0)?> คน</p>                        
                    </div>
                </div>
            </div>           
        </div>
        <div class="row justify-content-center">
          <?php foreach ($number_emp_row as $key => $value) { ?>
              <div class="col-sm-3 mb-3">
                <?php if(number_format($total_emp_row[$key]['emp'] - $number_emp_row[$key]['emp_num'],0) == 0){echo '<div class="card border-success text-success">' ;}else{echo '<div class="card border-danger">' ;} ?>
                  <!-- <div class="card"> -->
                      <div class="card-body">                          
                          <h5 class="card-title"><?php echo $number_emp_row[$key]['dept'];  if(number_format($total_emp_row[$key]['emp'] - $number_emp_row[$key]['emp_num'],0) == 0){ echo '<i class="fas fa-check text-success"></i> <small class="text-muted">ครบแล้ว</small>';}?> </h5>
                          <p class="card-text text-success text-end fs-4"><?php echo number_format($number_emp_row[$key]['emp_num'],0)?> คน</p>
                          <hr>
                          <p class="card-text text-danger text-end fs-5">คงเหลือ <?php echo number_format($total_emp_row[$key]['emp'] - $number_emp_row[$key]['emp_num'],0)?> คน</p>
                          <p class="card-text text-end">จาก <?php echo number_format($total_emp_row[$key]['emp'],0)?> คน</p> 
                          <a class="btn btn-outline-secondary w-100" href="./admin?manage=users_list&dept=<?php echo $number_emp_row[$key]['dept'] ?>">ดูรายละเอียด</a>                         
                      </div>
                  </div>
              </div>
          <?php } ?>
      </div>
    </div>
</main>

<script>
   Chart.register(ChartDataLabels);
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
      data: {
        labels: <?php echo $dept; ?>,
        datasets: [{
          label: 'จำนวนผู้สมัคร',
          data: <?php echo $number_emp; ?>,                  
          borderWidth: 1,
          barPercentage: 0.5
        }]
      },
      options: {
        plugins: {
          datalabels: {
            anchor: 'end',
            align: 'top',
            labels: {
              value: {
                color:'black',
                font: {
                  weight: 'bold'
                }
              }
            }
          },
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'จำนวนผู้สมัคร'
            }
          },
          x: {
            title: {
              display: true,
              text: 'แผนก/ฝ่าย'
            }
          }
        },
        responsive: true,
        maintainAspectRatio: true
      }
  });
</script>
<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>