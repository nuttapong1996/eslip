<?php
session_start();
$_SESSION['LAST_ACTIVITY'] = time(); // อัปเดตเวลาใช้งานล่าสุด
echo json_encode(['success' => true]);
?>
