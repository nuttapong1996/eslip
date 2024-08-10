<?php 

$title = "สรุปรายการเงินเดือน";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'components/head.php'; ?>
    <title><?php echo $title ?></title>
</head>
<body class="sb-nav-fixed ibm-plex-sans-thai-regular">
    <!-- topnav -->
    <?php include 'components/topnav.php'; ?>
    <div id="layoutSidenav">
        <!-- sidenav -->
        <?php include 'components/sidenav.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?php echo $title ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><?php echo $title ?></li>
                    </ol>

                    <!-- Current income component -->
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-md-6">
                            <?php include 'components/current_income.php'; ?>
                        </div>
                    </div>

                    <!-- History income component -->
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-md-6">
                        <?php include 'components/history_income.php'; ?>
                        </div>
                    </div>
                </div>
            </main>
            <!-- footer -->
            <?php include 'components/foot.php'; ?>        
        </div>
    </div>
</body>
</html>