# ชุดแก้ไขการเลือกงวด E-Slip

อัปโหลดไฟล์ในชุดนี้ไปยัง document root ของระบบ E-Slip แล้ววางทับไฟล์เดิมตาม path ด้านล่าง

| ไฟล์ในชุดอัปโหลด | Path ปลายทางบน server |
| --- | --- |
| `backend/getSalaryPeriods.php` | `backend/getSalaryPeriods.php` |
| `components/period_select.php` | `components/period_select.php` |
| `js/period_select.js` | `js/period_select.js` |

หลังอัปโหลด ให้ทำ hard refresh ที่หน้า `/eslip` แล้วเลือกปีและตรวจว่ารายการงวดแสดงขึ้นครบถ้วน
