<?php
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am"){
    // ชื่อหน้าเว็บ
    $title = "การจัดการผู้ใช้งาน";
    // เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $users= "SELECT 
                table_regis.emp_code,
                table_emp.name_thai_emp , 
                table_regis.created_at  
            FROM 
                tbl_regis AS table_regis
                JOIN tbl_emp AS table_emp ON table_regis.emp_code = table_emp.code_emp
            ORDER BY created_at DESC";

    $users_stmt = $conn->prepare($users);
    $users_stmt->execute();
?>
    <style>
        .datatable-top{
            display:flex;
            flex-direction:row;
            justify-content:space-between;
            margin: 20px 0 20px 0;
            /* width: 100%; */
        }
        .datatable-search{
            width: 100%;
        }
        .datatable-search::before{
            content: "ค้นหาพนักงาน : ";
            font-weight: bold;
        }
    </style>
    <title><?php echo $title ?></title>
    <main>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-9">
                <h3 class="text-center mt-3 mb-2"> <i class="fa-solid fa-users-gear"></i> การจัดการผู้ใช้งาน</h3>
                    <table id="usersDataTable" class="table tabble-bordered bg-light ">
                        <thead>
                            <th>ลำดับ</th>
                            <th>รหัสพนง</th>
                            <th>ชื่อ - สกุล</th>
                            <th>วันที่ลงทะเบียน</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody class="text-sq-dark">
                            <?php
                            $i = 1;
                            foreach($users_stmt as $row){
                                echo"<tr>";
                                echo"<td>". $i++."</td>";
                                echo"<td>".trim($row['emp_code'])."</td>";
                                echo"<td>".trim($row['name_thai_emp'])."</td>";
                                echo"<td style=''>". date_format(date_create($row['created_at']),"d-m-Y H:i")."</td>";
                                echo"<td><a class='btn btn-warning btn-sm' href='./admin?manage=edit&id=".$row['emp_code']."'> <i class='fa-solid fa-pen-to-square'></i></a></td>";
                                echo"<td><a class='btn btn-sm text-danger'  data-bs-toggle='modal' data-bs-target='#DeleteModal'onclick='passValueToModal(\"".$row['name_thai_emp']."\",\"".$row['emp_code']."\")' ><i class='fa-solid fa-trash'></i></a></td>";
                                echo"</tr>";
                            }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="DeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header text-danger">
            <h1 class="modal-title fs-5 " id="staticDeleteModal">ลบผู้ใช้งานรหัส : <span id="modal-title"></span>?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h5>ชื่อ : <span id="modal-name"></span></h5>
            <h5>รหัสพนักงาน : <span id="modal-id"></span></h5>
        </div>
        <div class="modal-footer justify-content-center">
            <a class="btn btn-danger"id='deleteBtn' href='#'>&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-trash"></i>&nbsp;ลบ &nbsp;&nbsp;&nbsp;</a>
            <button type="button" class="btn btn-success"  data-bs-dismiss="modal"> <i class="fa-solid fa-xmark"></i>&nbsp;ยกเลิก</button>
        </div>
        </div>
    </div>
    </div>

    <script>
        function passValueToModal(name, empcode) {
            document.getElementById("modal-title").innerText = empcode;
            document.getElementById("modal-id").innerText = empcode;
            document.getElementById("modal-name").innerText = name;
            var link = './manage/delete_user_proc?id=' + empcode;
            document.getElementById("deleteBtn").setAttribute("href", link);
        }
    </script>
<?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}

if(isset($_GET['edit_success'])){
    echo "<script>
            Swal.fire({
                title: 'อัพเดทข้อมูลสําเร็จ',
                text: 'อัพเดทข้อมูลของผู้ใช้งานรหัส ".$_GET['id']." สําเร็จ',
                icon: 'success',
                showConfirmButton: true,
            }).then(function() {
                window.location ='./admin?manage=users';
            })
        </script>";    
}

if(isset($_GET['delete_success'])){
    echo "<script>
            Swal.fire({
                title: 'ลบข้อมูลสําเร็จ',
                text: 'ลบผู้ใช้งานรหัส ".$_GET['id']." แล้ว',
                icon: 'success',
                showConfirmButton: true,
            }).then(function() {
                window.location ='./admin?manage=users';
            })
        </script>";    
}

if(isset($_GET['delete_fail'])){
    echo "<script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'ลบผู้ใช้งานรหัส ".$_GET['id']." ไม่สําเร็จ',
                icon: 'error',
                showConfirmButton: true,
            }).then(function() {
                window.location ='./admin?manage=users';
            })
        </script>";    
}
?>