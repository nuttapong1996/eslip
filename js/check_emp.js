$(document).ready(function(){
    // ตรวจสอบรหัสพนักงานทุกครั้งที่มีการพิมพ์
    $('#empcode').on('input', function() {
        var employeeId = $(this).val();
        
        // ตรวจสอบว่า input ไม่ว่างเปล่า
        if (employeeId !== '') {
            $.ajax({
                url: './backend/check_employee.php',
                method: 'POST',
                data: { empcode: employeeId },
                success: function(response) {
                    if (response === 'active') {
                        $('#empcode').removeClass('is-invalid').addClass('is-valid');
                        $('#msg1').text('พบรหัสพนักงานในระบบ').show();
                        $('#msg1').removeClass('invalid-feedback').addClass('valid-feedback');
                    } else {
                        $('#empcode').removeClass('is-valid').addClass('is-invalid');
                        $('#msg1').text('ไม่พบรหัสพนักงานในระบบ').show();
                        $('#msg1').removeClass('valid-feedback').addClass('invalid-feedback');
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#empcode').removeClass('is-valid is-invalid');
            $('#msg1').text('').hide();
        }
    });

    // เช็ค ค่า input ที่รับมา หากว่างให้แจ้งเตือน
    $('#empcode').on('input', function() {
        if( $('#empcode').val() === ""){
            $('#empcode').removeClass('is-valid').addClass('is-invalid');
            $('#msg1').text('กรุณากรอกรหัสพนักงาน').show();
            $('#msg1').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#empcode').removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#idencode').on('input', function() {
        if( $('#idencode').val() === ""){
            $('#idencode').removeClass('is-valid').addClass('is-invalid');
            $('#msg2').text('กรุณากรอกหมายเลขบัตรประชาชน').show();
            $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#idencode').removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#birhtday').on('input', function() {
        if( $('#birhtday').val() === ""){
            $('#birhtday').removeClass('is-valid').addClass('is-invalid');
            $('#msg3').text('กรุณาเลือกวันเดือนปีที่เกิด').show();
            $('#msg3').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#birhtday').removeClass('is-invalid').addClass('is-valid');
        }
    });
    
    $('#password').on('input', function() {
        if( $('#password').val() === ""){
            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('#message').text('กรุณากรอกรหัสผ่าน').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#password').removeClass('is-invalid').addClass('is-valid');
            $('#message').removeClass('invalid-feedback').addClass('valid-feedback');
        }
    });

    $('#cfpassword').on('input', function() {
        if( $('#cfpassword').val() === ""){
            $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').text('กรุณากรอกยืนยันรหัสผ่าน').show();
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
        }else{
            $('#cfpassword').removeClass('is-invalid').addClass('is-valid');
            $('#messagecf').removeClass('invalid-feedback').addClass('valid-feedback');
        }
    });

    $('#regisForm').on('submit', function(event) {

        if( $('#empcode').val() === ""){
            $('#empcode').removeClass('is-valid').addClass('is-invalid');
            $('#msg1').text('กรุณากรอกรหัสพนักงาน').show();
            $('#msg1').removeClass('valid-feedback').addClass('invalid-feedback');
        }
        if( $('#idencode').val() === ""){
            $('#idencode').removeClass('is-valid').addClass('is-invalid');
            $('#msg2').text('กรุณากรอกหมายเลขบัตรประชาชน').show();
            $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
        }
        if( $('#birhtday').val() === ""){
            $('#birhtday').removeClass('is-valid').addClass('is-invalid');
            $('#msg3').text('กรุณาเลือกวันเดือนปีที่เกิด').show();
            $('#msg3').removeClass('valid-feedback').addClass('invalid-feedback');
        }
        if( $('#password').val() === ""){
            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('#message').text('กรุณากรอกรหัสผ่าน').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
        }
        if( $('#cfpassword').val() === ""){
            $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').text('กรุณากรอกยืนยันรหัสผ่าน').show();
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
        }


        if ($('#empcode').hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation();
        }
        if ($('#idencode').hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation();
        }
        if ($('#birhtday').hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation();
        }
        if ($('#password').hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation();
        }
        if ($('#cfpassword').hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation();
        }
    });


});



function checkPasswordMatch() {
    var password =document.getElementById("password").value;
    var confirmPassword = document.getElementById("cfpassword").value;
    var submit = document.getElementById("submit");

    if (password === confirmPassword) {
        document.getElementById("password").className = "form-control is-valid";
        document.getElementById("cfpassword").className = "form-control is-valid";
        document.getElementById("message").innerHTML = "รหัสผ่านตรงกัน";
        document.getElementById("messagecf").innerHTML = "รหัสผ่านตรงกัน";
        submit.disabled = false;
    }else{
        document.getElementById("password").className = "form-control is-invalid";
        document.getElementById("cfpassword").className = "form-control is-invalid";
        document.getElementById("message").innerHTML = "รหัสผ่านไม่ตรงกัน";
        document.getElementById("message").className = "invalid-feedback";
        document.getElementById("messagecf").innerHTML = "รหัสผ่านไม่ตรงกัน";
        document.getElementById("messagecf").className = "invalid-feedback";
        submit.disabled = true;
    }

    if (password == "" || confirmPassword == "") {
        document.getElementById("password").className = "form-control is-invalid";
        document.getElementById("cfpassword").className = "form-control is-invalid";
        submit.disabled = true;
    }
}



