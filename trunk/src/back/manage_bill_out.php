<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_bill_out" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการใบบิลของสินค้าขาย</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>รหัส</th>
                <th>ลูกค้า</th>
                <th>เจ้าหน้าที่</th>
                <th>วันที่แก้ไข/สร้าง</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM bill_out WHERE billout_status > 0 order by billout_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $row['billout_id'] ?></td>
                    <td><?= $row['billout_code'] ?></td>
                    <td><?= $row['customer_id'] ?></td>
                    <td><?= $row['sales_name'] ?></td>
                    <td><?= change_dateYMD_TO_DMY($row['billout_updatedate'])?></td>
                    <td><a href="index.php?page=form_bill_out&id=<?= $row['billout_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['billout_id'] ?>, '../database/db_bill_out.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>
