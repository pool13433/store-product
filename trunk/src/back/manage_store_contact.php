<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_store_contact" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการผู้ใช้งานระบบ</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>CODE</th>
                <th>ชื่อร้าน</th>
                <th>ร้านเกี่ยวกับ</th>
                <th>ชื่อเจ้าของ</th>
                <th>ที่อยู่</th>
                <th>ประเภท</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM store_contact order by store_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $row['store_id'] ?></td>
                    <td><?= $row['store_code'] ?></td>
                    <td><?= $row['store_name'] ?></td>
                    <td><?= $row['store_desc'] ?></td>
                    <td><?= $row['store_onwer'] ?></td>
                    <td><?= $row['store_address']?></td>
                    <td><?= Get_StoreContactStatus($row['store_type']) ?></td>
                    <td><a href="index.php?page=form_store_contact&id=<?= $row['store_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['store_id'] ?>, '../database/db_store_contact.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

