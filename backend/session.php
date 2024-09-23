<?php
session_start();

// กำหนดเวลาหมดอายุของ session (ในวินาที)
$session_lifetime = 1800; // 30 นาที
// $session_lifetime = 300; // 5 นาที
// $session_lifetime = 10; // 5 นาที

// ตรวจสอบว่า session ยังมีอยู่หรือไม่
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // ถ้าผ่านไปนานกว่าที่กำหนดให้หมดอายุ
    if (time() - $_SESSION['LAST_ACTIVITY'] > $session_lifetime) {
        session_unset();     // ล้างค่า session
        session_destroy();   // ทำลาย session
        header("Location: logout"); // เปลี่ยนเส้นทางไปยังหน้า logout
        exit();
    }
}
// อัปเดตเวลาใช้งานล่าสุด
$_SESSION['LAST_ACTIVITY'] = time();
?>

<script>
    // กำหนดเวลา session ในหน่วยวินาที
    const sessionLifetime = <?php echo $session_lifetime; ?>;
    let timeRemaining = sessionLifetime;

        // ฟังก์ชันเพื่อต่อเวลาหรืออัปเดตเวลาที่เหลือ
        function updateSession(event) {
            fetch('./backend/refresh_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        timeRemaining = sessionLifetime; // รีเซ็ตเวลาที่เหลือ (ต่อเวลาหากมีการใช้งานอยู่)
                    }
                });
        }

        // ฟังก์ชันเพื่อตรวจสอบเวลาที่เหลือ
        function countdown() {
            if (timeRemaining <= 0) {
                // alert('Session ของคุณหมดอายุแล้ว');
                window.location.href = 'logout'; // เปลี่ยนเส้นทางไปยังหน้า logout
            } else {
                timeRemaining--;
                document.getElementById('session-time').innerText = 'เวลาที่เหลือ: ' + Math.floor(timeRemaining / 60) + ' นาที ' + (timeRemaining % 60) + ' วินาที';
                // console.log('Event type:', event.type);
            }
        }

        // เรียกใช้งาน countdown ทุก ๆ วินาที
        setInterval(countdown, 1000);

        // รีเฟรช session ทุก ๆ 5 นาที
        setInterval(updateSession, 300000);


        // เพิ่ม event listener สำหรับการคลิก
        document.addEventListener('click', updateSession);

        // เพิ่ม event listener สำหรับการเลื่อนเมาส์
        document.addEventListener('mousemove', updateSession);

        // เพิ่ม event listener สำหรับการพิมพ์แป้นพิมพ์
        document.addEventListener('keydown', updateSession);

</script>
