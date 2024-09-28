<?php
if(isset($_SESSION['empcode'])){
    $title = "รายละเอียดผู้ใช้งาน";
?>
<title><?php echo $title ?></title>
<main>
    <div class="container px-4">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-7">
                <div class="card p-3 rounded-0 border-0 shadow-lg">
                    <h4 class="text-center fw-normal">รายละเอียดผู้ใช้งาน</h4>
                    <div class="card-body">
                        <form action="#" method="POST" class="needs-validation" novalidate>
                            <div class="row mb-3">
                                <div class="col-md-12">

                                </div>                                   
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php }else{
    header('location:../login');
}
?>