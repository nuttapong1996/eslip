<?php
 session_start();
    if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am" && isset($_GET['id'])){

        require_once __DIR__ . '/../includes/connect_db.php';

        $id = $_GET['id'];

        $delete_sql = "DELETE FROM tbl_regis WHERE emp_code = :empcode";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bindParam(':empcode', $id);
        $delete_stmt->execute();

        if($delete_stmt){
            header("Location: ../admin?manage=users&id=$id&delete_success");
            // header("Location: user_manage.php?delete_success");
        }else{
            header("Location: ../admin?manage=users&id=$id&delete_fail");
        }
        $conn = null;
        
    }else{
        header("location: ../login");
    }
?>