<?php
if(isset($_SESSION['empcode'])){
    $title = "รายละเอียดผู้ใช้งาน";
    require_once 'includes/connect_db.php';

    $empcode = $_SESSION['empcode'];

    $detail_sql= "SELECT 
                    table_emp.code_emp , 
                    table_emp.name_thai_emp , 
                    table_emp.position_emp , 
                    table_dept.name_deptemp,
                    table_regis.iden_code,
                    table_regis.birthdate,
                    table_regis.email,
                    table_regis.password
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
<title><?php echo $title ?></title>
<main>
    <div class="container px-4">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-5">
                <div class="card p-3 rounded-0 border-0 shadow-lg">
                    <h4 class="text-center fw-normal">รายละเอียดผู้ใช้งาน</h4>
                    <div class="card-body">
                        <form action="#" method="POST" class="needs-validation" novalidate>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="text-center mb-3">
                                        <img src="assets/images/test.png" class="rounded-circle" width="100px" alt="">
                                    </div>
                                    <div class="d-flex justify-content-center">                                        
                                        <input type="file" class="form-control form-control-sm w-50" id="Profilepic" placeholder="Profilepic">                                        
                                    </div>
                                </div>                                 
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 ">
                                  <p class="fw-normal p-0 m-1">ชื่อ - นามสกุล : <?php echo $detail_row['name_thai_emp']; ?></p>                                
                                  <p class="fw-normal p-0 m-1">รหัสผู้ใช้งาน : <?php echo $detail_row['code_emp']; ?></p>                                
                                  <p class="fw-normal p-0 m-1">ตำแหน่ง : <?php echo $detail_row['position_emp']; ?></p>                                
                                  <p class="fw-normal p-0 m-1">แผนก/ฝ่าย : <?php echo $detail_row['name_deptemp']; ?> </p>                                
                                </div>                                 
                            </div> 
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="email" required value="<?php if(trim($detail_row['email'])!=""){ echo trim($detail_row['email']);}else{echo '-';} ?>">
                                        <label for="name">Email</label>
                                    </div>
                                </div>                                 
                            </div> 
                            <!-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="idencode" placeholder="เลขบัตรประชาชน" required value="<?php //if(trim($detail_row['iden_code'])!=""){ echo trim($detail_row['iden_code']);}else{echo '-';} ?>">
                                        <label for="idencode">เลขบัตรประชาชน</label>
                                    </div>
                                </div>
                            </div>                             
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="birhtday" placeholder="วันเกิด" required value="<?php //echo date('Y-m-d',strtotime($detail_row["birthdate"])); ?>">
                                        <label for="idencode">วันเดือนปีเกิด</label>
                                    </div>
                                </div>
                            </div>                              -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php }else{
    header('location:../login');
}
?>