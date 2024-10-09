<?php
if(isset($_SESSION['empcode'])){
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-sq" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-center"> รหัสพนักงาน : <?php echo $_SESSION['empcode']; ?></div>
                <div class="text-center">
                    <?php include 'components/emp_pic.php'; ?>
                </div>
                <h6 class="mt-3 mb-0 fs-5 text-center text-white"><?php echo $_SESSION['name']; ?> </h6>
                <small class="mt-0 text-center text-white"><b>ตำแหน่ง :</b> <?php echo $_SESSION['position']; ?> <br><b> แผนก/ฝ่าย :</b> <?php echo $_SESSION['dept_emp']; ?> </small>

                <div class="sb-sidenav-menu-heading">หน้าหลัก</div>
                
                <a class="nav-link" href="index">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-home-alt"></i></div>
                    สรุปรายการเงินเดือน
                </a>

                <div class="sb-sidenav-menu-heading">รายการสลิป</div>
                <a class="nav-link" href="records">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-table"></i></div>
                    ตารางรายการย้อนหลัง
                </a>

                <a class="nav-link" href="./eslip">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-receipt"></i></div>
                    สลิปเงินเดือน (PDF)
                </a>
               
               <?php if(trim($_SESSION['role']) == "am"){?>
                <div class="sb-sidenav-menu-heading bg-warning p-2 text-sq-dark">ส่วนของ Admin</div>
                <a class="nav-link" href="./admin?manage=users">
                    <div class="sb-nav-link-icon text-white"><i class="fa-solid fa-users-gear"></i></div>
                    การจัดการผู้ใช้งาน
                </a>
                <?php } ?>

                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-columns"></i></div>การจัดการระบบ
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> -->
            </div>
        </div>
        <div class="sb-sidenav-footer bg-sq-dark">
        <div class="small"><span id="session-time">Loading...</span></div>
            <!-- <div class="small">Logged in as:</div>
            Start Bootstrap -->
        </div>
    </nav>
</div>
<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>
