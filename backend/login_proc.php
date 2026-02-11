<?php 
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    // session_start();
    require_once __DIR__ . '/../includes/connect_db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $keep = isset($_POST['keep']) ? $_POST['keep'] : '';


    // Set cookie to expire in 1 year (365 days)
    $expireTime = time() + (365 * 24 * 60 * 60); // 1 year from now

    // คำสั่ง SQL ตรวจสอบการเข้าสู่ระบบ
    $login = "SELECT 
                table_emp.code_emp, 
                table_emp.name_thai_emp, 
                table_emp.position_emp, 
                table_dept.name_deptemp,
                table_dept.short_name_deptemp,
                table_regis.iden_code,
                table_regis.birthdate,
                table_regis.email,
                table_regis.password,
                table_regis.emp_pic,
                table_regis.role
              FROM
                tbl_regis AS table_regis
              JOIN tbl_emp AS table_emp ON table_regis.emp_code = table_emp.code_emp
              JOIN tbl_dept_emp AS table_dept ON table_emp.dept_emp = table_dept.code_tbl_deptemp
              WHERE
                table_regis.emp_code = :empcode";

    $stmt_login = $conn->prepare($login);
    $stmt_login->bindParam(':empcode', $username);
    $stmt_login->execute();
    $row = $stmt_login->fetch(PDO::FETCH_ASSOC);

    // 1. ตรวจสอบรหัสพนักงาน
    if($stmt_login->rowCount() > 0){     

        // 2. ตรวจสอบรหัสผ่าน
        if(password_verify(trim($password), trim($row['password']))){ 

            // 3. เก็บ Session
            $_SESSION['empcode'_elip] = $row['code_emp'];
            $_SESSION['name'] = $row['name_thai_emp'];
            $_SESSION['position'] = $row['position_emp'];
            $_SESSION['dept_emp'] = $row['short_name_deptemp'];
            $_SESSION['iden_code'] = $row['iden_code'];
            $_SESSION['birthdate'] = $row['birthdate'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['emppic'] = $row['emp_pic'];
            $_SESSION['role'] = $row['role'];


            // 4. เก็บ Cookie รหัสพนักงาน
            if($keep == "on"){
                setcookie('empcode', $row['code_emp'], $expireTime, "/");
            }

            // ไปยังหน้า Dashboard
            header("location: ../index");
            exit;

        } else {
            // รหัสผ่านไม่ถูกต้อง
            header("location: ../login?wrong");
            exit;
        }
    } else {
        // รหัสพนักงานไม่ถูกต้อง
        header("location: ../login?notfound");
        exit;
    }
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
} else {
    // กรอกข้อมูลไม่ครบ
    header("location: ../login?error");
    exit;
}
?>
