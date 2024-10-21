<?php
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am" && isset($_GET['dept'])){
    // ชื่อหน้าเว็บ
    $title = "รายชื่อผู้สมัครใช้งานแผนก/ฝ่าย" . " " . $_GET['dept'];
    //เรียกใช้ฟังก์ชันเชื่อมต่อฐานข้อมูล
    require_once __DIR__ . '/../includes/connect_db.php';

    $dept = $_GET['dept'];

    $users= "SELECT 
                table_emp.name_thai_emp AS name,
                table_emp.code_emp AS empcode,
                table_reg.created_at,
                CASE 
                    WHEN table_reg.emp_code IS NOT NULL 
                    THEN 'สมัครแล้ว'
                    ELSE 'ยังไม่สมัคร'
                END AS status,
                COUNT(table_emp.code_emp) OVER() as total
            FROM 
                tbl_emp AS table_emp
                LEFT JOIN tbl_regis AS table_reg ON table_emp.code_emp = table_reg.emp_code
                JOIN tbl_dept_emp AS table_dept ON table_emp.dept_emp = table_dept.code_tbl_deptemp
            WHERE 
                table_dept.short_name_deptemp = :dept AND table_emp.status_emp = 10 AND table_emp.code_emp NOT LIKE '%C%' 
            ORDER BY status ASC";

    $users_stmt = $conn->prepare($users);
    $users_stmt->bindParam(':dept', $dept);
    $users_stmt->execute();

?>
    <style>
        .dt-search{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            font-weight: bold;
        }
        @media screen and (max-width: 425px) {
            .dt-search{
                justify-content: center;
                margin: 10px 0;
            }
        }
        div >li >a {color: #000;}
        div > li >a:hover{color: #fff;}
    </style>
    <title><?php echo $title ?></title>
    <main>

        <div class="container px-4">
            <div class="row mt-5">
                <div class="col-sm-5">
                    <li class="fs-6 btn btn-outline-dark "><a class="text-decoration-none" href="admin?manage=stat_user"><i class="fa-solid fa-arrow-left"></i> กลับหน้าหลัก</a></li>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-9">               
                <h3 class="text-center mt-3 mb-2"> <i class="fa-solid fa-table-list"></i> รายชื่อผู้สมัครใช้งาน<br>แผนกฝ่าย : <?php echo $dept ?></h3>
                    <table id="usersListDataTable" class="table tabble-bordered bg-light shadow-sm">
                        <thead>
                            <th class="bg-primary text-white text-center">ลำดับ</th>
                            <th class="bg-primary text-white text-center">รหัสพนง</th>
                            <th class="bg-primary text-white text-center">ชื่อ - สกุล</th>
                            <th class="bg-primary text-white text-center">สถานะ</th>
                            <th class="bg-primary text-white text-center">วันที่ลงทะเบียน</th>
                        </thead>
                        <tbody class="">
                            <?php
                            $i = 1;
                            foreach($users_stmt as $row){
                                echo"<tr>";
                                echo"<td class='text-center'>". $i++."</td>";
                                echo"<td class='text-center'>".trim($row['empcode'])."</td>";
                                echo"<td>".trim($row['name'])."</td>";
                                if($row['status'] == 'สมัครแล้ว'){
                                    echo"<td class='text-center'><span class='badge bg-success'>สมัครแล้ว</span></td>";
                                }else{
                                    echo"<td class='text-center'><span class='badge bg-danger'>ยังไม่สมัคร</span></td>";
                                }

                                
                                if($row['created_at'] != null){
                                    echo"<td class='text-center'>". date_format(date_create($row['created_at']),"d-m-Y H:i")."</td>";
                                }else{
                                    echo"<td class='text-center'>-</td>";
                                }

                                echo"</tr>";
                            }  
                            ?>
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
        	
    // let table = new DataTable('#usersDataTable');

        $('#usersListDataTable').DataTable( {
            dom: 'Bfrtip',  // แสดงปุ่มที่ด้านบนของตาราง
            buttons: [
                {
                    extend: 'excelHtml5',  // ชนิดการส่งออก Excel
                    text: '<b>ส่งออก Excel </b> &nbsp;<i class="text-success fa-solid fa-file-excel"></i> ',  // ชื่อปุ่ม
                    title: 'รายชื่อผู้สมัครใช้งาน E-slip แผนก/ฝ่าย - <?php echo $dept ?>',  // ชื่อไฟล์ Excel
                    exportOptions: {
                        columns: ':visible'  // ส่งออกเฉพาะคอลัมน์ที่มองเห็นได้
                    }
                }
            ],
            columnDefs: [ {
                targets: [0,1,2,4],
                orderable: false
            } ],
            ordering: true,
            pageLength: 100,
            lengthChange : false,
            responsive :true,
            language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.1/i18n/th.json',
            }
        } );

    </script>
<?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}else{
    echo "<script>window.location.href = '../login';</script>";
}

?>