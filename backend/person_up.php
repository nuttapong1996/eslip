<?php 
session_start();
 if(isset($_SESSION['empcode']) && isset($_POST['email']) && isset($_FILES['emppic'])){
    require_once __DIR__ . '/../includes/connect_db.php';

    $email = $_POST['email'];
    $empcode = $_SESSION['empcode'];
    $image = $_FILES['emppic'];

    $target_dir = "../uploads/emp_pic/";
    $imageName = $empcode . '.jpg';
    $uploadPath = $target_dir . $imageName;
    // $target_file = $target_dir .basename($_FILES['emppic']['name']);
    $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            $sql = "UPDATE tbl_regis SET email = :email, emp_pic = :emp_pic WHERE emp_code = :empcode";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':emp_pic', $imageName);
            $stmt->bindParam(':empcode', $empcode);
            $stmt->execute();

            // echo "The file ". htmlspecialchars( basename( $_FILES['emppic']['name'])). " has been uploaded.";

            header('location:../user?manage=user_detail&success');
        } else {
            header('location:../user?manage=user_detail&fail');
        }
    }

 }else{
     header('location:../login');
 }

?>