<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_person" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการผู้ใช้งานระบบ</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>code</th>
                <th>ชื่อ-สกุล</th>
                <th>ที่อยู่</th>
                <th>โทรศัพท์</th>
                <th>อีเมลล์</th>
                <th>สถานะ</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM person order by per_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?=$row['per_id']?></td>
                    <td><?=$row['per_code']?></td>
                    <td><?=$row['per_fname']." ".$row['per_lname']?></td>
                    <td><?=$row['per_address']?></td>
                    <td><?=$row['per_mobile']?></td>
                    <td><?=$row['per_email']?></td>
                    <td><?=  Get_PersonStatus($row['per_status'])?></td>
                    <td><?=  change_dateYMD_TO_DMY($row['per_updatedate'])?></td>
                    <td><a href="index.php?page=form_person&id=<?=$row['per_id']?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?=$row['per_id']?>,'../database/db_person.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>
