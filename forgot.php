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
                <div class="row justify-content-center mt-3">
                    <div class="col-sm-8">
                        <img src="assets/images/logo.png" class="d-block mx-auto mb-3" width="300px">
                        <div class="card p-3 rounded-0 border-0 shadow-lg ">
                            <h4 class="text-center fw-normal">ลืมรหัสผ่าน</h4>
                            <small class="text-muted text-center">กรุณากรอกข้อมูล เพื่อแก้ไขรหัสผ่าน</small>
                            <div class="card-body">
                                <form method="POST" action="components/forgot_proc.php" autocomplete=off>
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control form-control-sm" name="empcode" id="empcode"  onkeydown="return /[a-zA-Z0-9]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)" placeholder="กรุณากรอกรหัสพนักงาน" required>
                                                <label for="empcode">รหัสพนักงาน</label>
                                                <div id="msg1" ></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control " name="idencode" id="idencode" onkeydown="return /[0-9]/i.test(event.key)|| ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(event.key)"   placeholder="เลขบัตรประชาชน" required autocomplete="off" />
                                                <label for="idencode">เลขบัตรประชาชน</label>
                                                <div id="msg2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid ">
                                        <button class="btn btn-sm btn-primary" type="submit">ตกลง</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>