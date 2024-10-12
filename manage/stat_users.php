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
        </div>
    </div>
</main>

<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>