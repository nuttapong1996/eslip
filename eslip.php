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
                     <?php breadcrumb($title); ?>
                    <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <div class="card border-success mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="m-0">กรุณาเลือกงวดและปีของสลิปเงินเดือน</h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="d-flex flex-column justify-content-center" action="docs/slip_pdf.php" method="POST">
                                            <h5>จาก</h5>    
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">งวดที่ : </span>
                                                    <select class="form-select form-select-sm" name="period1" id="">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <span class="input-group-text">ปี : </span>
                                                    <select class="form-select form-select-sm" name="year1" id="">
                                                        <option value="2024">2024</option>
                                                        <option value="2023">2023</option>
                                                    </select>
                                                </div>
                                                <h5>ถึง</h5>  
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">งวดที่ : </span>
                                                    <select class="form-select form-select-sm" name="period2" id="">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <span class="input-group-text">ปี : </span>
                                                    <select class="form-select form-select-sm" name="year2" id="">
                                                        <option value="2024">2024</option>
                                                        <option value="2023">2023</option>
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