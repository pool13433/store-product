<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_product" class="uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการสินค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>CODE</th>
                <th>ชื่อสินค้า</th>
                <th>อธิบาย</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>ส่วนลด</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM product order by pro_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?=$row['pro_id']?></td>
                    <td><?=$row['pro_code']?></td>
                    <td><?=$row['pro_name']?></td>
                    <td><?=$row['pro_desc']?></td>
                    <td><?=$row['pro_amount']?></td>
                    <td><?=$row['pro_unitprice']?></td>
                    <td><?=$row['pro_discount']?></td>
                    <td><a href="index.php?page=form_product&id=<?=$row['pro_id']?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?=$row['pro_id']?>,'../database/db_product.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>


