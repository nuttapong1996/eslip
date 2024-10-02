<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-sq" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-center"> CODE : <?php echo $_SESSION['empcode']; ?></div>
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
                <!-- <div class="sb-sidenav-menu-heading">รายการสลิป</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> -->
                <div class="sb-sidenav-menu-heading">รายการสลิป</div>
                <a class="nav-link" href="records">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-table"></i></div>
                    ตารางรายการย้อนหลัง
                </a>
                <a class="nav-link" href="./eslip">
                    <div class="sb-nav-link-icon text-white"><i class="fas fa-receipt"></i></div>
                    E-Slip (PDF)
                </a>
               
            </div>
        </div>
        <div class="sb-sidenav-footer bg-sq-dark">
        <div class="small"><span id="session-time">Loading...</span></div>
            <!-- <div class="small">Logged in as:</div>
            Start Bootstrap -->
        </div>
    </nav>
</div>