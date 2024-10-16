$(document).ready(function() {

    // รายได้สุทธิปัจจุบัน
    $('#net_income').text("#####.##");
    var net_toggle = 0;
    var net_income = $('#net_income_value').val();

    $('#net_income_btn').on('click' ,function(){
        if(net_toggle == 0){
            $('#net_income').text(net_income);
            $('#net_income_icon').removeClass('fa-eye').addClass('fa-eye-slash');
            $('#net_income_icon_text').text('ซ่อนยอดเงิน');
            net_toggle = 1;
        }else if(net_toggle == 1){
            $('#net_income').text("#####.##");
            $('#net_income_icon').removeClass('fa-eye-slash').addClass('fa-eye');
            $('#net_income_icon_text').text('แสดงยอดเงิน');
            net_toggle = 0;
        }
    });
});