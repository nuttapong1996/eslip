$(document).ready(function() {
    // เมื่อมีการเปลี่ยนแปลงการเลือกปี
    $('#yearSelect').change(function() {
        var selectedYear = $(this).val();

        if (selectedYear !== "") {
            $.ajax({
                url: './backend/getSalaryPeriods.php', // ไฟล์ PHP ที่ใช้ดึงข้อมูลจากฐานข้อมูล
                method: 'POST',
                data: { year: selectedYear },
                dataType: 'json',
                success: function(data) {
                    // ล้างข้อมูลใน select ก่อน
                    $('#salaryPeriods1').empty();
                    $('#salaryPeriods1').append('<option value="">เลือกงวด</option>');

                    $('#salaryPeriods2').empty();
                    $('#salaryPeriods2').append('<option value="">เลือกงวด</option>');

                    $.each(data, function(index, period) {
                        $('#salaryPeriods1').append('<option value="' + period.period_payslip + '">' + period.period_payslip + '</option>');
                        $('#salaryPeriods2').append('<option value="' + period.period_payslip + '">' + period.period_payslip + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('เกิดข้อผิดพลาด: ' + error);
                    $('#salaryPeriods1, #salaryPeriods2').empty().append('<option value="">ไม่สามารถโหลดงวดเงินเดือนได้</option>');
                }
            });
        } else {
            // ถ้าไม่ได้เลือกปี ให้ล้าง select
            $('#salaryPeriods1, #salaryPeriods2').empty().append('<option value="">--กรุณาเลือกปีเพื่อดูจำนวนงวดเงินเดือน--</option>');
        }
    });
});
