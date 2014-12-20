<link rel="stylesheet" type="text/css" href="../../lib/uikit-master/docs/css/uikit.docs.min.css"/>    
<link rel="stylesheet" type="text/css" href="../../lib/DataTables-1.10.4/media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="../../lib/uikit-master/vendor/jquery.js"></script>
<script type="text/javascript" src="../../lib/uikit-master/docs/js/uikit.min.js"></script>
<script type="text/javascript" src="../../lib/uikit-master/src/js/components/notify.js"></script>
<!-- datatable-->
<script type="text/javascript" src="../../lib/DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>
<!-- datatable-->
<script type="text/javascript" src="../../js/script.js"></script>
<table id="table-search_product" class="uk-table uk-table-striped dataTable">
    <thead>
        <tr>
            <th>เลือก</th>
            <th>รหัสสินค้า</th>
            <th>ชื่อ</th>
            <th>ชนิด</th>
            <th>คำอธิบาย</th>
            <th>กลุ่ม</th>                    
        </tr>
    </thead>
    <tbody>
        <?php
        include '../config/Connect.php';
        $query = mysql_query("SELECT * FROM product p JOIN category c ON c.cat_id = p.cat_id JOIN type t ON t.type_id = p.type_id") or die(mysql_error());
        while ($row = mysql_fetch_array($query)):
            ?>
            <tr>
                <td><button type="button" class="uk-button uk-button-success" onclick="select_product('<?= $row['pro_code'] ?>', '<?= $row['pro_name'] ?>', '<?= $row['type_name'] ?>')"><i class="uk-icon-plus-square-o"></i></button></td>
                <td><?= $row['pro_code'] ?></td>
                <td><?= $row['pro_name'] ?></td>
                <td><?= $row['type_name'] ?></td>
                <td><?= $row['pro_desc'] ?></td>
                <td><?= $row['cat_name'] ?></td>                        
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<div class="uk-form-row" style="text-align:right;">
    <div class="uk-form-controls">
        <button class="uk-button uk-button-danger  uk-modal-close" type="button">
            <i class="uk-icon-arrow-circle-left"></i> ยกเลิก/ปิด
        </button>
    </div>
</div>
<script type="text/javascript">
    function select_product(code, name, type_name) {
        var tr = '<tr>';
        tr += '<td style="width:13%"><input type="hidden" name="id" value=""/>' + code + '</td>';
        tr += '<td style="width:10%">' + name + '</td>';
        tr += '<td style="width:6%">' + type_name + '</td>';
        tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="isInt(this)"/></td>';
        tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)"/></td>';
        tr += '<td><input type="text" class="uk-width-small-9-10" /></td>';
        tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" /></td>';
        tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="isInt(this)" /></td>';
        tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10" readonly onchange="isInt(this)" /></td>';
        tr += '<td><button type="button" class="uk-button uk-button-mini uk-button-danger" onclick="remove_tr(this)"><i class="uk-icon-trash-o"></i>ลบ</button></td>';
        tr += '</tr>';
        $('#table_product').append(tr);
        //appendDropdownProductType(code);                
        $.UIkit.modal("#dialod-search_product").hide();
    }
</script>
</html>

