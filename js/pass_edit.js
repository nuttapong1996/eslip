$(document).ready(function(){
    $('#newpass').hide();
    $('#newpasscf').hide();    
    $('#submit').prop('disabled', true); 

//ตรวจสอบรหัสผ่านเก่า
    $('#oldpassword').on('input', function() {
        var oldPass = $(this).val();
        
        // ตรวจสอบว่า input ไม่ว่างเปล่า
        if (oldPass !== '') {
            $.ajax({
                url: './backend/check_oldpass.php',
                method: 'POST',
                data: { oldpassword: oldPass },
                success: function(response) {
                    if (response === 'true') {
                        $('#oldpassword').removeClass('is-invalid').addClass('is-valid');
                        $('#oldpassmessage').text('รหัสผ่านถูกต้อง').show();
                        $('#oldpassmessage').removeClass('invalid-feedback').addClass('valid-feedback');
                        $('#newpass').show();
                    } else {
                        $('#oldpassword').removeClass('is-valid').addClass('is-invalid');
                        $('#oldpassmessage').text('รหัสผ่านไม่ถูกต้อง').show();
                        $('#oldpassmessage').removeClass('valid-feedback').addClass('invalid-feedback');
                        $('#newpass').hide();
                        $('#newpasscf').hide();                                       
                        $('#newpassword').val('');
                        $('#cfnewpassword').val('');                                   
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#oldpassword').removeClass('is-valid is-invalid');
            $('#oldpassmessage').text('').hide();
            $('#submit').prop('disabled', true); 
        }
    });
//ตรวจสอบรหัสผ่านเก่าและใหม่
    $('#newpassword').on('change', function() {
        var newPass = $(this).val();
        
        // ตรวจสอบว่า input ไม่ว่างเปล่า
        if (newPass !== '' && newPass.length >=8) {                         
                    if (newPass === $('#oldpassword').val()) {
                        $('#newpassword').removeClass('is-valid').addClass('is-invalid');
                        $('#message').text('รหัสผ่านนี้ถูกตั้งไปแล้ว กรุณาตั้งรหัสผ่านใหม่').show();
                        $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
                        $('#newpasscf').hide();
                    } else {
                        $('#newpassword').removeClass('is-invalid').addClass('is-valid');
                        $('#message').text('รหัสผ่านนี้ใช้ได้').show();
                        $('#message').removeClass('invalid-feedback').addClass('valid-feedback'); 
                        $('#newpasscf').show();                     
                    }
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#newpassword').removeClass('is-valid').addClass('is-invalid');
            $('#message').text('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
            $('#cfpassword').val('');
            $('#submit').prop('disabled', true);
            $('#newpasscf').hide()
        }
    });
//ตรวจสอบจำนวนอักษร
    $('#newpassword').on('input',function(){
        if($('#newpassword').val().length < 8){
            $('#newpassword').removeClass('is-valid').addClass('is-invalid');
            $('#message').text('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
            $('#cfpassword').val('');
            $('#newpasscf').hide();
        }else{
            $('#newpassword').removeClass('is-invalid').addClass('is-valid');
            $('#message').text('').show();
            $('#message').removeClass('invalid-feedback').addClass('valid-feedback'); 
        }
    });
    $('#cfnewpassword').on('input',function(){
        if($('#cfnewpassword').val().length < 8){
            $('#cfnewpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').text('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร').show();
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#cfnewpassword').removeClass('is-invalid').addClass('is-valid');
            $('#messagecf').text('').show();
            $('#messagecf').removeClass('invalid-feedback').addClass('valid-feedback'); 
        }
    });
//ตรวจสอบการยืนยันรหัสผ่าน
    $('#cfnewpassword').on('change',function(){
        if($('#cfnewpassword').val() === $('#newpassword').val()){
            $('#cfnewpassword').removeClass('is-invalid').addClass('is-valid');
            $('#messagecf').removeClass('invalid-feedback').addClass('valid-feedback');
            $('#messagecf').text('รหัสผ่านตรงกัน')
            $('#submit').prop('disabled', false);
            // หากไม่ตรงให้แจ้งเตือนและปิดการใช้งานปุ่ม submit
        }else if($('#newpassword').val() !== $('#cfnewpassword').val()){
            $('#cfnewpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
            $('#messagecf').text('รหัสผ่านไม่ตรงกัน');
            $('#submit').prop('disabled', true);
        }
    });    
// ปุ่มแสดง password
    $('#oldpasspeek').on('click', function() {
        if ($('#oldpassword').attr('type') === 'password') {
            $('#oldpassword').attr('type', 'text');
            $('#oldpasstogglebtn').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $('#oldpassword').attr('type', 'password');
            $('#oldpasstogglebtn').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
    $('#passpeek1').on('click', function() {
        if ($('#newpassword').attr('type') === 'password') {
            $('#newpassword').attr('type', 'text');
            $('#newpasswordtogglebtn').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $('#newpassword').attr('type', 'password');
            $('#newpasswordtogglebtn').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
    $('#passpeek2').on('click', function() {
        if ($('#cfnewpassword').attr('type') === 'password') {
            $('#cfnewpassword').attr('type', 'text');
            $('#togglebtn2').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $('#cfnewpassword').attr('type', 'password');
            $('#togglebtn2').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
});