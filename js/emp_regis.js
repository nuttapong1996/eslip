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
                    if (response !== 'none') {
                        var data =JSON.parse(response);
                        $.each(data, function(index, emp) {
                            $('#msg1').text('พบรหัสพนักงานในระบบ : '+emp.name_thai_emp).show();
                        });
                        $('#empcode').removeClass('is-invalid').addClass('is-valid');                        
                        $('#msg1').removeClass('invalid-feedback').addClass('valid-feedback');
                    } else {
                        $('#idencode').val('');
                        $('#empcode').removeClass('is-valid').addClass('is-invalid');
                        $('#msg1').text('ไม่พบรหัสพนักงานในระบบ').show();
                        $('#msg1').removeClass('valid-feedback').addClass('invalid-feedback');
                        $('#idencode').removeClass('is-valid').addClass('is-invalid');
                        $('#msg2').text('').show();
                        $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
                    }
                }
            });
        } else {
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#empcode').removeClass('is-valid is-invalid');
            $('#msg1').text('').hide();
        }
    });


    // ตรวจสอบหมายเลขบัตรประชาชนทุกครั้งที่มีการพิมพ์
    $('#idencode').on('input', function() {
        var idencodeId = $(this).val();
        var employeeId = $('#empcode').val();

        // ตรวจสอบว่า input ไม่ว่างเปล่า    
        if (idencodeId !== '') {
            $.ajax({
                url: './backend/check_idencode.php',
                // url: './backend/check_employee.php',
                method: 'POST',
                data: { idencode: idencodeId , empcode: employeeId },
                success: function (response) {
                    if (response === 'found'){
                        $('#idencode').removeClass('is-invalid').addClass('is-valid');
                        $('#msg2').text('หมายเลขบัตรประชาชนถูกต้องตรงกับรหัสพนักงาน').show();
                        $('#msg2').removeClass('invalid-feedback').addClass('valid-feedback');
                    }else{
                        $('#idencode').removeClass('is-valid').addClass('is-invalid');
                        $('#msg2').text('ไม่พบหมายเลขบัตรประชาชนในระบบ').show();
                        $('#msg2').removeClass('valid-feedback').addClass('invalid-feedback');
                    }
                }
            });
        }else{
            // หาก input ว่าง ให้ลบคลาสการตรวจสอบออก
            $('#idencode').removeClass('is-valid is-invalid');
            $('#msg2').text('').hide();
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
    
      // เช็ค ค่า input เมื่อมีการกด submit
    $('#regisForm').on('submit', function(event) {

        // เช็ค ค่า input ที่รับมา หากว่างให้แจ้งเตือน
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
            $('#message').text('กรุณากรอกรหัสผ่านไม่น้อยหรือเกินว่า 8 ตัวอักษร').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
        }
        if( $('#cfpassword').val() === ""){
            $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').text('กรุณากรอกรหัสผ่านไม่น้อยหรือเกินว่า 8 ตัวอักษร').show();
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
        }


        // เช็คว่าฟอร์มว่ามี error หรือไม่ หากมีก็ไม่อนุญาตให้ submit
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

        // เช็คประเภทอีเมล
        var email = $('#email').val();
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        //ถ้าหากไม่ได้กรอกหรือกรอกเป็น - หรือกรอกไม่ตรงตามรูปแบบ ให้เปลี่ยนเป็น '' (ค่าว่าง) หรือไม่มี
        if (!emailPattern.test(email) || email === "") {
            $('#email').val('');
        } 
    });



     // เช็ก input รหัสผ่านช่องที่ 1 
     $('#password').on('input', function() {
        if($('#password').val() !== ""){
            //เช็กรหัสผ่านช่องที่ 1 ห้ามไม่ให้น้อยและเกินกว่า 8 ตัว
            if($('#password').val().length < 8){
                $('#password').removeClass('is-valid').addClass('is-invalid');
                $('#message').removeClass('valid-feedback').addClass('invalid-feedback order-last');
                $('#message').text('กรุณากรอกรหัสผ่านไม่น้อยกว่า 8 ตัวอักษร');
            // หากรหัสผ่านช่องที่ 1 ตรงกับเงื่อนไขคือไม่น้อยหรือเกินกว่า 8 ตัว ให้แสดงถูกตรง
            }else if($('#password').val().length > 8){
                $('#password').removeClass('is-valid').addClass('is-invalid');
                $('#message').removeClass('valid-feedback').addClass('invalid-feedback');
                $('#message').text('รหัสผ่านเกิน 8 ตัวอักษร');
            }else{
                $('#password').removeClass('is-invalid').addClass('is-valid');
                $('#message').removeClass('valid-feedback').addClass('valid-feedback');
                $('#message').text('');
            }
        }else{
            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('#message').text('กรุณากรอกรหัสผ่าน').show();
            $('#message').removeClass('valid-feedback').addClass('invalid-feedback order-last');
        }

    });
    // เช็ก input รหัสผ่านช่องยืนยัน
    $('#cfpassword').on('input',function(){
        if($('#cfpassword').val() !== ""){
            //เช็กรหัสผ่านช่องที่ 1 ห้ามไม่ให้น้อยและเกินกว่า 8 ตัว
            if($('#cfpassword').val().length < 8){
                $('#cfpassword').removeClass('is-valid').addClass('is-invalid ');
                $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback order-last');
                $('#messagecf').text('กรุณากรอกรหัสผ่านไม่น้อยกว่า 8 ตัวอักษร');
            // หากรหัสผ่านช่องที่ 1 ตรงกับเงื่อนไขคือไม่น้อยหรือเกินกว่า 8 ตัว ให้แสดงถูกตรง
            }else if($('#cfpassword').val().length > 8){
                $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
                $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
                $('#messagecf').text('รหัสผ่านเกิน 8 ตัวอักษร');
            }else{
                $('#cfpassword').removeClass('is-invalid').addClass('is-valid');
                $('#messagecf').removeClass('valid-feedback').addClass('valid-feedback');
                $('#messagecf').text('');
            }
        }else{
            $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').text('กรุณากรอกรหัสผ่าน').show();
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback order-last');
        }
    });


    $('#password').on('change',function(){
        if($('#password').val() !== ""){
            if($('#password').val()!== $('#cfpassword').val()){
                $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
                $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
                $('#messagecf').text('รหัสผ่านไม่ตรงกัน');
                $('#submit').prop('disabled', true);
            }else{
                $('#cfpassword').removeClass('is-invalid').addClass('is-valid');
                $('#messagecf').removeClass('invalid-feedback').addClass('valid-feedback');
                $('#messagecf').text('รหัสผ่านตรงกัน');
                $('#submit').prop('disabled', false);
            }
        }
    });

    // ตรวจสอบรหัสผ่านตรงกันหรือไม่
    $('#cfpassword').on('change',function(){
        if($('#cfpassword').val() === $('#password').val()){
            $('#cfpassword').removeClass('is-invalid').addClass('is-valid');
            $('#messagecf').removeClass('invalid-feedback').addClass('valid-feedback');
            $('#messagecf').text('รหัสผ่านตรงกัน')
            $('#submit').prop('disabled', false);
            // หากไม่ตรงให้แจ้งเตือนและปิดการใช้งานปุ่ม submit
        }else if($('#password').val() !== $('#cfpassword').val()){
            $('#cfpassword').removeClass('is-valid').addClass('is-invalid');
            $('#messagecf').removeClass('valid-feedback').addClass('invalid-feedback');
            $('#messagecf').text('รหัสผ่านไม่ตรงกัน');
            $('#submit').prop('disabled', true);
        }
    });

    // ปุ่มแสดง password หน้า login
    $('#passpeek').on('click',function(){
        if($('#loginpassword').attr('type') == 'password'){
            $('#loginpassword').attr('type', 'text');
            $('#togglebtnlogin').addClass('fa fa-eye').removeClass('fa fa-eye-slash');
        }else{
            $('#loginpassword').attr('type', 'password');
            $('#togglebtnlogin').addClass('fa fa-eye-slash').removeClass('fa fa-eye');
        }
        
    });

    // ปุ่มแสดง password 1
    $('#passpeek1').on('click',function(){
        if($('#password').attr('type') == 'password'){
            $('#password').attr('type', 'text');
            $('#togglebtn1').addClass('fa fa-eye').removeClass('fa fa-eye-slash');
        }else{
            $('#password').attr('type', 'password');
            $('#togglebtn1').addClass('fa fa-eye-slash').removeClass('fa fa-eye');
        }
        
    });
    // ปุ่มแสดง password 1
    $('#passpeek2').on('click',function(){
        if($('#cfpassword').attr('type') == 'password'){
            $('#cfpassword').attr('type', 'text');
            $('#togglebtn2').addClass('fa fa-eye').removeClass('fa fa-eye-slash');
        }else{
            $('#cfpassword').attr('type', 'password');
            $('#togglebtn2').addClass('fa fa-eye-slash').removeClass('fa fa-eye');
        }
        
    });


    // ปิดการใช้งาน copy pase cut 

    $('#empcode').bind('cut copy paste', function(e) {
        e.preventDefault();
    });
    $('#idencode').bind('cut copy paste', function(e) {
        e.preventDefault();
    });
    $('#password').bind('cut copy paste', function(e) {
        e.preventDefault();
    });
    $('#cfpassword').bind('cut copy paste', function(e) {
        e.preventDefault();
    });

    // // When the user clicks on the password field, show the message box
    // $('#password').on('focus', function(){
    //     $('#pwrule').css("display", "block");
    // });
    // // When the user clicks outside of the password field, hide the message box
    // $('#password').on('blur', function(){
    //     $('#pwrule').css("display", "none");
    // });

    // When the user starts to type something inside the password field
    // $('#password').on('keyup',function(){
    //     var lowerCaseLetters = /[a-z]/g;
    //     var upperCaseLetters = /[A-Z]/g;
    //     var numbers = /[0-9]/g;
    //     // เช็กตัวอักษรพิมพ์เล็ก
    //     if($('#password').val().match(lowerCaseLetters)){
    //         $('#sym1').removeClass('fa fa-xmark');
    //         $('#sym1').addClass('fa fa-check');
    //         $('#letter').removeClass('invalid');
    //         $('#letter').addClass('valid');
    //     }else{
    //         $('#sym1').removeClass('fa fa-check');
    //         $('#sym1').addClass('fa fa-xmark');
    //         $('#letter').removeClass('valid');
    //         $('#letter').addClass('invalid');
    //     }
    //     // เช็กตัวอักษรพิมพ์ใหญ่
    //     if($('#password').val().match(upperCaseLetters)){
    //         $('#sym2').removeClass('fa fa-xmark');
    //         $('#sym2').addClass('fa fa-check');
    //         $('#capital').removeClass('invalid');
    //         $('#capital').addClass('valid');
    //     }else{
    //         $('#sym2').removeClass('fa fa-check');
    //         $('#sym2').addClass('fa fa-xmark');
    //         $('#capital').removeClass('valid');
    //         $('#capital').addClass('invalid');
    //     }
    //     // เช็กตัวเลข
    //     if($('#password').val().match(numbers)){
    //         $('#sym3').removeClass('fa fa-xmark');
    //         $('#sym3').addClass('fa fa-check');
    //         $('#number').removeClass('invalid');
    //         $('#number').addClass('valid');
    //     }else{
    //         $('#sym3').removeClass('fa fa-check');
    //         $('#sym3').addClass('fa fa-xmark');
    //         $('#number').removeClass('valid');
    //         $('#number').addClass('invalid');
    //     }
    //     // เช็กตัวเลข
    //     if($('#password').val().length >=8 ){
    //         $('#sym4').removeClass('fa fa-xmark');
    //         $('#sym4').addClass('fa fa-check');
    //         $('#length').removeClass('invalid');
    //         $('#length').addClass('valid');
    //     }else{
    //         $('#sym4').removeClass('fa fa-check');
    //         $('#sym4').addClass('fa fa-xmark');
    //         $('#length').removeClass('valid');
    //         $('#length').addClass('invalid');
    //     }
    // });
});






