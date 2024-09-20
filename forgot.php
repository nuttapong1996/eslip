<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title>ลืมรหัสผ่าน</title>
</head>
<body class="bg-gray ibm-plex-sans-thai-regular">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content ">
            <main class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-6">
                        <img src="assets/images/logo.png" class="d-block mx-auto mb-4" width="300px">
                        <div class="card p-3 rounded-0 border-0 shadow-lg ">
                            <h4 class="text-center fw-normal">ลืมรหัสผ่าน</h4>
                            <small class="text-muted text-center">กรุณากรอกข้อมูล เพื่อแก้ไขรหัสผ่าน</small>
                            <div class="card-body">
                                <form method="POST" id="regisForm" class="needs-validation" novalidate  action="backend/forgot_proc.php" autocomplete=off>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control form-control-sm" name="emp_re" id="empcode"  onkeydown="return /[a-zA-Z0-9]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Enter'].includes(event.key)" placeholder="กรุณากรอกรหัสพนักงาน" required autocomplete="off"  maxlength="8">
                                                <label for="empcode">รหัสพนักงาน</label>
                                                <div id="msg1" ></div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control " name="iden_re" id="idencode" onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Enter'].includes(event.key)"   placeholder="เลขบัตรประชาชน" required autocomplete="off"  maxlength="13" />
                                                <label for="idencode">เลขบัตรประชาชน</label>
                                                <div id="msg2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid ">
                                        <button class="btn btn-sm btn-primary"  id="submit" type="submit">ตกลง</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <div class="small"><a href="login">มีบัญชีอยู่แล้ว? ลงชื่อเข้าใช้</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <small class="text-muted ibm-plex-sans-thai-light">
                            Developed by IT Department (Maemoh)<br>
                            &copy; 2024-<?php echo date('Y'); ?> Sahakol Equipment PCL.
                        </small>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>

<?php 
     if(isset($_GET['expired'])){
        echo "<script>
                Swal.fire({
                    title: 'โทเค็นหมดอายุ',
                    text: 'กรุณาทำรายการอีกครั้ง',
                    icon: 'error'
                }).then(function(){ location.href = 'forgot';},20000);
            </script>";    
    }
    if(isset($_GET['notfound'])){
        echo "<script>
                Swal.fire({
                    title: 'รหัสพนักงานหรือเลขบัตรประชาชนไม่ถูกต้อง',
                    text: 'กรุณาตรวจสอบและทำรายการอีกครั้ง',
                    icon: 'error'
                }).then(function(){ location.href = 'forgot';},20000);
            </script>";    
    }
    if(isset($_GET['error'])){
        echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรณาทำรายการอีกครั้ง',
                    icon: 'error'
                }).then(function(){ location.href = 'forgot';},20000);
            </script>";    
    }
?>