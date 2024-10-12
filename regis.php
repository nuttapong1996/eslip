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
                        <div class="col-sm-7">
                        <div class="text-center mb-3 mt-3"><img src="assets/images/logo.png" width="200px"></div>
                            <div class="card shadow-lg border-0 rounded-3">                  
                                <div class="card-body">
                                    <h5 class="text-center font-weight-light mb-3">สมัครสมาชิก</h5>
                                    <form id="regisForm" action="backend/regis_proc.php" class="needs-validation" novalidate  method="POST" autocomplete="off">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3 mb-sm-0">
                                                    <input class="form-control " name="empcode" id="empcode" type="text" onkeydown="return /[a-zA-Z0-9]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="รหัสพนักงาน" required autocomplete="off" maxlength="7"/>
                                                    <label for="empcode"><i class="text-danger">*</i> รหัสพนักงาน</label>
                                                        <div id="msg1" ></div>                                            
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3 mb-sm-0">
                                                    <input type="hidden" name="empcode2" id="empcode2">
                                                    <input class="form-control" name="idencode" id="idencode" type="text"    onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="เลขบัตรประชาชน" required autocomplete="off" maxlength="13" />
                                                    <label for="idencode">เลขบัตรประชาชน</label>
                                                    <div id="msg2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">                                            
                                            <p class="p-0 m-0">เลือก วัน-เดือน-ปี เกิด</p>
                                            <div class="row mb-2">

                                                <div class="col-sm-3 mb-3">
                                                    <div class="form-floating">                                                                                        
                                                        <!-- <input type="text" class="form-control" name="birhtday" id="birhtday" onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)" > -->
                                                        <select  name="birhtday" id="birhtday" class="form-select">
                                                            <option value="" selected>-</option>
                                                            <?php
                                                                for ($i = 1; $i <= 31; $i++) {
                                                                    if ($i < 10) {
                                                                        echo '<option value="0'.$i.'">'.$i.'</option>';
                                                                    }
                                                                    else{
                                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                                    }                                                                       
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="birhtday">วันที่</label>
                                                        <div id="msgbd" class="invalid-feedback"></div>                                            
                                                    </div>                                      
                                                </div>

                                                <div class="col-sm-6 mb-3">
                                                    <div class="form-floating">                                          
                                                        <select name="birhtmonth" id="birhtmonth" class="form-select">
                                                            <option value="" selected>-</option>
                                                            <option value="01">มกราคม</option>
                                                            <option value="02">กุมภาพันธ์</option>
                                                            <option value="03">มีนาคม</option>
                                                            <option value="04">เมษายน</option>
                                                            <option value="05">พฤมภาคม</option>
                                                            <option value="06">มิถุนายน</option>
                                                            <option value="07">กรกฎาคม</option>
                                                            <option value="08">สิงหาคม</option>
                                                            <option value="09">กันยายน</option>
                                                            <option value="10">ตุลาคม</option>
                                                            <option value="11">พฤศจิกายน</option>
                                                            <option value="12">ธันยาคม</option>
                                                        </select>
                                                        <label for="birhtmonth">เดือน</label>
                                                        <div id="msgbm" class="invalid-feedback"></div>                                            
                                                    </div>                                      
                                                </div>

                                                <div class="col-sm-3 mb-3">
                                                    <div class="form-floating">                                            
                                                        <select name="birthyear" id="birthyear" class="form-select">
                                                            <option value="" selected>-</option>
                                                           <?php
                                                                $yearstart = 1900;
                                                                $yearend = date('Y');
                                                                for ($i=$yearend; $i >= $yearstart; $i--) {
                                                                    echo "<option value='$i'>".($i+543)."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="birthyear">ปี(พ.ศ.)</label>
                                                        <div id="msgby" class="invalid-feedback"></div>                                            
                                                    </div>                                      
                                                </div>

                                            </div>
                                            <small class="text-bg-warning px-2 mt-2"><b>กรุณากรอกวันเดือนปีเกิดให้ถูกต้อง</b> เนื่องจากจะมีผลต่อการเปิดดูสลิปเงินเดือนแบบ PDF</small>                                         
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" autocomplete="off" />
                                            <label for="inputEmail">e-mail (ไม่บังคับ)</label>
                                        </div>

                                        <div class="row mb-3">                                            
                                            <div class="col-md-6 mb-3">                                  
                                                <label for="password">รหัสผ่าน</label>
                                                <div class="input-group">
                                                    <input class="form-control rounded-0 rounded-start" name="password" id="password" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"  placeholder="รหัสผ่าน" required autocomplete="off" maxlength="8" />
                                                    <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek1">
                                                        <i class="fa fa-eye-slash" id="togglebtn1"></i>
                                                    </button>                                                    
                                                    <div id="message"></div>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-6">                                          
                                                <label for="cfpassword">ยืนยันรหัสผ่าน</label>
                                                    <div class="input-group">
                                                    <input class="form-control rounded-0 rounded-start" name="cfpassword" id="cfpassword" type="password" onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"  placeholder="ยืนยันรหัสผ่าน" required autocomplete="off" maxlength="8" />
                                                    <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek2">
                                                        <i class="fa fa-eye-slash" id="togglebtn2"></i>
                                                    </button>
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
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-block" id="submit" >สมัครสมาชิก</button>
                                            </div>
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

