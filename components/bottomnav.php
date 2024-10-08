<?php
if(isset($_SESSION['empcode'])){
?>
    <nav class="fixed-bottom navbar navbar-expand  bg-sq-dark" style="height: 90px!important;">
        <div class="d-flex w-100 justify-content-around">
            <a class="navbar-brand ps-3 d-flex flex-column" href="index">
                <i class="fa-solid fa-house  fa-lg text-white "></i>
                <small class="text-white mt-1" style="font-size: 0.7rem;">หน้าหลัก</small>
            </a>
            <a class="navbar-brand ps-3 d-flex flex-column" href="records">
                <i class="fa-solid fa-table  fa-lg text-white"></i>
                <small class="text-white mt-1 text-center" style="font-size: 0.7rem;">รายการเงินเดือน<br>ย้อนหลัง</small>
            </a>
            <a class="navbar-brand ps-3 d-flex flex-column" href="./eslip">
                <i class="fa-solid fa-receipt  fa-lg text-white"></i>
                <small class="text-white mt-1" style="font-size: 0.7rem;">สลิป (PDF)</small>
            </a>
            <a class="navbar-brand ps-3 d-flex flex-column" href="profile" >
            <i id="collapse_icon" class="fas fa-user  fa-lg text-white"></i>
                <small class="text-white mt-1" style="font-size: 0.7rem;">ผู้ใช้</small>
            </a>
        </div>
    </nav> 
<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>