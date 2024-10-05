<?php
if(isset($_SESSION['empcode'])){
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'];

    $detail_sql= "SELECT 
                    table_emp.code_emp , 
                    table_emp.name_thai_emp , 
                    table_emp.position_emp , 
                    table_dept.name_deptemp,
                    table_regis.iden_code,
                    table_regis.birthdate,
                    table_regis.email,
                    table_regis.password,
                    table_regis.emp_pic
                FROM
                    tbl_regis    AS table_regis
                JOIN tbl_emp      AS table_emp ON table_regis.emp_code  = table_emp.code_emp
                JOIN tbl_dept_emp AS table_dept ON table_emp.dept_emp = table_dept.code_tbl_deptemp
                WHERE
                table_regis.emp_code  = :empcode";

    $detail_stmt = $conn->prepare($detail_sql);
    $detail_stmt->bindParam(':empcode', $empcode);
    $detail_stmt->execute();
    $detail_row = $detail_stmt->fetch(PDO::FETCH_ASSOC);

 ?>                                          
<img  class="rounded-circle  " style="clip-path: circle(); width: 100px; object-fit: cover" src="<?php if($detail_row['emp_pic'] != ""){echo "uploads/emp_pic/".$detail_row['emp_pic']."?version=".time();}else{echo 'assets/images/noimage.png';}?>"    width="100px" alt="">
<?php
}else{
    header("location: ../login");
}
?>