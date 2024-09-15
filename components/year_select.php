<?php
    require_once('./includes/connect_db.php');

    $yearlist= "SELECT year_payslip FROM tbl_payslip GROUP BY year_payslip ORDER BY year_payslip DESC";
    $year_stmt = $conn->prepare($yearlist);
    $year_stmt->execute();
    $year_row = $year_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="input-group mb-3">
    <span class="input-group-text">ปี : </span>
    <select class="form-select form-select-sm" name="year" id="yearSelect" required>
    <option value="">เลือกปี</option>
        <?php foreach($year_row as $year){ ?>
            <option value="<?php echo $year['year_payslip']; ?>"><?php echo $year['year_payslip']; ?></option>
        <?php }?>
    </select>
</div>

<div class="input-group mb-3">
<span class="input-group-text">งวดที่ : </span>
    <select class="form-select form-select-sm" name="period1" id="salaryPeriods1" required>
        <option value="">เลือกงวด</option>
    </select>
</div>

<div class="input-group mb-3">
<span class="input-group-text">งวดที่ : </span>
    <select class="form-select form-select-sm" name="period2" id="salaryPeriods2" required>
        <option value="">เลือกงวด</option>
    </select>
</div>

<script>
        $(document).ready(function() {
            // เมื่อมีการเปลี่ยนแปลงการเลือกปี
            $('#yearSelect').change(function() {
                var selectedYear = $(this).val();

                if (selectedYear !== "") {
                    $.ajax({
                        url: './components/getSalaryPeriods.php', // ไฟล์ PHP ที่ใช้ดึงข้อมูลจากฐานข้อมูล
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
    </script>