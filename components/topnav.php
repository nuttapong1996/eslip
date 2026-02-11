<?php
if(isset($_SESSION['empcode'_elip])){
?>
<div class="desktop">
<nav class="sb-topnav navbar navbar-expand bg-sq-dark">

    <a class="navbar-brand ps-3" href="index"><img src="assets/images/logo_white.png" width="100px" alt="logo"></a>
    <!-- Sidebar Toggle-->
    <!-- <button class="btn btn-link btn-sm text-sq-orange order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
    <div class="ms-auto me-0 me-md-3 my-2 my-md-0"></div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php include 'components/emp_icon.php' ?>
                <?php  echo $_SESSION['name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item text-sq-dark" href="user?manage=user_detail"><i class="fa-solid fa-user-pen"></i> รายละเอียดผู้ใช้งาน</a></li>
                <li><a class="dropdown-item text-sq-dark" href="user?manage=password"><i class="fa-solid fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item text-danger" href="logout">ออกจากระบบ &nbsp<i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </li>
    </ul>
</nav>
</div>

<div class="mobilenav">
    <nav class="sb-topnav navbar navbar-expand bg-sq-dark shadow-sm text-center" style="height: 50px">
        <a class="navbar-brand ps-3 w-100" href="index"><img src="assets/images/logo_white.png" width="100px" alt=""logo></a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm text-sq-orange order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->      
    </nav>
</div>
<?php 
}else{
    echo "<script>window.location.href = '../login';</script>";
}
?>
