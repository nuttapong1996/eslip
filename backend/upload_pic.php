<?php
session_start();
if(isset($_SESSION['empcode']) && isset($_FILES['emppic'])){
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = trim($_SESSION['empcode']);
    $image = $_FILES['emppic'];

    // ตรวจสอบการอัพโหลดไฟล์ภาพ
    if ($image['error'] === UPLOAD_ERR_OK) {
        // ตรวจสอบประเภทไฟล์ผ่าน MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $image['tmp_name']);
        finfo_close($finfo);

        $allowed_types = ['image/jpeg', 'image/jpg'];
        if (in_array(strtolower($mime), $allowed_types)) {
            $uploadDir = '../uploads/emp_pic/';
            if (!file_exists($uploadDir)) {
                if(!mkdir($uploadDir, 0777, true)){
                    die("ไม่สามารถสร้างโฟลเดอร์อัพโหลดได้");
                }
            }

            $imageName = $empcode . '.jpg'; // ใช้รหัสพนักงานเป็นชื่อไฟล์
            $uploadPath = $uploadDir . $imageName;

            // ย้ายไฟล์ไปยังตำแหน่งที่กำหนด
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {

                // อ่านข้อมูล EXIF เพื่อตรวจสอบการหมุนของกล้อง
                if (function_exists('exif_read_data')) {
                    $exif = @exif_read_data($uploadPath);
                    if ($exif && isset($exif['Orientation'])) {
                        $orientation = $exif['Orientation'];

                        // หมุนรูปภาพตามข้อมูล EXIF
                        switch ($orientation) {
                            case 3:
                                $srcImage = imagerotate(imagecreatefromjpeg($uploadPath), 180, 0);
                                break;
                            case 6:
                                $srcImage = imagerotate(imagecreatefromjpeg($uploadPath), -90, 0);
                                break;
                            case 8:
                                $srcImage = imagerotate(imagecreatefromjpeg($uploadPath), 90, 0);
                                break;
                            default:
                                $srcImage = imagecreatefromjpeg($uploadPath);
                                break;
                        }

                        // บันทึกภาพที่ถูกปรับทิศทางแล้ว
                        imagejpeg($srcImage, $uploadPath, 90);
                        imagedestroy($srcImage);
                    }
                }

                // สร้างภาพจากไฟล์ที่อัพโหลด
                $srcImage = imagecreatefromjpeg($uploadPath);
                if (!$srcImage) {
                    // หากไม่สามารถสร้างภาพได้
                    header('location: ../user?manage=user_detail&upload_fail');
                    exit();
                }

                // ขนาดต้นฉบับของรูป
                $originalWidth = imagesx($srcImage);
                $originalHeight = imagesy($srcImage);

                // กำหนดขนาดครอป 500x500 พิกเซล
                $cropSize = min($originalWidth, $originalHeight);
                $cropX = ($originalWidth - $cropSize) / 2;
                $cropY = ($originalHeight - $cropSize) / 2;

                // สร้างภาพใหม่ขนาด 500x500 พิกเซล
                $dstImage = imagecreatetruecolor(500, 500);

                // รักษาคุณภาพสี
                imagecopyresampled($dstImage, $srcImage, 0, 0, $cropX, $cropY, 500, 500, $cropSize, $cropSize);

                // บันทึกภาพที่ครอปแล้วทับไฟล์เดิม
                if(imagejpeg($dstImage, $uploadPath , 90)){
                    // ทำความสะอาดหน่วยความจำ
                    imagedestroy($srcImage);
                    imagedestroy($dstImage);

                    // อัพเดตฐานข้อมูลด้วยเส้นทางไฟล์ของรูปภาพ
                    $img_sql = "UPDATE tbl_regis SET emp_pic = :profile_image WHERE emp_code = :empcode";
                    $img_stmt = $conn->prepare($img_sql);
                    
                    $img_stmt->bindParam(':profile_image', $imageName);
                    $img_stmt->bindParam(':empcode', $empcode);

                    if ($img_stmt->execute()) {
                        header('location: ../user?manage=user_detail&upload_success');
                        exit();
                    } else {
                        // ลบไฟล์ที่อัพโหลดหากอัพเดตฐานข้อมูลล้มเหลว
                        unlink($uploadPath);
                        header('location: ../user?manage=user_detail&upload_fail');
                        exit();
                    }
                } else {
                    // ลบไฟล์ที่อัพโหลดหากการครอปรูปภาพล้มเหลว
                    unlink($uploadPath);
                    header('location: ../user?manage=user_detail&upload_fail');
                    exit();
                }

            } else {
                echo "เกิดข้อผิดพลาดในการย้ายไฟล์";
            }
        } else {
            echo "ประเภทไฟล์ไม่ถูกต้อง! กรุณาอัพโหลดเป็น JPEG เท่านั้น.";
        }
    } else {
        echo "เกิดข้อผิดพลาดในการอัพโหลดไฟล์!";
    }
} else{
    header('location: ../user?manage=user_detail');
    exit();
}
?>
