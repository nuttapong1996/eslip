<?php 
session_start();
    // รับค่าจาก AJAX
    if (isset($_POST['oldpassword'])) {
        // เรียกใช้งานไฟล์ connect_db.php
        require_once __DIR__ . '/../includes/connect_db.php';

        $oldpassword = $_POST['oldpassword'];
        // $oldpassword = 'Nomad996';
        $empcode = $_SESSION['empcode'];
        // $empcode = '2630065';

        $un_pass = password_verify($oldpassword, $oldpassword);

        $newpassword = 'SELECT password FROM tbl_regis WHERE emp_code =:empcode ';
        $stmt_newpassword = $conn->prepare($newpassword);
        $stmt_newpassword->bindParam(':empcode', $empcode);
        // $stmt_newpassword->bindParam(':oldpassword', $oldpassword);
        $stmt_newpassword->execute();

        $row_newpassword = $stmt_newpassword->fetch(PDO::FETCH_ASSOC);
        

        if(password_verify(trim($oldpassword), trim($row_newpassword['password']))){
            echo 'true';
            // echo $empcode;
        }else{
            echo 'false';
            // echo $empcode;
        }
    }else{
        echo 'false';
        // echo $_SESSION['empcode'];
    }
    

?>