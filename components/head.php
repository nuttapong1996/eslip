<!-- Js Library -->
<script src="./js/jquery-3.7.1.min.js"></script> 
<script src="./js/bootstrap.bundle.min.js"></script> 
<script src="./js/popper.min.js"></script> 
<script src="./js/simple-datatables.min.js"></script>
<script src="./js/sweetalert2@11.js"></script>
<script src="./js/fontawezome-6.3.0.js"></script>

<!-- Ajax Script -->
<script src="./js/scripts.js"></script>
<script src="./js/period_select.js"></script>
<script src="./js/check_emp.js"></script>


<link rel="manifest" href="./manifest.json">


<!-- CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/style.css">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/fonts.css">

<!-- favicon -->
<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">

<?php 

// ตั้ง session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // ถ้านานเกิน 30 นาที ล้าง session
    session_unset();     
    session_destroy();  
}





//  <h1 class='mt-4'>$title</h1>
// function breadcrumb($title){
//            echo 
//             "<nav class='mt-4' aria-label='breadcrumb'>
//                 <ol class='breadcrumb mb-4'>
//                     <li class='breadcrumb-item '><a class='text-decoration-none' href='home.php'>หน้าหลัก</a></li> 
//                     <li class='breadcrumb-item active'>$title</li>
//                 </ol>
//             </nav>";
//     }
 ?>
