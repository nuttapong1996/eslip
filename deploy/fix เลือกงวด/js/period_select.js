$(document).ready(function() {
    // เมื่อมีการเปลี่ยนแปลงการเลือกปี
    $('#yearSelect').change(function() {
        var selectedYear = $(this).val();

        if (selectedYear !== "") {
            $.ajax({
                url: './backend/getSalaryPeriods.php', // ไฟล์ PHP ที่ใช้ดึงข้อมูลจากฐานข้อมูล
                method: 'POST',
                data: { year: selectedYear },
                success: function(response) {
                    // ล้างข้อมูลใน select ก่อน
                    $('#salaryPeriods1').empty();
                    $('#salaryPeriods1').append('<option value="">เลือกงวด</option>');

                    $('#salaryPeriods2').empty();
                    $('#salaryPeriods2').append('<option value="">เลือกงวด</option>');

                    // แปลงข้อมูล response เป็น JSON และวนลูปเพิ่มข้อมูลใน select
                    var data = JSON.parse(response);
                    $.each(data, function(index, period) {
                        $('#salaryPeriods1').append('<option value="' + period.period_payslip + '">' + period.period_payslip + '</option>');
                        $('#salaryPeriods2').append('<option value="' + period.period_payslip + '">' + period.period_payslip + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('เกิดข้อผิดพลาด: ' + error);
                }
            });
        } else {
            // ถ้าไม่ได้เลือกปี ให้ล้าง select
            $('#salaryPeriods').empty();
            $('#salaryPeriods').append('<option value="">--กรุณาเลือกปีเพื่อดูจำนวนงวดเงินเดือน--</option>');
        }
    });
});
