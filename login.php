<?php
session_start();
if(isset($_SESSION['empcode'])){
    header('location:index');
}else{
?>   
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- PWA  -->
                <!-- <link rel="manifest" href="manifest.json">
                <meta name="apple-mobile-web-app-capable" content="yes">
                <meta name="apple-mobile-web-app-status-bar-style" content="black">
                <meta name="apple-mobile-web-app-title" content="E-Slip:SQMM"> -->

            <!-- iOS icon -->
                <!-- <link rel="apple-touch-icon" href="assets/images/icon.png">
                <link rel="apple-touch-icon" sizes="152x152" href="assets/images/icon-152x152.png">
                <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon-180x180.png">
                <link rel="apple-touch-icon" sizes="167x167" href="assets/images/icon-167x167.png"> -->




            <!-- iOS splash -->
                <!-- <meta name="apple-mobile-web-app-capable" content="yes" />
                <link href="assets/images/splash-2048.png" sizes="2048x2732" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-1668.png" sizes="1668x2224" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-1536.png" sizes="1536x2048" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-1125.png" sizes="1125x2436" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-1242.png" sizes="1242x2208" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-750.png" sizes="750x1334" rel="apple-touch-startup-image" />
                <link href="assets/images/splash-640.png" sizes="640x1136" rel="apple-touch-startup-image" /> -->


            <?php include 'components/head.php'; ?>
            <title>Login</title>
        </head>
        <body class="bg-gray ibm-plex-sans-thai-regular">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content ">
                <main>
                    <div class="container mt-5">
                        <div class="mobilenav">
                            <div class=" mt-5"></div>
                        </div>
                        <div class="row justify-content-center mt-3">
                        <div class="text-center"><img src="assets/images/logo.png" width="300px"></div>
                            <div class="col-sm-5 mt-3">
                                <form action="backend/login_proc.php" method="POST" class=" bg-white text-center p-3 rounded-2 shadow" autocomplete=off>
                                <h5>เข้าสู่ระบบ</h5>
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="username" placeholder="รหัสพนักงาน" value="<?php if( isset($_COOKIE['empcode'])){ echo $_COOKIE['empcode']; } ?>" autocomplete=off maxlength="7">
                                        <label for="floatingInput">รหัสพนักงาน</label>
                                    </div>
                                    <!-- <label for="floatingPassword">รหัสผ่าน</label> -->
                                    <div class="input-group mt-3 mb-3">
                                        <input type="password" class="form-control" name="password" id="loginpassword" placeholder="รหัสผ่าน" autocomplete=off <?php if( isset($_COOKIE['empcode'])){ echo 'autofocus'; }  ?> maxlength="8">
                                        <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek">
                                            <i class="fa fa-eye-slash" id="togglebtnlogin"></i>
                                        </button>
                                        <div id="message"></div>                                
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="on" name="keep" id="keep" checked>
                                            <label class="form-check-label" for="keep">จดจำรหัสพนักงาน</label>
                                        </div>
                                        <a href="forgot"><b>ลืมรหัสผ่าน</b></a>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                                    <hr>
                                    <a href="regis" class=""><b>สมัครสมาชิก</b"></a>
                                </form>                
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
<?php } ?>

<?php
    if(isset($_GET['wrong'])){
    echo "<script>
            Swal.fire({
                title: 'รหัสผ่านไม่ถูกต้อง',
                text: 'กรุณาตรวจสอบและเข้าสู่ระบบอีกครั้ง',
                icon: 'error'
            }).then(function(){ location.href = 'login';},20000);
        </script>";    
    }

    if(isset($_GET['error'])){
    echo "<script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณาตรวจสอบและเข้าสู่ระบบอีกครั้ง',
                icon: 'error'
            }).then(function(){ location.href = 'login';},20000);
        </script>";    
    }
    if(isset($_GET['regis_success'])){
        echo "<script>
                Swal.fire({
                    title: 'สมัครสมาชิกสําเร็จ',
                    text: 'สามารถใช้งานได้ทันที',
                    icon: 'success'
                }).then(function(){ location.href = 'login';},20000);
            </script>";    
    }
    if(isset($_GET['reset_success'])){
        echo "<script>
                Swal.fire({
                    title: 'แก้ไขรหัสผ่านสําเร็จ',
                    text: 'สามารถใช้งานได้ทันที',
                    icon: 'success'
                }).then(function(){ location.href = 'login';},20000);
            </script>";    
    }
?> 

   
<?php if(isset($_GET['notfound'])){ ?>

        <script>
                Swal.fire({
                    title: 'ไม่พบรหัสพนักงานในระบบ',
                    text: 'กรุณาสมัครสมาชิกก่อนเข้าสู่ระบบ',
                    icon: 'error',
                    footer: '<a href="regis">สมัครสมาชิก</a>'
                }).then(function(){ location.href = 'login';},20000);
            </script>";    
<?php  } ?>
   
