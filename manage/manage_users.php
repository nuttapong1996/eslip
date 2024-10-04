<?php
if(isset($_SESSION['empcode']) && trim($_SESSION['role'])=="am"){
    $title = "การจัดการผู้ใช้งาน";
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
    // $users_row = $users_stmt->fetchAll(PDO::FETCH_ASSOC);


 $conn = null;
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
                            echo"<td style=''>". date_format(date_create($row['created_at']),"d-m-Y")."</td>";
                            echo"<td><a class='btn btn-warning btn-sm' href='./admin?manage=edit&id=".$row['emp_code']."'> <i class='fa-solid fa-pen-to-square'></i></a></td>";
                            echo"<td><a class='btn btn-sm text-danger' href='./manage/delete_user?id=".$row['emp_code']."'> <i class='fa-solid fa-trash'></i></a></td>";
                            echo"</tr>";
                        }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
}else{
    header('location: ../login');
}
?>