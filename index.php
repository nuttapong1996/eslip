<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title>Login</title>
</head>
<body class="ibm-plex-sans-thai-regular">
    <div class="container">
        <div class="row justify-content-center">
        <div class="text-center mt-5"><img src="assets/images/logo.png" width="300px"></div>
            <div class="col-sm-5 mt-3">
                <form action="home.php" method="post" class=" bg-white text-center p-3 rounded-3 shadow">
                <h5>เข้าสู่ระบบ</h5>
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="รหัสพนักงาน">
                        <label for="floatingInput">รหัสพนักงาน</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="รหัสผ่าน">
                        <label for="floatingPassword">รหัสผ่าน</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary w-100">เข้าสู่ระบบ</button>
                    <hr>
                    <a href="#" class="text-decoration-none"><b>สมัครสมาชิก</b"></a>
                </form>                
            </div>
            <br>
            <div class="text-center">
                <small class="text-muted ibm-plex-sans-thai-light">
                    Developed by IT Department (Maemoh)<br>
                    &copy; <?php echo date('Y'); ?> Sahakol Equipment PCL.
                </small>
            </div>
        </div>
    </div>
</body>
</html>