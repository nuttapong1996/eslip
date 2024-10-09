<?php
session_start();
if(isset($_SESSION['empcode']) && isset($_FILES['emppic'])){
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'];
    $image = $_FILES['emppic'];

        // ตรวจสอบการอัพโหลดไฟล์ภาพ
        if ($image['error'] === UPLOAD_ERR_OK && strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)) === 'jpg'){ 
            $uploadDir = '../uploads/emp_pic/';
            $imageName = $empcode . '.jpg'; // ใช้รหัสพนักงานเป็นชื่อไฟล์
            $uploadPath = $uploadDir . $imageName;
            
            // ย้ายไฟล์ไปยังตำแหน่งชั่วคราวก่อนครอป
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {

                // เริ่มการครอปรูปภาพ
                $srcImage = imagecreatefromjpeg($uploadPath);

                // อ่านข้อมูล EXIF เพื่อตรวจสอบการหมุนของกล้อง
                if (function_exists('exif_read_data')) {
                    $exif = exif_read_data($uploadPath);
                    if (isset($exif['Orientation'])) {
                        $orientation = $exif['Orientation'];

                        // หมุนรูปภาพตามข้อมูล EXIF
                        switch ($orientation) {
                            case 3:
                                $srcImage = imagerotate($srcImage, 180, 0);
                                break;
                            case 6:
                                $srcImage = imagerotate($srcImage, -90, 0);
                                break;
                            case 8:
                                $srcImage = imagerotate($srcImage, 90, 0);
                                break;
                        }
                    }
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
                imagecopyresampled($dstImage, $srcImage, 0, 0, $cropX, $cropY, 500, 500, $cropSize, $cropSize);

                // บันทึกภาพที่ครอปแล้วทับไฟล์เดิม
                imagejpeg($dstImage, $uploadPath ,90);

                // ทำความสะอาดหน่วยความจำ
                imagedestroy($srcImage);
                imagedestroy($dstImage);

                    // อัพเดตฐานข้อมูลด้วยเส้นทางไฟล์ของรูปภาพ
                    $img_sql = "UPDATE tbl_regis SET emp_pic = :profile_image WHERE emp_code  = :empcode";
                    $img_stmt = $conn->prepare($img_sql);
                    
                    $img_stmt->bindParam(':profile_image', $imageName);
                    $img_stmt->bindParam(':empcode', $empcode);

                    if ($img_stmt->execute()) {
                        header('location: ../user?manage=user_detail&upload_success');
                    } else {
                        header('location: ../user?manage=user_detail&upload_fail');
                    }
                } else {
                    echo "เกิดข้อผิดพลาดในการย้ายไฟล์";
                }
        } else {
            header('location: ../user?manage=user_detail&upload_fail');
        }
}else{
    header('location: ../user?manage=user_detail');
}

?>