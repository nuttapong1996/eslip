<?php
session_start();
if(isset($_SESSION['empcode']) && isset($_POST['email']) ){

    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'];
    $email = $_POST['email'];

    if(isset($_POST['update'])){
        if(isset($_POST['email'])){
            $user_update = "UPDATE tbl_regis SET email = :email WHERE emp_code = :empcode";
            $stmt = $conn->prepare($user_update);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':empcode', $empcode);
            $stmt->execute();
            header('location: ../user?manage=user_detail&update_success');

        }else{
            header('location: ../user?manage=user_detail&update_fail');
        }
    }
}else{
    header('location: ../login');
}


?>