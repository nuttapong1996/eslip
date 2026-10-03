# Deploy: แก้ไขการเลือกงวดและการเปิด PDF

ให้คัดลอกไฟล์ในโฟลเดอร์นี้ไปทับในโฟลเดอร์รากของเว็บไซต์ โดยคงโครงสร้าง path เดิมดังนี้

| ไฟล์ในชุด deploy | วางทับที่ path บนเว็บไซต์ |
| --- | --- |
| `eslip.php` | `<web-root>/eslip.php` |
| `backend/getSalaryPeriods.php` | `<web-root>/backend/getSalaryPeriods.php` |
| `components/period_select.php` | `<web-root>/components/period_select.php` |
| `js/period_select.js` | `<web-root>/js/period_select.js` |

หลังวางไฟล์แล้ว ให้ล้าง cache ของเบราว์เซอร์หรือ hard refresh ก่อนทดสอบเลือกปีและงวดใหม่อีกครั้ง
