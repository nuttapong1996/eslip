<?php
if(isset($_GET['token'])){
        // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
        require_once __DIR__ . '/includes/connect_db.php';

        $token = $_GET['token'];

        // Query check token
        $token_check = 'SELECT * FROM tbl_regis WHERE reset_token = :token';
        $stmt_token_check = $conn->prepare($token_check);
        $stmt_token_check->bindParam(':token', $token);
        $stmt_token_check->execute();
        $row_token = $stmt_token_check->fetch(PDO::FETCH_ASSOC);

    if($stmt_token_check->rowCount() > 0){
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'components/head.php'; ?>
        <title>ตั้งรหัสผ่านใหม่</title>
    </head>
    <body class="bg-gray ibm-plex-sans-thai-regular">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content ">
                <main class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-sm-6">
                            <img src="assets/images/logo.png" class="d-block mx-auto mb-4" width="300px">
                            <div class="card p-3 rounded-0 border-0 shadow-lg ">
                                <h4 class="text-center fw-normal">ตั้งรหัสผ่านใหม่</h4>                           
                                <div class="card-body">
                                    <form method="POST" id="regisForm" class="needs-validation mb-0" novalidate  action="backend/reset_proc.php" autocomplete=off>
                                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                                        <div class="row mb-3">
                                            <div class="col-md-12">                                  
                                                <label for="password">รหัสผ่านใหม่</label>
                                                <div class="input-group">
                                                    <input class="form-control rounded-0 rounded-start" name="newpassword" id="password" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight','Enter'].includes(event.key)"  placeholder="รหัสผ่าน" required autocomplete="off" maxlength="8" />
                                                    <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek1">
                                                        <i class="fa fa-eye-slash" id="togglebtn1"></i>
                                                    </button>                                                    
                                                    <div id="message"></div>
                                                </div>
                                            </div>                                        
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">                                          
                                                <label for="cfpassword">ยืนยันรหัสผ่านใหม่</label>
                                                    <div class="input-group">
                                                    <input class="form-control rounded-0 rounded-start" name="cfnewpassword" id="cfpassword" type="password" onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight','Enter'].includes(event.key)"  placeholder="ยืนยันรหัสผ่าน" required autocomplete="off" maxlength="8" />
                                                    <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek2">
                                                        <i class="fa fa-eye-slash" id="togglebtn2"></i>
                                                    </button>
                                                    <div id="messagecf"></div>
                                                </div>                                                    
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-sm btn-primary"  id="submit" type="submit">ตกลง</button>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <small class="text-danger text-center" id="countdown"></small>
                                        </div>
                                    </form>
                                
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
    }else{
        header('location: ./forgot?expired');
    }
    //ปิดการเชื่อมต่อฐานข้อมูล
    $conn=null;
}else{
    header('location: ./forgot?error');
}


?>

