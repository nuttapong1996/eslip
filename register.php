<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title>สมัครสมาชิก</title>
</head>
<body class="ibm-plex-sans-thai-regular">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center mt-5"><img src="assets/images/logo.png" width="300px"></div>
            <div class="col-sm-5">
                <form action="" class="text-center mt-3 p-3 rounded-3 shadow">
                    <h5>สมัครสมาชิก</h5>
                    <div class="row g-2">
                        <div class="col-sm">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" id="idcard" name="idcard" placeholder="เลขบัตรประชาชน">
                                <label for="floatingInput">เลขบัตรประชาชน</label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" id="empcode" name="empcode" placeholder="รหัสพนักงาน">
                                <label for="floatingInput">รหัสพนักงาน</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="รหัสผ่าน">
                        <label for="floatingInput">รหัสผ่าน</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-sm" id="cfpassword"  placeholder="ยืนยันรหัสผ่าน">
                        <label for="floatingInput">ยืนยันรหัสผ่าน</label>
                    </div>
                    <button type="submit" class="btn  btn-primary w-100">สมัครสมาชิก</button>
                    <hr>
                    <a href="index.php" class="text-decoration-none"><b>เข้าสู่ระบบ</b></a>
                </form>
            </div>
            </div>
        </div>
</body>
</html>