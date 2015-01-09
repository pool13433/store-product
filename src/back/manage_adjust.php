<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_adjust" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการกลุ่มสินค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>จำนวนก่อนปรับ</th>
                <th>จำนวนที่ปรับ</th>
                <th>ชนิด</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($_GET['id'])):
                $pro_id = $_GET['id'];
                $sql = " SELECT * FROM adjust ad";
                $sql .= " LEFT JOIN product p ON p.pro_id = ad.pro_id";
                $sql .= " WHERE ad.pro_id = $pro_id";
                $sql .= " ORDER BY adj_id";
                $query = mysql_query($sql) or die(mysql_error());
                while ($row = mysql_fetch_array($query)):
                    ?>
                    <tr>
                        <td><?= $row['adj_id'] ?></td>
                        <td><?= $row['pro_name'] ?></td>
                        <td><?= $row['adj_product_lastamount'] ?></td>
                        <td><?= $row['adj_adjust_no'] ?></td>
                        <td><?= Get_Adjust($row['adj_type']) ?></td>
                        <td><?= change_dateYMD_TO_DMY($row['adj_updatedate']) ?></td>
                        <td><a href="index.php?page=form_adjust&id=<?= $row['adj_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                        <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['adj_id'] ?>, '../database/db_adjust.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
