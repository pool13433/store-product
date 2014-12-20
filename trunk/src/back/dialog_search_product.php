<!-- This is the modal -->
<div id="dialog-search_product" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
        <div class="uk-panel" id="content-product">
            <h3 class="uk-panel-title">ค้นหาสินค้า</h3>
            <table id="table-search_product" class="uk-table uk-table-striped dataTable">
                <thead>
                    <tr>
                        <th>เลือก</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อ</th>
                        <th>ชนิด</th>
                        <th>คำอธิบาย</th>
                        <th>กลุ่ม</th>                    
                        <th>จำนวนคงเหลือ</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysql_query("SELECT * FROM product p JOIN category c ON c.cat_id = p.cat_id JOIN type t ON t.type_id = p.type_id") or die(mysql_error());
                    while ($row = mysql_fetch_array($query)):
                        ?>
                        <tr>
                            <td><button type="button" class="uk-button uk-button-success" onclick="chose_product('<?= $row['pro_code'] ?>', '<?= $row['pro_name'] ?>', '<?= $row['type_name'] ?>','<?=$row['pro_amount']?>')"><i class="uk-icon-plus-square-o"></i></button></td>
                            <td><?= $row['pro_code'] ?></td>
                            <td><?= $row['pro_name'] ?></td>
                            <td><?= $row['type_name'] ?></td>
                            <td><?= $row['pro_desc'] ?></td>
                            <td><?= $row['cat_name'] ?></td>                        
                            <td><?= $row['pro_amount'] ?></td>                        
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
        </div>
    </div>
</div>
<script type="text/javascript">
    function chose_product(code, name, type_name,amount) {        
        $.UIkit.modal("#dialog-search_product").hide();       
        var tr = '<tr>';
        tr += '<td style="width:15%"><input type="hidden" name="id" value=""/>' + code + '</td>';
        tr += '<td style="width:10%">' + name + '</td>';
        tr += '<td style="width:15%">' + type_name + '</td>';    
        tr += '<td style="width:10%">' + amount + '</td>';    
        tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)"/></td>';  // จำนวน      
        tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" /></td>'; // ราคา
        tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="isInt(this)" /></td>'; //ส่วนรถ
        tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10" readonly onchange="calculateTotalPrice()" /></td>';
        tr += '<td style="width:5%"><button type="button" class="uk-button uk-button-mini uk-button-danger" onclick="remove_tr(this)"><i class="uk-icon-trash-o"></i>ลบ</button></td>';
        tr += '</tr>';
        $('#table_product').append(tr);
        //appendDropdownProductType(code);                
         
    }
</script>

