<?php
 session_start();
    if(isset($_SESSION['empcode_elip']) && trim($_SESSION['role'])=="am" && isset($_GET['id'])){
        // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
        require_once __DIR__ . '/../includes/connect_db.php';

        $id = $_GET['id'];

        //ลบรูปภาพ
        $imagePath = '../uploads/emp_pic/'.$id.'.jpg';
        
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $delete_sql = "DELETE FROM tbl_regis WHERE emp_code = :empcode";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bindParam(':empcode', $id);
        $delete_stmt->execute();

        if($delete_stmt){
            header("Location: ../admin?manage=users&id=$id&delete_success");
        }else{
            header("Location: ../admin?manage=users&id=$id&delete_fail");
        }
        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn = null;
    }else{
        echo "<script>window.location.href = '../login';</script>";
    }
?>