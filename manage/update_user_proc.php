<?php
    if(isset($_POST['empcode']) && isset($_POST['edit_birhtday']) && isset($_POST['edit_iden_code']) && isset($_POST['edit_email']) && isset($_POST['edit_password'])){

        // เรียกใช้งานฐานข้อมูล
        require_once __DIR__ . '/../includes/connect_db.php';

        $empcode = $_POST['empcode'];
        $birhtday = $_POST['edit_birhtday'];
        $iden_code = $_POST['edit_iden_code'];
        $email = $_POST['edit_email'];
        $password = $_POST['edit_password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $edit_emp = "UPDATE tbl_regis SET birthdate = :birhtday, iden_code = :iden_code, email = :email, password = :password ,updated_at = NOW() WHERE emp_code = :empcode";

        $stmt = $conn->prepare($edit_emp);
        $stmt->bindParam(':birhtday', $birhtday);
        $stmt->bindParam(':iden_code', $iden_code);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':empcode', $empcode);
        $stmt->execute();

        if($stmt){
            header("Location: ../admin?manage=users&id=$empcode&edit_success");
        }else{
            header("Location: ../admin?manage=edit&id=$empcode&edit_fail");
        }
        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn = null;
    }else{
        header("Location: ../login.php");
    }
?>