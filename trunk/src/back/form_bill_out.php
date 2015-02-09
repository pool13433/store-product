<?php include '../config/Connect.php'; ?>
<?php
$bill_id = "";
$customer_id = "";
$customer_onwer = "";
$customer_address = "";
$billcode = "";
$billdate = "";
$salse_name = "";
$pay_condition = "";
$receiver = "";
$sender = "";
$totalprice = "";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = " SELECT * FROM bill_out bo";
    $sql .= " LEFT JOIN store_contact sc ON sc.sto_id = bo.customer_id";
    $sql .= " WHERE billout_id = $id";
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);

    $bill_id = $data['billout_id'];
    $customer_id = $data['sto_id'];
    $customer_onwer = $data['sto_onwer'];
    $customer_address = $data['sto_address'];
    $billcode = $data['billout_code'];
    $billdate = $data['billout_outdate'];
    $salse_name = $data['salse_name'];
    $pay_condition = $data['pay_id'];
    $receiver = $data['billout_receiver'];
    $sender = $data['billout_sender'];
    $totalprice = $data['billout_total'];
}
?>
<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-bill_out"> 
        <div class="uk-panel">
            <h3 class="uk-panel-title">เพิ่มข้อมูลสำคัญ</h3>
            <div class="uk-grid">
                <div class="uk-width-5-10">
                    <div class="uk-form-row">                        
                        <a type="button" class="uk-button uk-button-primary" href="#dialog-search_store_contact" data-uk-modal ><i class="uk-icon-search-plus"></i>ค้นหาลูกค้า</a>                            
                    </div>
                    <div class="uk-form-row">
                        <label for="input-store_name" class="uk-form-label">ชื่อลุกค้า</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="customer_id" id="input-store_id" value="<?= $customer_id ?>" />
                            <input type="text" name="customer_onwer" id="input-store_onwer" value="<?= $customer_onwer ?>"                                   
                                   data-validation-engine="validate[required]" readonly
                                   data-errormessage-value-missing="กรุณากรอก เลือกข้อมูลลูกค้า"/>
                        </div>    
                    </div>
                    <div class="uk-form-row">
                        <label for="input-store_address" class="uk-form-label">ที่อยู่ลูกค้า</label>
                        <div class="uk-form-controls">
                            <textarea class="" name="customer_address" id="input-store_address"
                                      data-validation-engine="validate[required]" readonly
                                      data-errormessage-value-missing="กรุณากรอก เลือกข้อมูลลูกค้า"/><?= $customer_address ?></textarea>
                        </div> 
                    </div>
                </div>
                <div class="uk-width-5-10">
                    <div class="uk-form-row">
                        <label for="input-code" class="uk-form-label">เลขที่</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="bill_id" id="input-bill_id" value="<?= $bill_id ?>"/>
                            <input type="text" name="billcode" id="input-code" value="<?= $billcode ?>"
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก เลขที่เอกสาร"/>
                        </div>    
                    </div>
                    <div class="uk-form-row">
                        <label for="input-outdate" class="uk-form-label">วันที่</label>
                        <div class="uk-form-controls">
                            <input type="text" name="billdate" id="input-outdate" value="<?= change_dateYMD_TO_DMY($billdate) ?>"
                                   readonly 
                                   data-uk-datepicker="{weekstart:0, format:'DD/MM/YYYY'}"
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก วันที่จำหน่าย"/>
                        </div>    
                    </div>
                    <div class="uk-form-row">
                        <label for="input-officer" class="uk-form-label">พนักงานขาย</label>
                        <div class="uk-form-controls">
                            <input type="text" name="salse_name" id="input-salse_name" value="<?= $salse_name ?>"
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณาเลือก ข้อมูลพนักงานขาย"/>
                        </div>    
                    </div>
                    <div class="uk-form-row">
                        <label for="input-customer" class="uk-form-label">เงื่อนไขการชำระเงิน</label>
                        <div class="uk-form-controls">
                            <?php
                            $sql_pay_condition = "SELECT * FROM pay_condition ORDER BY pay_id";
                            $query_pay_condition = mysql_query($sql_pay_condition) or die(mysql_error());
                            ?>
                            <select id="form-s-s" name="pay_condition"
                                    data-validation-engine="validate[required]"
                                    data-errormessage-value-missing="กรุณากรอก เงื่อนไขการจ่ายเงิน">
                                <option value="">-- เลือก --</option>
                                <?php while ($data_pay = mysql_fetch_array($query_pay_condition)): ?>
                                    <?php if ($pay_condition == $data_pay['pay_id']): ?>
                                        <option value="<?= $data_pay['pay_id'] ?>" selected><?= $data_pay['pay_name'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $data_pay['pay_id'] ?>" selected><?= $data_pay['pay_name'] ?></option>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <a class="uk-button uk-button-primary" href="#dialog-search_product" data-uk-modal id="btn-search_product">
                        <i class="uk-icon-search-plus"></i> ค้นหาสินค้า</a> 
                    <table class="uk-table uk-table-striped">
                        <thead>
                            <tr>                                
                                <th>รหัสสินค้า</th>
                                <th>รายละเอียดสินค้า</th>
                                <th>กลุ่ม</th>
                                <th>จำนวนคงเหลือ</th>
                                <th>จำนวน</th>
                                <th>หน่วยละ</th>
                                <th>ส่วนลด</th>
                                <th>จำนวนเงิน</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="table_product"></tbody>
                    </table>
                </div>                
            </div>
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    <div class="uk-form-row">
                        <label for="input-receiver" class="uk-form-label">ผู้รับของ</label>
                        <div class="uk-form-controls">
                            <input type="text" name="receiver" id="input-receiver" value="<?= $receiver ?>"
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก ข้อมูลผู้รับของ"/>
                        </div>    
                    </div>
                    <div class="uk-form-row">
                        <label for="input-sender" class="uk-form-label">ผู้ส่งของ</label>
                        <div class="uk-form-controls">
                            <input type="text" name="sender" id="input-sender" value="<?= $sender ?>"
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก ข้อมูลผู้ส่งของ"/>
                        </div>    
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <div class="uk-form-row" style="text-align: right">
                        <label for="input-totalprice" class="uk-form-label">รวมเงิน</label>
                        <div class="uk-form-controls">
                            <input type="text" name="totalprice" id="input-totalprice" onchange="getTextBath(this)"
                                   data-validation-engine="validate[required]" value="<?= $totalprice ?>" readonly
                                   data-errormessage-value-missing="กรุณากรอก เลือกข้อมูลพนักงานขาย"/>                            
                            <div class="uk-alert" id="label-price">...</div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary uk-button-large" type="submit">
                            <i class="uk-icon-save"></i> บันทึก
                        </button>
                        <button class="uk-button uk-button-danger uk-button-large" type="button">
                            <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                        </button>
                    </div>
                </div>                
            </div>
        </div>   
    </form>
</div>
<?php include './dialog_search_product.php'; ?>
<?php include './dialog_search_store_contact.php'; ?>

<script type="text/javascript">
    var LIST_PRODUCT_REMOVE = new Array();
    $(document).ready(function() {
        var valid = $('#frm-bill_out').validationEngine('attach', {
            promptPosition: "centerTop",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true) {
                    //PostJson('frm-bill_in', '../database/db_bill_in.php?method=create');
                    $.ajax({
                        url: '../database/db_bill_out.php?method=create',
                        data: {
                            form: JSON.stringify(getFormData('frm-bill_out')), //JSON.stringify($('#frm-bill_in').serializeArray()),
                            list_product: get_data_table(),
                            list_product_remove: JSON.stringify(LIST_PRODUCT_REMOVE),
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 'success') {
                                uk_notify(data.msg, 'success', 3);
                                redirectDelay(data.url, 2);
                            } else {
                                uk_notify(data.msg, 'error', 3);
                            }
                        }
                    })
                }

            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
        // ############ LOAD EDIT FROM ##########
        //#############LOAD PRODUCT ###########
        LIST_PRODUCT_REMOVE = new Array();
        $.ajax({
            url: '../database/db_bill_out.php?method=get_pro_product_by_biil_id',
            data: {bill_id: $('#input-bill_id').val()},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(index, object) {
                    //select_product(object.pro_code, object.pro_name);
                    var tr = '<tr>';
                    tr += '<td style="width:10%"><input type="hidden" name="id" value="' + object.billoutpro_id + '"/>' + object.pro_code + '</td>';
                    tr += '<td style="width:15%">' + object.pro_name + '</td>';
                    tr += '<td style="width:15%">' + object.type_name + '</td>';
                    tr += '<td style="width:10%">' + object.pro_amount + '</td>';
                    tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" value="' + object.billoutpro_nocount + '"/></td>';
                    tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" value="' + object.billoutpro_unitprice + '"/></td>';
                    tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="isInt(this)" value="' + object.billoutpro_discount + '"/></td>';
                    tr += '<td style="width:10%"><input type="text" class="uk-width-small-9-10" readonly onchange="calculateTotalPrice()" value="' + object.billoutpro_totalprice + '"/></td>';
                    tr += '<td style="width:5%"><button type="button" class="uk-button uk-button-mini uk-button-danger" onclick="remove_tr(this,' + object.billoutpro_id + ')"><i class="uk-icon-trash-o"></i>ลบ</button></td>';
                    tr += '</tr>';
                    $('#table_product').append(tr);
                    calculateTotalPrice();
                });
                appendDropdownProductType();
            }
        });
        //#############LOAD PRODUCT ###########

    });
    function loadDialogDataTable() {
        $('#content-product').load('load_product.php');
    }
    function get_data_table() {
//            var list_tr = $('#table_product').children('tr');
//            console.log(' list length : '+list_tr.length);
        var list_product = new Array();
        $('#table_product tr').each(function(index, element) {
            console.log(' index : ' + index + ' element : ' + element);
            var obj_product = get_tr_value(element);
            list_product.push(obj_product);
        });
        console.log('list_product : ' + JSON.stringify(list_product));
        return JSON.stringify(list_product);
    }
    function get_tr_value(element) {
        var cell0 = $(element).find('td:eq(0)');
        var txt_code = $(cell0).text();
        console.log('txt_code : ' + txt_code);
        var cell0 = $(element).find('td:eq(0)');
        var txt_id = $(cell0).find('input:hidden').val();
        var cell1 = $(element).find('td:eq(1)');
        var txt_name = $(cell1).text();
        var cell2 = $(element).find('td:eq(2)');
        var input_type = $(cell2).text();
        var cell3 = $(element).find('td:eq(3)');
        var input_nocount = $(cell3).find('input:text').val();
        var cell4 = $(element).find('td:eq(4)');
        var input_nocount = $(cell4).find('input:text').val();
        var cell5 = $(element).find('td:eq(5)');
        var input_price = $(cell5).find('input:text').val();
        var cell6 = $(element).find('td:eq(6)');
        var input_discount = $(cell6).find('input:text').val();
        var cell7 = $(element).find('td:eq(7)');
        var input_total_price = $(cell7).find('input:text').val();
        //console.log('cell5 : ' + input_total_price);
        var obj_product = new Object();
        obj_product.pro_id = txt_id;
        obj_product.pro_code = txt_code;
        obj_product.pro_name = txt_name;
        obj_product.pro_nocount = input_nocount;
        obj_product.pro_type = input_type;
        obj_product.pro_price = input_price;
        obj_product.pro_discount = input_discount;
        obj_product.pro_total_price = input_total_price;
        return obj_product;
    }
    function remove_tr(element, id) {
        var parent_tr = $(element).parent().parent();
        console.log('element : ' + $(element).parent().parent());
        var obj_product = get_tr_value(parent_tr);
        var tr = $(element).closest('tr').remove();
        LIST_PRODUCT_REMOVE.push(obj_product);
        console.log('JSON.stringify(yourArray); ' + JSON.stringify(LIST_PRODUCT_REMOVE));
        console.log('LIST_PRODUCT_REMOVE SIZE : ' + LIST_PRODUCT_REMOVE.length);
    }
    function calculatePrice(element) {
        if (isInt(element)) {
            var parent_tr = $(element).parent().parent();
            var cell4 = $(parent_tr).find('td:eq(4)');
            var input_nocount = $(cell4).find('input:text').val();
            var cell5 = $(parent_tr).find('td:eq(5)');
            var input_price = $(cell5).find('input:text').val();
            if (isNaN(input_nocount))
                input_nocount = 0;
            if (isNaN(input_price))
                input_price = 0;
            var calPrice = parseInt(input_nocount) * parseInt(input_price);
            if (isNaN(calPrice))
                calPrice = 0;
            var cell7 = $(parent_tr).find('td:eq(7)');
            var object_totalprice = $(cell7).find('input:text');
            $(object_totalprice).val(calPrice);
            calculateTotalPrice();
        }
    }
    function calculateTotalPrice() {
        var totalPrcice = 0;
        $('#table_product tr').each(function(index, element) {
            var price = $(element).find('td:eq(7)').find('input:text').val();
            console.log('price : ' + price);
            totalPrcice = totalPrcice + parseInt(price);
        });
        $('#input-totalprice').val(totalPrcice);
        var element = $('#input-totalprice').val();
        getTextBath(element);
    }
    function getTextBath(price) {
        $.post('../database/db_bill_out.php?method=get_thaibath_text', {price: price}, function(data) {
            $('#label-price').text(data);
        });
    }
</script>