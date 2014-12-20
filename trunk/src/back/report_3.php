<?php include '../config/Connect.php'; ?>
<table class="uk-table uk-table-condensed" id="table-report_3">
    <thead>
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนสินค้าคงเหลือ</th>
            <th>ราคาสินค้า</th>
            <th>ส่วนลดสินค้า</th>
            <th>วันที่สร้างสินค้า</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM product ORDER BY pro_id";
        $query = mysql_query($sql) or die(mysql_error());
        while ($row = mysql_fetch_array($query)):
            ?>
            <tr>
                <td><?= $row['pro_code'] ?></td>
                <td><?= $row['pro_name'] ?></td>
                <td><?= $row['pro_amount'] ?></td>
                <td><?= $row['pro_unitprice'] ?></td>
                <td><?= $row['pro_discount'] ?></td>
                <td><?= $row['pro_createdate'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-report_3').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "../../lib/TableTools-2.2.3/swf/copy_csv_xls_pdf.swf"
            }
        });
    });
</script>

