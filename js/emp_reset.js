$(document).ready(function(){

    $('#reg_msg').hide();

    $('#emp_re').on('input', function() {
        var employeeId = $(this).val();
        // ตรวจสอบว่า input ไม่ว่างเปล่า
        if (employeeId !== '') {
            $.ajax({
                url: './backend/check_employee_forgot.php',
                method: 'POST',
                data: { empcode: employeeId },
                success: function(response) {
                    if (response === 'active') {
                        $('#emp_re').removeClass('is-invalid').addClass('is-valid');
                        $('#msg1').text('พบรหัสพนักงานในระบบ').show();
                        $('#msg1').removeClass('invalid-feedback').addClass('valid-feedback');
                        $('#iden_re_holder').show();
                        $('#reg_msg').hide();
                        $('#Btn_re').prop('disabled', true);
                        $('#iden_re').focus();
                    } else {
                        $('#iden_re_holder').hide();
                        $('#reg_msg').show();
                        $('#Btn_re').prop('disabled', true);
                        $('#iden_re').val('');
                        $('#emp_re').removeClass('is-valid').addClass('is-invalid');
                        $('#msg1').text('รหัสพนักงานนี้ยังไม่ได้สมัคร กรุณาสมัครสมาชิก').show();
                        $('#msg1').removeClass('valid-feedback').addClass('invalid-feedback');
                        $('#iden_re').removeClass('is-valid').addClass('is-invalid');
                        $('#msg2').text('').show();
                        $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#emp_re').removeClass('is-valid is-invalid');
            $('#msg1').text('').hide();
            $('#iden_re_holder').show();
            $('#reg_msg').hide();
            $('#login_msg').show();
        }
    }); 

     // ตรวจสอบหมายเลขบัตรประชาชนทุกครั้งที่มีการพิมพ์
     $('#iden_re').on('input', function() {
        var idencodeId = $(this).val();
        var employeeId = $('#emp_re').val();

        // ตรวจสอบว่า input ไม่ว่างเปล่า    
        if (idencodeId !== '') {
            $.ajax({
                url: './backend/check_idencode_forgot.php',
                method: 'POST',
                data: { idencode: idencodeId , empcode: employeeId },
                success: function (response) {
                    if (response === 'found'){
                        $('#iden_re').removeClass('is-invalid').addClass('is-valid');
                        $('#msg2').text('พบหมายเลขบัตรประชาชนในระบบ').show();
                        $('#msg2').removeClass('invalid-feedback').addClass('valid-feedback');
                        $('#Btn_re').prop('disabled', false);
                    }else{
                        $('#iden_re').removeClass('is-valid').addClass('is-invalid');
                        $('#msg2').text('ไม่พบหมายเลขบัตรประชาชนในระบบ').show();
                        $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
                    }
                }
            });
        }else{
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก

            $('#iden_re').removeClass('is-valid is-invalid');
            $('#msg2').text('').hide();
        }
    });
});