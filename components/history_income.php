<div class="row justify-content-center">
    <div class="col-sm-12">
        <form action="#" method="post" class="input-group text-black mb-3">
            <label class="input-group-text" for="slipyear">ปี</label>
            <select class="form-select form-select-sm" name="slipyear" id="slipyear">
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
            </select>
            <button type="submit" class="btn btn-sm btn-primary">เรียกดู</button>
        </form>
    </div>
</div>
<div class="card border-primary text-white mb-4">
    <div class="card-header bg-primary">
        <i class="fas fa-table me-1"></i>รายการย้อนหลัง
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <th>งวด</th>
                <th>วันที่</th>
                <th>รายได้</th>
                <th><i class="fa-solid fa-circle-info"></i></th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($i < 50 ){
                echo"<tr>";
                echo"<td>".$i."</td>";
                echo"<td>xx/xx/xxxx</>";
                echo"<td>#,###,###.##</td>";
                echo"<td><a href='#'><i class='fa-solid fa-right-to-bracket'></i></a></td>";
                echo"</tr>";
                $i++;
                }  ?>
            </tbody>
        </table>
    </div> 
</div>
