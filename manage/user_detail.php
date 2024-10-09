<?php
if(isset($_SESSION['empcode'])){
    // ชื่อหน้าเว็บ
    $title = "รายละเอียดผู้ใช้งาน";

    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
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
    <title><?php echo $title ?></title>
    <main>
        <div class="container px-4">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-5">
                    <div class="card p-3 rounded-0 border-0 shadow-lg">
                        <h4 class="text-center fw-normal">รายละเอียดผู้ใช้งาน</h4>
                        <div class="card-body">

                            <form action="./backend/upload_pic.php" method="POST" enctype="multipart/form-data" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center mb-3">
                                            <img class="rounded-circle " style="clip-path: circle(); width: 150px; object-fit: cover" src="<?php if($detail_row['emp_pic'] != ""){echo "uploads/emp_pic/".$detail_row['emp_pic']."?version=".time();}else{echo 'assets/images/noimage.png';}?>"  id="preview"  width="100px" alt="">
                                        </div>                                   
                                    </div>                                 
                                </div>

                                <div class="row text-center">
                                    <i id="imgname"></i>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                    <div class="d-flex flex-column align-items-center"> 
                                            <input type="file" class="form-control form-control-sm" name="emppic" id="emppic" accept=".jpg" style="display: none;">                                
                                            <label class="btn btn-outline-secondary btn-sm rounded  mb-2" for="emppic" ><i class="fas fa-camera"></i> &nbsp;เลือกรูปภาพ</label>
                                            <button class="btn btn-primary btn-sm rounded w-25" type="submit" id="upbtn"><i class="fas fa-cloud-upload-alt"></i> อัพโหลด</button>                                  
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 text-center">
                                    <p class="fw-normal p-0 m-1"><b>ชื่อ - นามสกุล :</b> <?php echo $detail_row['name_thai_emp']."<br><b>รหัสพนักงาน :</b>". $detail_row['code_emp']; ?></p>                                                                
                                    <p class="fw-normal p-0 m-1"><b>ตำแหน่ง :</b><?php echo $detail_row['position_emp']."<b>แผนก/ฝ่าย :</b>".$detail_row['name_deptemp']; ?></p>                               
                                                                
                                    </div>                                 
                                </div>
                            </form>

                            <form action="./backend/personal_update.php" method="POST" class="needs-validation" novalidate>                           
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating form-floating-sm">
                                            <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="email" required value="<?php if(trim($detail_row['email'])!=""){ echo trim($detail_row['email']);}else{echo '-';} ?>">
                                            <label for="name">Email</label>
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating form-floating-sm">
                                            <input type="date" class="form-control form-control-sm" name="birhtday" id="birhtday"  onkeydown="return false" required value="<?php echo trim($detail_row['birthdate']) ?>">
                                            <label for="name">วัน-เดือน-ปี เกิด</label>
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                    <button class="btn btn-primary w-100" type="submit" name = "update">บันทึก</button>
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
    header('location:../login');
}

if(isset($_GET['update_success'])){
    echo "<script>
            Swal.fire({
                title: 'อัพเดทข้อมูลสําเร็จ',
                icon: 'success',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=user_detail';
            })
        </script>";    
}
if(isset($_GET['update_fail'])){
    echo "<script>
            Swal.fire({
                title: 'อัพเดทข้อมูลไม่สําเร็จ',
                text: 'กรุณาตรวจสอบและทำรายการอีกครั้ง',
                icon: 'error',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=user_detail';
            })
        </script>";    
}
if(isset($_GET['upload_success'])){
    echo "<script>
            Swal.fire({
                title: 'อัพโหลดรูปภาพสําเร็จ',
                icon: 'success',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=user_detail';
            })
        </script>";    
}
if(isset($_GET['upload_fail'])){
    echo "<script>
            Swal.fire({
                title: 'อัพโหลดรูปภาพไม่สําเร็จ',
                text: 'กรุณาตรวจสอบและทำรายการอีกครั้ง',
                icon: 'error',
                showConfirmButton: true,
            }).then(function() {
                window.location ='user?manage=user_detail';
            })
        </script>";    
}

?>

