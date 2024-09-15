<?php 
$title = "รายละเอียด";
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
            <main class="mt-3 mb-3">
                <div class="container-fluid px-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <?php include 'components/income_detail.php'; ?>
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