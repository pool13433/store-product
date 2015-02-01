<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_store_contact" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">ข้อมูลลูกค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อร้าน</th>
                <th>รายละเอียดร้าน</th>
                <th>ชื่อเจ้าของร้าน</th>
                <th>ที่อยู่</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM store_contact order by sto_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $row['sto_code'] ?></td>
                    <td><?= $row['sto_name'] ?></td>
                    <td><?= $row['sto_desc'] ?></td>
                    <td><?= $row['sto_onwer'] ?></td>
                    <td><?= $row['sto_address'] ?></td>                    
                    <td><?= change_dateYMD_TO_DMY($row['sto_updatedate']) ?></td>
                    <td><a href="index.php?page=form_store_contact&id=<?= $row['sto_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['sto_id'] ?>, '../database/db_store_contact.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>