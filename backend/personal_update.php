<?php
session_start();
if(isset($_SESSION['empcode']) && isset($_POST['email']) && isset($_POST['birhtday'])){

    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'];
    $email = $_POST['email'];
    $birhtday = $_POST['birhtday'];

    if(isset($_POST['update'])){
        if(isset($_POST['email'])){
            $user_update = "UPDATE tbl_regis SET email = :email ,birthdate = :birhtday WHERE emp_code = :empcode";
            $stmt = $conn->prepare($user_update);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':empcode', $empcode);
            $stmt->bindParam(':birhtday', $birhtday);
            $stmt->execute();
            header('location: ../user?manage=user_detail&update_success');

        }else{
            header('location: ../user?manage=user_detail&update_fail');
        }
    }
    $conn = null;
}else{
    header('location: ../login');
}


?>