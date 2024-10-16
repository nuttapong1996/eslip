<?php
session_start();
if(isset($_SESSION['empcode']) && isset($_FILES['emppic'])){
    require_once __DIR__ . '/../includes/connect_db.php';

    $empcode = $_SESSION['empcode'];
    $image = $_FILES['emppic'];

    // Function to correct image orientation based on EXIF data
    function correctImageOrientation($imagePath) {
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($imagePath);

            if (!empty($exif['Orientation'])) {
                $imageResource = imagecreatefromjpeg($imagePath); // Assuming it's a JPEG image

                switch ($exif['Orientation']) {
                    case 3:
                        $imageResource = imagerotate($imageResource, 180, 0);
                        break;

                    case 6:
                        $imageResource = imagerotate($imageResource, -90, 0);
                        break;

                    case 8:
                        $imageResource = imagerotate($imageResource, 90, 0);
                        break;
                }

                // Save the corrected image back
                imagejpeg($imageResource, $imagePath, 90); // 90 is the compression quality
                imagedestroy($imageResource);
            }
        }
    }
    // Function to compress the uploaded image
    // function compressImage($imagePath, $imageType) {
    function compressImage($imagePath) {
        $quality = 50; // Compression quality for JPEG
        $compression = 9; // PNG compression level (0 = no compression, 9 = max compression)
        $compressedImage = $imagePath;

        $imageResource = imagecreatefromjpeg($imagePath);
        imagejpeg($imageResource, $compressedImage, $quality);

        // if ($imageType == IMAGETYPE_JPEG) {
        //     $imageResource = imagecreatefromjpeg($imagePath);
        //     imagejpeg($imageResource, $compressedImage, $quality);
        // } elseif ($imageType == IMAGETYPE_PNG) {
        //     $imageResource = imagecreatefrompng($imagePath);
        //     imagepng($imageResource, $compressedImage, $compression);
        // }

        // Free memory
        imagedestroy($imageResource);
    }

        

        // ตรวจสอบการอัพโหลดไฟล์ภาพ
        if ($image['error'] === UPLOAD_ERR_OK && strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)) === 'jpg'){ 
            $uploadDir = '../uploads/emp_pic/';
            $imageName = $empcode . '.jpg'; // ใช้รหัสพนักงานเป็นชื่อไฟล์
            $uploadPath = $uploadDir . $imageName;

                      
            
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {     
                
                correctImageOrientation($uploadPath);

                compressImage($uploadPath); 

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