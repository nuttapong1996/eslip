<?php 
require_once 'backend/session.php';
if(isset($_SESSION['empcode'])){
$title = "สลิปเงินเดือน (PDF)";
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php include 'components/head.php'; ?>
            <title><?php echo $title ?></title>
        </head>
        <body class="sb-nav-fixed bg-gray ibm-plex-sans-thai-regular">
            <!-- topnav -->
            <?php include 'components/topnav.php'; ?>
            <div id="layoutSidenav">
                <!-- sidenav -->
                <?php include 'components/sidenav.php'; ?>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h3 class="mt-5 mb-4 text-center"><?php echo $title ?></h3>
                            <div class="row justify-content-center">
                                    <div class="col-sm-5">
                                        <div class="card border-0 rounded-0 p-2 mb-4 shadow-sm">
                                                <h5 class="m-0 text-center text-muted">กรุณาเลือกปีและงวด</h5>
                                            <div class="card-body">
                                                <!-- <form class="d-flex flex-column justify-content-center" method="POST" target="pdfFrame" '>                                            -->
                                                <form class="d-flex flex-column justify-content-center" method="POST" action='components/pdf.php'>                                           
                                                    <?php include 'components/period_select.php'; ?>
                                                    <button class="btn btn-sm btn-outline-success p-3" name='download'>ตกลง</button>
                                                </form>                                        
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-4 text-center bg-danger p-2">
                                    <small class="text-white"><b>หมายเหตุ : รหัสผ่านสำหรับเปิดดูไฟล์ PDF คือ วัน-เดือน-ปี. เกิดของท่าน</b> <br> *ตัวอย่างเช่น ถ้าท่านเกิดวันที่ 5 เดือนมกราคม พศ. 2530 รหัสผ่านของท่านคือ 05012530*</small>
                                </div>              
                            </div>                   
                        </div>
                    </main>
                    <div class="py-5"></div>
                    <!-- footer -->
                    <div class="desktop">
                        <?php include 'components/foot.php'; ?>  
                    </div>
                </div>
            </div>
            <div class="mobilenav">
                <?php include 'components/bottomnav.php'; ?>
            </div>
        </body>
    </html>
<?php 
}else{
    header('location:login');
}
?>