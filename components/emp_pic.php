<?php
if(isset($_SESSION['empcode'])){
    // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    // ตัวแปรรหัสพนักงาน
    $empcode = $_SESSION['empcode'];

    $pic_sql= "SELECT emp_pic FROM tbl_regis  WHERE emp_code  = :empcode";
    $pic_stmt = $conn->prepare($pic_sql);
    $pic_stmt->bindParam(':empcode', $empcode);
    $pic_stmt->execute();
    $pic_row = $pic_stmt->fetch(PDO::FETCH_ASSOC);
 ?>
<img  class="rounded-circle" style="clip-path: circle(); width:100px; height:100px; object-fit: cover; overflow: hidden;" src="<?php if($pic_row['emp_pic'] != ""){echo "uploads/emp_pic/".$pic_row['emp_pic']."?version=".time();}else{echo 'assets/images/noimage_w.png';}?>"  alt="">
<?php
}else{
    echo "<script>window.location.href = '../login';</script>";
}

?>