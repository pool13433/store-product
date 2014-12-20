<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_category" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการกลุ่มสินค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>อธิบาย</th>
                <th>วันที่สร้าง</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM category order by cat_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?=$row['cat_id']?></td>
                    <td><?=$row['cat_name']?></td>
                    <td><?=$row['cat_desc']?></td>
                    <td><?=$row['cat_createdate']?></td>
                    <td><a href="index.php?page=form_category&id=<?=$row['cat_id']?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?=$row['cat_id']?>,'../database/db_category.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

