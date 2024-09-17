<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title>สมัครสมาชิก</title>
</head>
<body class="bg-gray ibm-plex-sans-thai-regular">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content ">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                        <div class="text-center mb-3 mt-3"><img src="assets/images/logo.png" width="200px"></div>
                            <div class="card shadow-lg border-0 rounded-3">
                                <!-- <div class="card-header"><h3 class="text-center font-weight-light">สมัครสมาชิก</h3></div> -->                    
                                <div class="card-body">
                                    <h5 class="text-center font-weight-light mb-3">สมัครสมาชิก</h5>
                                    <form id="regisForm" action="backend/regis_proc.php" class="needs-validation" novalidate  method="POST" autocomplete="off">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3 mb-sm-0">
                                                    <input class="form-control " name="empcode" id="empcode" type="text" onkeydown="return /[a-zA-Z0-9]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="รหัสพนักงาน" required autocomplete="off"/>
                                                    <label for="empcode">รหัสพนักงาน</label>
                                                        <div id="msg1" ></div>                                            
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3 mb-sm-0">
                                                    <input class="form-control" name="idencode" id="idencode" type="text"    onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="เลขบัตรประชาชน" required autocomplete="off" />
                                                    <label for="idencode">เลขบัตรประชาชน</label>
                                                    <div id="msg2"></div>
                                                </div>
                                            </div>
                                        </div>                                    
                                        <div class="form-floating mb-3 ">
                                            <input class="form-control" name="birhtday" id="birhtday" type="date"   required autocomplete="off"/>
                                            <label for="birhtday">ว-ด-ป เกิด</label>
                                            <div id="msg3" class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" type="email"  placeholder="name@example.com" autocomplete="off" />
                                            <label for="inputEmail">Email (ไม่บังคับ)</label>
                                        </div>
                                        <div class="row mb-3">                                            
                                            <div class="col-md-6">                                                
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  name="password" id="password" type="password"  onkeyup="checkPasswordMatch()"  placeholder="Create a password" required autocomplete="off" />
                                                    <label for="password">รหัสผ่าน</label>
                                                    <div id="message"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="cfpassword" id="cfpassword" type="password"  onkeyup="checkPasswordMatch()" placeholder="Confirm password" required autocomplete="off" />
                                                    <label for="cfpassword">ยืนยันรหัสผ่าน</label>
                                                    <div id="messagecf"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button class="btn btn-primary btn-block" id="submit" >สมัครสมาชิก</button></div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <div class="small"><a href="login.php">มีบัญชีอยู่แล้ว? ลงชื่อเข้าใช้</a></div>
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
                </div>
            </main>
        </div>
    </div>
</body>
</html>

<?php 
    if(isset($_GET['user_exist'])){
        echo "<script>
                Swal.fire({
                    title: 'รหัสพนักงานนี้ถูกใช้สมัครไปแล้ว',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis.php';},20000);
            </script>";    
    }
    if(isset($_GET['iden_exist'])){
        echo "<script>
                Swal.fire({
                    title: 'เลขบัตรประชาชนนี้ถูกใช้สมัครไปแล้ว',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis.php';},20000);
            </script>";    
    }
    if(isset($_GET['email_exist'])){
        echo "<script>
                Swal.fire({
                    title: 'อีเมล์นี้ถูกใช้สมัครไปแล้ว',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis.php';},20000);
            </script>";    
    }
    if(isset($_GET['regis_success'])){
        echo "<script>
                Swal.fire({
                    title: 'สมัครสมาชิกสําเร็จ',
                    text: 'สามารถใช้งานได้ทันที',
                    icon: 'success'
                }).then(function(){ location.href = 'regis.php';},20000);
            </script>";    
    }
    if(isset($_GET['regis_fail'])){
        echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาดในการสมัครสมาชิก',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis.php';},20000);
            </script>";    
    }
?>

