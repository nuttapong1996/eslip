<?php
if(isset($_SESSION['empcode'_elip]) && trim($_SESSION['role'])=="am" && isset($_GET['id'])){
    // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $id = $_GET['id'];
    $detail_sql= "SELECT 
                    table_emp.code_emp , 
                    table_emp.name_thai_emp , 
                    table_emp.position_emp , 
                    table_dept.short_name_deptemp,
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
    $detail_stmt->bindParam(':empcode', $id);
    $detail_stmt->execute();
    $detail_row = $detail_stmt->fetch(PDO::FETCH_ASSOC);

    $title = "แก้ไขผู้ใช้งานรหัส ".$id;
?>
    <main>
        <div class="container px-4">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-5">
                <h5 class="mb-4 text-center">แก้ไขรายละเอียดผู้ใช้งาน</h5>
                    <div class="card border-0 rounded-0 p-2 mb-4 shadow-sm">                    
                        <div class="card-body">
                            <form method="POST" action="manage/update_user_proc.php"  class="needs-validation">
                                <input type="hidden" name="empcode" value="<?php echo $detail_row['code_emp'] ?>">

                                <div class="mb-3">                            
                                    <label for="name"><b>ชื่อ : </b> <?php echo trim($detail_row['name_thai_emp']) ?> <b>รหัส : </b> <?php echo trim($detail_row['code_emp']) ?>  <br><b>ตําแหน่ง : </b><?php echo trim($detail_row['position_emp']) ?><b> แผนก/ฝ่าย : </b><?php echo trim($detail_row['short_name_deptemp']) ?></label>
                                </div>

                                <div class="form-floating mb-3 ">
                                    <input class="form-control" name="edit_birhtday" id="edit_birhtday" type="date" onkeydown="return false"   required autocomplete="off" value="<?php echo trim($detail_row['birthdate']) ?>"/>
                                    <label for="birhtday">เลือก ว-ด-ป เกิด</label>
                                    <div id="msg3" class="invalid-feedback"></div>
                                </div>

                                <div class="form-floating mb-3">                                
                                    <input type="text" class="form-control" name="edit_iden_code" id="edit_iden_code" value="<?php echo trim($detail_row['iden_code']) ?>">
                                    <label for="iden_code">รหัสบัตรประชาชน</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"  name="edit_email" id="edit_email"  value="<?php echo trim($detail_row['email']) ?>">
                                    <label for="iden_code" class="form-label">Email</label>
                                </div>

                                <div class="form-floating mb-3">                                
                                <label for="password">รหัสผ่าน</label>
                                    <div class="input-group">
                                        <input class="form-control rounded-0 rounded-start" name="edit_password" id="password" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"  placeholder="รหัสผ่าน" required autocomplete="off" maxlength="8"  />
                                        <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek1">
                                            <i class="fa fa-eye-slash" id="togglebtn1"></i>
                                        </button>                                                    
                                        <div id="message"></div>
                                    </div>
                                </div>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}

if(isset($_GET['edit_fail'])){
    echo "<script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณาตรวจสอบและทำรายการอีกครั้ง',
                icon: 'error',
                showConfirmButton: true,
            }).then(function() {
                 window.location ='./admin?manage=edit&id=".$id."';
            })
        </script>";    
}

?>
