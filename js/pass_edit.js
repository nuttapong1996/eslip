$(document).ready(function(){

    $('#newpass').hide();
    $('#newpasscf').hide();    

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
                        // $('#newpasscf').show();
                    } else {
                        $('#oldpassword').removeClass('is-valid').addClass('is-invalid');
                        $('#oldpassmessage').text('รหัสผ่านไม่ถูกต้อง').show();
                        $('#oldpassmessage').removeClass('valid-feedback').addClass('invalid-feedback');
                        $('#newpass').hide();
                        $('#newpasscf').hide();                                       
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#oldpassword').removeClass('is-valid is-invalid');
            $('#oldpassmessage').text('').hide();
        }
    });

    //ตรวจสอบรหัสผ่านเก่าและใหม่
    $('#password').on('change', function() {
        var newPass = $(this).val();
        
        // ตรวจสอบว่า input ไม่ว่างเปล่า
        if (newPass !== '') {           
                    if (newPass === $('#oldpassword').val()) {
                        $('#password').removeClass('is-valid').addClass('is-invalid');
                        $('#message').text('รหัสผ่านนี้ถูกตั้งไปแล้ว กรุณาตั้งรหัสผ่านใหม่').show();
                        $('#message').removeClass('valid-feedback').addClass('invalid-feedback');  
                        $('#newpasscf').hide();                       
                    } else {
                        $('#password').removeClass('is-invalid').addClass('is-valid');
                        $('#message').text('รหัสผ่านนี้ใช้ได้').show();
                        $('#message').removeClass('invalid-feedback').addClass('valid-feedback'); 
                        $('#newpasscf').show();                     
                    }
                
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#password').removeClass('is-valid is-invalid');
            $('#message').text('').hide();
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


});