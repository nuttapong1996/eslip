$(document).ready(function(){
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
                    } else {
                        $('#oldpassword').removeClass('is-valid').addClass('is-invalid');
                        $('#oldpassmessage').text('รหัสผ่านไม่ถูกต้อง').show();
                        $('#oldpassmessage').removeClass('valid-feedback').addClass('invalid-feedback');                      
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#oldpassword').removeClass('is-valid is-invalid');
            $('#oldpassmessage').text('').hide();
        }
    });

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