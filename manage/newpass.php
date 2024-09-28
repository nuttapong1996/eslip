<?php 
if(isset($_SESSION['empcode'])){
    $title = "เปลี่ยนรหัสผ่าน";
?>
<title><?php echo $title ?></title>
<main>
    <div class="container px-4">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-7">
                <div class="card p-3 rounded-0 border-0 shadow-lg ">
                    <h4 class="text-center fw-normal">ตั้งรหัสผ่านใหม่</h4>
                    <div class="card-body">
                        <form method="POST"  class="needs-validation mb-0" novalidate  action="backend/change_pass_proc.php" autocomplete=off>
                            <div class="row mb-3">
                                <div class="col-md-12">                                  
                                    <label for="password">รหัสผ่านปัจจุบัน</label>
                                    <div class="input-group">
                                        <input class="form-control rounded-0 rounded-start" name="oldpassword" id="oldpassword" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight','Enter'].includes(event.key)"  placeholder="รหัสผ่าน" required autocomplete="off" maxlength="8" />
                                        <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="oldpasspeek">
                                            <i class="fa fa-eye-slash" id="oldpasstogglebtn"></i>
                                        </button>                                                    
                                        <div id="oldpassmessage"></div>
                                    </div>
                                </div>                                        
                            </div>
                            <div class="row mb-3" id="newpass">
                                <div class="col-md-12">                                  
                                    <label for="password">รหัสผ่านใหม่</label>
                                    <div class="input-group">
                                        <input class="form-control rounded-0 rounded-start" name="newpassword" id="newpassword" type="password"  onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight','Enter'].includes(event.key)"  placeholder="รหัสผ่าน" required autocomplete="off" maxlength="8" />
                                        <button type="button" class="btn btn-outline-secondary rounded-0 rounded-end" id="passpeek1">
                                            <i class="fa fa-eye-slash" id="newpasswordtogglebtn"></i>
                                        </button>                                                    
                                        <div id="message"></div>
                                    </div>
                                </div>                                        
                            </div>
                            <div class="row mb-3" id="newpasscf">
                                <div class="col-md-12">                                          
                                    <label for="cfpassword">ยืนยันรหัสผ่านใหม่</label>
                                        <div class="input-group">
                                        <input class="form-control rounded-0 rounded-start" name="cfnewpassword" id="cfnewpassword" type="password" onkeydown="return /[a-zA-Z0-9_!@#$%^*-+]/i.test(event.key) || ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight','Enter'].includes(event.key)"  placeholder="ยืนยันรหัสผ่าน" required autocomplete="off" maxlength="8" />
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
        </div>
    </div>
</main>
         
<?php 
}else{
    header('location:../login');
}
?>