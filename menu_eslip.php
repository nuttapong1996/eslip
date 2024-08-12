<?php 
$title = "สลิปเงินเดือนอิเล็กทรอนิกส์(E-SLIP)";
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
                    <!-- Breadcrumb -->
                     <?php include 'components/breadcrumb.php'; ?>
                    <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <div class="card border-success mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="m-0">กรุณาเลือกงวดและปีของสลิปเงินเดือน</h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="d-flex flex-column justify-content-center" action="eslip_pdf.php" method="POST">    
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">งวดที่ : </span>
                                                    <select class="form-select form-select-sm" name="period" id="">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <!-- <input type="text" name="period" class="form-control form-control-sm"> -->
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">ปี : </span>
                                                    <select class="form-select form-select-sm" name="year" id="">
                                                        <option value="2022">2022</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                    </select>
                                                </div> 
                                            <button class="btn btn-sm btn-success p-3"><i class="fas fa-search"></i> ค้นหา</button>
                                        </form>
                                    </div>
                                </div>
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