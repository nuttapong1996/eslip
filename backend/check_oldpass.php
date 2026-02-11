<?php 
session_start();
    // รับค่าจาก AJAX
    if (isset($_POST['oldpassword'])) {

        // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
        require_once __DIR__ . '/../includes/connect_db.php';

        $oldpassword = $_POST['oldpassword'];
        $empcode = $_SESSION['empcode_elip'];

        $newpassword = 'SELECT password FROM tbl_regis WHERE emp_code =:empcode ';
        $stmt_newpassword = $conn->prepare($newpassword);
        $stmt_newpassword->bindParam(':empcode', $empcode);
        $stmt_newpassword->execute();

        $row_newpassword = $stmt_newpassword->fetch(PDO::FETCH_ASSOC);
        
        if(password_verify(trim($oldpassword), trim($row_newpassword['password']))){
            echo 'true';
        }else{
            echo 'false';
        }
        //ปิดการเชื่อมต่อฐานข้อมูล
        $conn = null;
    }else{
        echo "<script>window.location.href = '../login';</script>";
    }
?>