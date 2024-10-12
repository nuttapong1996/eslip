<?php
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am"){
    // ชื่อหน้าเว็บ
    $title = "ยอดผู้สมัครใช้งาน";

    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';
?>
<title> <?php echo $title ?></title>
<main>
    <div class="container px-4">
        <div class="row justify-content-center mt-5">
            <h1>ยอดผู้สมัครใช้งาน (กำลังพัฒนา...)</h1>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</main>




<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>