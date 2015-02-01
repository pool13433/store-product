<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_supplier_contact" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">ข้อมูลผู้จัดจำหน่าย</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>รหัสผู้จัดจำหน่าย</th>
                <th>ชื่อร้าน/ชื่อบริษัท</th>
                <th>ที่อยู่</th>
                <th>วันที่สั่งของ</th>
                <th>วันที่ส่งของ</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM supplier_contact order by sup_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $row['sup_code'] ?></td>
                    <td><?= $row['sup_name'] ?></td>
                    <td><?= $row['sup_address'] ?></td>                    
                    <td>
                        <?php
                        $arrayOrderday = explode(',', $row['sup_orderday']);
                        foreach ($arrayOrderday as $value):
                            echo '<div class="uk-badge uk-badge-warning">' . Get_Day($value) . '</div>';
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $arrayDeliveryday = explode(',', $row['sup_deliveryday']);
                        foreach ($arrayDeliveryday as $value):
                            echo '<div class="uk-badge">' . Get_Day($value) . '</div>';
                        endforeach;
                        ?>
                    </td>
                    <td><?= change_dateYMD_TO_DMY($row['sup_updatedate']) ?></td>
                    <td><a href="index.php?page=form_supplier_contact&id=<?= $row['sup_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['sup_id'] ?>, '../database/db_supplier_contact.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>