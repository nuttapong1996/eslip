<?php 
$title = "สลิปเงินเดือนอิเล็กทรอนิกส์(E-SLIP) แบบ Pdf";
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
                    <h3 class="mt-5 mb-4 text-center">ดาวน์โหลด Eslip (PDF)</h3>
                    <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <div class="card border-0 rounded-0 p-2 mb-4 shadow-sm">
                                        <h5 class="m-0 text-center text-muted">กรุณาเลือกปีและงวด</h5>
                                    <div class="card-body">
                                        <!-- <form class="d-flex flex-column justify-content-center" method="POST" target="pdfFrame" '>                                            -->
                                        <form class="d-flex flex-column justify-content-center" method="POST" action='components/pdf.php'>                                           
                                            <?php include 'components/year_select.php'; ?>
                                            <button class="btn btn-sm btn-outline-success p-3" name='download'><i class="fas fa-download"></i> ดาวน์โหลด</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <!-- <h3>PDF ที่สร้าง:</h3> -->
                            <!-- <iframe name="pdfFrame" src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://192.168.100.105/www/eslip/components/pdf.php" style="width:100%; height:1000px;" frameborder="0"></iframe> -->
                            <!-- <iframe name="pdfFrame" src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://de8a-115-84-77-13.ngrok-free.app/www/eslip/components/pdf.php" style="width:100%; height:1000px;" frameborder="0"></iframe> -->
                            <!-- <iframe name="pdfFrame" src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://app.sqmm.myds.me:8443/pdf/SQMM_ESL_2630065_2024_PP1-16.pdf" style="width:100%; height:1000px;" frameborder="0"></iframe> -->
                            <!-- <iframe id="theFrame" name="pdfFrame" src="https://docs.google.com/viewerng/viewer?url="http://192.168.100.105/www/eslip/SQMM_ESL_2600217_2024_PP16-16.pdf'&embedded=true" width="100%" height="800" type="application/pdf"></iframe> -->
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
