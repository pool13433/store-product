
<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_pay_condition" class="uk-button uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการระยะเวลาการจ่ายเงิน</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>ระยะเวลา</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pay_condition order by pay_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?=$row['pay_id']?></td>
                    <td><?=$row['pay_name']?></td>
                    <td><?=$row['pay_time']?></td>
                    <td><?=  change_dateYMD_TO_DMY($row['pay_updatedate'])?></td>
                    <td><a href="index.php?page=form_pay_condition&id=<?=$row['pay_id']?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?=$row['pay_id']?>,'../database/db_pay_condition.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>
