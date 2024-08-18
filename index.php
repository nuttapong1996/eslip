<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="manifest.json">
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
                    <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                    <hr>
                    <a href="register.php" class="text-decoration-none"><b>สมัครสมาชิก</b"></a>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning" id="install-button" style="display: none;">Install App</button>
                    </div>
                </form>                
            </div>
            <br>
            <div class="text-center mb-3">
                <small class="text-muted ibm-plex-sans-thai-light">
                    Developed by IT Department (Maemoh)<br>
                    &copy; <?php echo date('Y'); ?> Sahakol Equipment PCL.
                </small>
            </div>
           
        </div>
    </div>
</body>
</html>

<script>
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
    // ป้องกันการแสดง pop-up การติดตั้งอัตโนมัติ
    e.preventDefault();
    // เก็บอีเวนต์เพื่อใช้ในการเรียก pop-up ติดตั้ง
    deferredPrompt = e;
    // แสดงปุ่มติดตั้ง
    const installButton = document.getElementById('install-button');
    installButton.style.display = 'block';

    installButton.addEventListener('click', () => {
        // ซ่อนปุ่มติดตั้งหลังจากผู้ใช้กดปุ่ม
        installButton.style.display = 'none';
        // แสดง pop-up ติดตั้ง
        deferredPrompt.prompt();
        // ตรวจสอบการตอบกลับของผู้ใช้
        deferredPrompt.userChoice.then((choiceResult) => {
        if (choiceResult.outcome === 'accepted') {
            console.log('User accepted the installation');
        } else {
            console.log('User dismissed the installation');
        }
        deferredPrompt = null;
        });
    });
    });
</script>