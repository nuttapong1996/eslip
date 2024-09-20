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
                <div class="container-xl">
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
                                                    <input class="form-control " name="empcode" id="empcode" type="text" onkeydown="return /[a-zA-Z0-9]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="รหัสพนักงาน" required autocomplete="off" maxlength="7"/>
                                                    <label for="empcode">รหัสพนักงาน</label>
                                                        <div id="msg1" ></div>                                            
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3 mb-sm-0">
                                                    <input class="form-control" name="idencode" id="idencode" type="text"    onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="เลขบัตรประชาชน" required autocomplete="off" maxlength="13" />
                                                    <label for="idencode">เลขบัตรประชาชน</label>
                                                    <div id="msg2"></div>
                                                </div>
                                            </div>
                                        </div>                                    
                                        <div class="form-floating mb-3 ">
                                            <input class="form-control" name="birhtday" id="birhtday" type="date" onkeydown="return false"   required autocomplete="off"/>
                                            <label for="birhtday">เลือก ว-ด-ป เกิด</label>
                                            <div id="msg3" class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" autocomplete="off" />
                                            <label for="inputEmail">e-mail (ไม่บังคับ)</label>
                                            <span id="error-message" style="color:red; display:none;">Please enter a valid email address</span>
                                        </div>
                                        <div class="row mb-3">                                            
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">                                              
                                                    <div class="form-floating">
                                                        <input class="form-control" name="password" id="password" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"  placeholder="Create a password" required autocomplete="off" maxlength="8" />
                                                        <label for="password">รหัสผ่าน</label>
                                                        <div id="message" class="invalid-feedback order-0">test</div>
                                                    </div>
                                                    <div class="input-group-text "><i class="fa fa-eye"></i></div>
                                                </div>  
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="cfpassword" id="cfpassword" type="password" onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"  placeholder="Confirm password" required autocomplete="off" maxlength="8" />
                                                    <label for="cfpassword">ยืนยันรหัสผ่าน</label>
                                                    <div id="messagecf"></div>
                                                </div>
                                            </div>
                                        </div>
                                            <!-- <div id="pwrule">
                                                <h6>รหัสผ่านต้องประกอบด้วยสิ่งต่อไปนี้:</h6>
                                                <p id="letter" class="invalid"><i class="fa fa-xmark" id="sym1"></i> อังกฤษ<b>พิมพ์เล็ก</b></p>
                                                <p id="capital" class="invalid"><i class="fa fa-xmark" id="sym2"></i> อังกฤษ<b>พิมพ์ใหญ่</b></p>
                                                <p id="number" class="invalid"><i class="fa fa-xmark" id="sym3"></i> ตัวเลข</p>
                                                <p id="length" class="invalid"><i class="fa fa-xmark" id="sym4"></i> อย่างน้อย<b> 8 ตัวอักษร</b></p>
                                            </div> -->
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button class="btn btn-primary btn-block" id="submit" >สมัครสมาชิก</button></div>
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
                }).then(function(){ location.href = 'regis';},20000);
            </script>";    
    }
    if(isset($_GET['iden_exist'])){
        echo "<script>
                Swal.fire({
                    title: 'เลขบัตรประชาชนนี้ถูกใช้สมัครไปแล้ว',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis';},20000);
            </script>";    
    }
    if(isset($_GET['email_exist'])){
        echo "<script>
                Swal.fire({
                    title: 'อีเมล์นี้ถูกใช้สมัครไปแล้ว',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis';},20000);
            </script>";    
    }
    if(isset($_GET['regis_success'])){
        echo "<script>
                Swal.fire({
                    title: 'สมัครสมาชิกสําเร็จ',
                    text: 'สามารถใช้งานได้ทันที',
                    icon: 'success'
                }).then(function(){ location.href = 'regis';},20000);
            </script>";    
    }
    if(isset($_GET['regis_fail'])){
        echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาดในการสมัครสมาชิก',
                    text: 'กรุณาติดต่อ จนท.ไอที เพื่อทำการแก้ไข',
                    icon: 'error'
                }).then(function(){ location.href = 'regis';},20000);
            </script>";    
    }
?>

