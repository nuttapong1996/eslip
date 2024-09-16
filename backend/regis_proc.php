<?php 
// ตรวจสอบว่ามีการ post มาหรือไม่
if(isset($_POST['empcode'])&&isset($_POST['idencode'])&&isset($_POST['password'])&&isset($_POST['birhtday'])){
    
    //เรียกใช้งานไฟล์ connect_db.php
    require_once __DIR__ . '/../includes/connect_db.php';


    /** Checklist */
    // 2.เช็ครหัสบัตรประชาชนว่ามีอยู่มั้ย
    // 3.เช็คอีเมลว่ามีอยู่มั้ย
    // 4.ทำการเข้ารหัสผ่านก่อน insert

    $empcode =$_POST['empcode'];
    $idencode =$_POST['idencode'];
    $password =$_POST['password'];
    $email =$_POST['email'];
    $birhtday =$_POST['birhtday'];


    //ทำการเข้ารหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        //Query สำหรับตรวจสอบรหัสพนักงานซ้ำบนตาราง tbl_regis
        $user_exist ="SELECT emp_code FROM tbl_regis WHERE emp_code =:empcode";
        $stmt_user_exist = $conn->prepare($user_exist);
        $stmt_user_exist->bindParam(':empcode', $empcode);
        $stmt_user_exist->execute();

        // Query สำหรับตรวจสอบเลขบัตรประชาชนซ้ำบนตาราง tbl_regis
        $iden_exist ="SELECT iden_code FROM tbl_regis WHERE iden_code =:idencode;";
        $stmt_iden_exist =$conn->prepare($iden_exist);
        $stmt_iden_exist->bindParam(':idencode', $idencode);
        $stmt_iden_exist->execute();

        // Query สำหรับตรวจสอบอีเมลซ้ำบนตาราง tbl_regis
        $email_exist ="SELECT email FROM tbl_regis WHERE email =:email;";
        $stmt_email_exist = $conn->prepare($email_exist);
        $stmt_email_exist->bindParam(':email', $email);
        $stmt_email_exist->execute();

        // 1.ตรวจสอบรหัสพนักงานซ้ำบนตาราง tbl_regis
        if($stmt_user_exist->rowCount() > 0){
            header("location: ../regis.php?user_exist");
        }else{
            // 2.ตรวจสอบเลขบัตรประชาชนซ้ำบนตาราง tbl_regis
            if($stmt_iden_exist->rowCount() > 0){
                header("location: ../regis.php?iden_exist");
            }else{
                // 3.ตรวจสอบอีเมลซ้ำบนตาราง tbl_regis
                if($stmt_email_exist->rowCount() > 0){
                    header("location: ../regis.php?email_exist");
                }else{
                    // 4.เพิ่มข้อมูลลงตาราง tbl_regis
                    $email_exist ="SELECT email FROM tbl_regis WHERE email =:email;";
                    $stmt_email_exist = $conn->prepare($email_exist);
                    $stmt_email_exist->bindParam(':email', $email);
                    $stmt_email_exist->execute();
                    $email_exist_row = $stmt_email_exist->fetch(PDO::FETCH_ASSOC);
                
                    // Query โค๊ด SQL สำหรับลงทะเบียนเพิ่มข้อมูลพนักงาน
                    $regis = "INSERT INTO tbl_regis (
                                emp_code,
                                password,
                                email,
                                iden_code,
                                birthdate )
                            VALUES (
                                :empcode , 
                                :password , 
                                :email ,
                                :idencode ,
                                :birhtday
                                );";
                
                    $stmt_regis = $conn->prepare($regis);
                    $stmt_regis->bindParam(':empcode', $empcode);
                    $stmt_regis->bindParam(':password', $hashed_password);
                    $stmt_regis->bindParam(':email', $email);
                    $stmt_regis->bindParam(':idencode', $idencode);
                    $stmt_regis->bindParam(':birhtday', $birhtday);
                    $stmt_regis->execute();

                    if($stmt_regis){
                        header("location: ../regis.php?regis_success");
                    }else{
                        header("location: ../regis.php?regis_fail");
                    }
                    
                }
            }
        }
}else{
    header("location: ../regis.php?regis_fail");
}
?>