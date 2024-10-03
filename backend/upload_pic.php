<?php 
session_start();
    if(isset($_FILES['emppic'])){
        require_once __DIR__ . '/../includes/connect_db.php';

        $empcode = $_SESSION['empcode'];
        $image = $_FILES['emppic'];

        if ($image['error'] === UPLOAD_ERR_OK && strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)) === 'jpg'){
            $uploadDir = '../uploads/emp_pic/';
            $imageName = $empcode . '.jpg'; // ใช้รหัสพนักงานเป็นชื่อไฟล์
            $uploadPath = $uploadDir . $imageName;

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $sql = "UPDATE tbl_regis SET emp_pic = :emp_pic WHERE emp_code = :empcode";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':emp_pic', $imageName);
                $stmt->bindParam(':empcode', $empcode);
                $stmt->execute();
    
                // echo "The file ". htmlspecialchars( basename( $_FILES['emppic']['name'])). " has been uploaded.";
    
                header('location:../user?manage=user_detail&success');
            } else {
                header('location:../user?manage=user_detail&fail');
            }

    }
}

?>