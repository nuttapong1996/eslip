<?php
    if(isset($_POST['emp_re']) && isset($_POST['iden_re'])){

    //เรียกใช้งานไฟล์ connect_db.php
    require_once __DIR__ . '/../includes/connect_db.php';

    date_default_timezone_set('Asia/Bangkok');

    $empcode =$_POST['emp_re'];
    $idencode =$_POST['iden_re'];
    

    // Query เช็กว่ามีรหัสพนักงานและรหัสบัตรประชาชนในฐานข้อมูล
    $forgot = 'SELECT emp_code FROM tbl_regis WHERE emp_code = :empcode AND iden_code =:idencode';
    $stmt_forgot = $conn->prepare($forgot);
    $stmt_forgot->bindParam(':empcode', $empcode);
    $stmt_forgot->bindParam(':idencode', $idencode);
    $stmt_forgot->execute();




    if($stmt_forgot->rowCount() > 0){        
        $resetToken = generateToken();
        $expire = date("Y-m-d H:i:s", strtotime("+ 5 minutes"));

        // Query insert reset token
        $reset_token = 'UPDATE tbl_regis SET reset_token = :token, reset_token_expire_date = :expire WHERE emp_code = :empcode';
        $stmt_reset_token = $conn->prepare($reset_token);
        $stmt_reset_token->bindParam(':token', $resetToken);
        $stmt_reset_token->bindParam(':expire', $expire);
        $stmt_reset_token->bindParam(':empcode', $empcode);
        $stmt_reset_token->execute();

        // ไปหน้า reset พร้อมส่งค่า token 
        header("location: ../reset?token=$resetToken");
    }else{
        header("location: ../forgot?notfound");
    }

    $conn=null;
    }

    function generateToken($length = 32) {
        return bin2hex(random_bytes($length / 2));
    }

?>