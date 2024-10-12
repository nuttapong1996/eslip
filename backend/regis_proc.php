<?php 
if(isset($_POST['empcode'])&&isset($_POST['idencode'])&&isset($_POST['password'])&&isset($_POST['birhtday'])&&isset($_POST['birhtmonth'])&&isset($_POST['birthyear'])){
    
    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode =$_POST['empcode'];
    $idencode =$_POST['idencode'];
    $password =$_POST['password'];
    $email =$_POST['email'];
    $birhtday =$_POST['birhtday'];
    $birhtmonth =$_POST['birhtmonth'];
    $birthyear =$_POST['birthyear'];

    $birhtdate = $birthyear.'-'.$birhtmonth.'-'.$birhtday;

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


        // Query โค๊ด SQL สำหรับลงทะเบียนเพิ่มข้อมูลพนักงาน
        $regis = "INSERT INTO tbl_regis (
            emp_code,
            password,
            email,
            iden_code,
            birthdate,
            role )
        VALUES (
            :empcode , 
            :password , 
            :email ,
            :idencode ,
            :birhtday,
            'u');";
    
        $stmt_regis = $conn->prepare($regis);
        $stmt_regis->bindParam(':empcode', $empcode);
        $stmt_regis->bindParam(':password', $hashed_password);
        $stmt_regis->bindParam(':email', $email);
        $stmt_regis->bindParam(':idencode', $idencode);
        $stmt_regis->bindParam(':birhtday', $birhtdate);

        // 1.ตรวจสอบรหัสพนักงานซ้ำบนตาราง tbl_regis
        if($stmt_user_exist->rowCount() > 0){
            header("location: ../regis?user_exist");
        }else{
            // 2.ตรวจสอบเลขบัตรประชาชนซ้ำบนตาราง tbl_regis
            if($stmt_iden_exist->rowCount() > 0){
                header("location: ../regis?iden_exist");
            }else{
                //ตรวจสอบค่าว่าง หากผู้ใช้ใส่อีเมลมาก็อนุญาตให้ลงทะเบียน
                if($email !==""){
                    // 3.ตรวจสอบอีเมลซ้ำบนตาราง tbl_regis
                    if($stmt_email_exist->rowCount() > 0){
                        header("location: ../regis?email_exist");
                    }else{                
                        $stmt_regis->execute();
                        //ตรวจสอบ Query ของการลงทะเบียน
                        if($stmt_regis){
                            header("location: ../login?regis_success");
                        }else{
                            header("location: ../regis?regis_fail");
                        }
                    }
                }else{ //หากไม่ได้ใส่ก็อนุญาตใลงทะเบียน
                    $stmt_regis->execute();
                    header("location: ../login?regis_success");
                }      
            }
        }
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    header("location: ../regis?regis_fail");
}
?>