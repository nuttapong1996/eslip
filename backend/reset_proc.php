<?php 
    if(isset($_POST['newpassword'])&& isset($_POST['token'])){

        //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
        require_once __DIR__ . '/../includes/connect_db.php';

        //รับค่าจากฟอร์ม
        $newpassword = $_POST['newpassword'];
        $token = $_POST['token'];

        $newhash = password_hash($newpassword, PASSWORD_DEFAULT);

        //Query reset new password and clear token
        $newpass = 'UPDATE tbl_regis SET password = :newpassword ,updated_at = NOW() WHERE reset_token = :token';
        $stmt_newpass = $conn->prepare($newpass);
        $stmt_newpass->bindParam(':newpassword', $newhash);
        $stmt_newpass->bindParam(':token', $token);
        $stmt_newpass->execute();

        if($stmt_newpass){           
            $clear_token = 'UPDATE tbl_regis SET reset_token = NULL, reset_token_expire_date = NULL WHERE reset_token = :token';
            $stmt_clear_token = $conn->prepare($clear_token);
            $stmt_clear_token->bindParam(':token', $token);
            $stmt_clear_token->execute();
            header("location: ../login?reset_success");
        }else{
            header("location: ../forgot?error");
        }
        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn = null;
    }else{
        header("location: ../forgot?error");
    }
?>