<?php include '../config/Connect.php'; ?>
<?php
@session_start();
$id = "";
$tax_code = "";
$Invoices_code = "";
$in_date = "";
$sup_id = "";
$sup_code = "";
$sup_name = "";
$sup_onwer = "";
$sup_address = "";
$doc_code = "";
$doc_date = "";
$pay_condition = "";
$finfish_date = "";
$pay_code = "";
$sales_name = "";
$location = "";

$weight = "";
$pricebeforevat = "";
$vat = "";
$priceaftervat = "";
$sender_name = "";
$receiver_name = "";
$autherized_name = "";
$bill_status_1 = '';
$bill_status_2 = '';
$bill_status_3 = '';
$bill_status_4 = '';
$bill_status_5 = '';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bill_in bi";
    $sql .= " LEFT JOIN supplier_contact sc ON sc.sup_id = bi.sup_id";
    $sql .= " WHERE billin_id = $id";
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['billin_id'];
    $tax_code = $data['billin_taxcode'];
    $Invoices_code = $data['billin_invoicescode'];
    $in_date = $data['billin_indate'];
    $sup_id = $data['sup_id'];
    $sup_code = $data['sup_code'];
    $sup_name = $data['sup_name'];
    $sup_onwer = $data['sup_desc'];
    $sup_address = $data['sup_address'];
    $doc_code = $data['billin_doccode'];
    $doc_date = $data['billin_docdate'];
    $pay_condition = $data['pay_id'];
    $finfish_date = $data['billin_finishdate'];
    $pay_code = $data['billin_paycode'];
    $sales_name = $data['sales_name'];
    $location = $data['billin_localtioncode'];
    $weight = $data['billin_weight'];
    $pricebeforevat = $data['billin_pricebeforevat'];
    $vat = $data['billin_vat'];
    $priceaftervat = $data['billin_priceaftervat'];
    $sender_name = $data['billin_sender'];
    $receiver_name = $data['billin_receiver'];
    $autherized_name = $data['billin_autherized'];
    //############### status #########
    switch ($data['billin_status']) {
        case 1:
            $bill_status_1 = 'checked';
            break;
        case 2:
            $bill_status_2 = 'checked';
            break;
        case 3:
            $bill_status_3 = 'checked';
            break;
        case 4:
            $bill_status_4 = 'checked';
            break;
        case 5:
            $bill_status_5 = 'checked';
            break;
        default:
            break;
    }
    //############### status #########
}
$person = $_SESSION['person'];
//################# GENARATE CODE ############
if (empty($Invoices_code)) {
    $sql_gen = "SELECT billin_invoicescode FROM bill_in ORDER BY billin_invoicescode DESC LIMIT 0,1";
    $query_gen = mysql_query($sql_gen) or die(mysql_error());
    $result = mysql_fetch_assoc($query_gen);
    $last_code = substr($result['billin_invoicescode'], 4);
    $Invoices_code = Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>
<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-bill_in">        
        <div class="uk-panel">
            <div class="uk-panel-badge uk-badge">...</div>
            <!-- <h3 class="uk-panel-title">เพิ่มข้อมูลสำคัญ</h3>        -->
            <fieldset data-uk-margin>
                <legend>ข้อมูลนำเข้าสินค้า</legend>
                <fieldset data-uk-margin>
                    <legend>ข้อมูลใบส่งสินค้า/ใบกำกับภาษี</legend>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label class="uk-form-label">เลขที่ใบกำกับภาษี</label>
                                <div class="uk-form-controls">
                                    <input type="hidden" name="bill_id" id="bill_id" value="<?= $id ?>"/>
                                    <input type="text" name="tax_code" value="<?= $tax_code ?>"
                                           class="uk-form-danger"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก เลขใบกำกับภาษี"
                                           />
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label class="uk-form-label">เลขที่ใบแจ้งหนี้</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="Invoices_code"
                                           class="" value="<?= $Invoices_code ?>"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก เลขใบใบแจ้งหนี้"/>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label class="uk-form-label">วันที่รับสินค้า</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="in_date"  value="<?= change_dateYMD_TO_DMY($in_date) ?>"
                                           class="uk-form-danger uk-width-3-5"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก วันที่รับเข้า"
                                           readonly data-uk-datepicker="{format:'DD/MM/YYYY'}">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset data-uk-margin>
                    <legend>ซื้อจาก</legend>
                    <div class="uk-form-row">
                        <label for="input-sup_code" class="uk-form-label">รหัสผู้จัดจำหน่าย</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="sup_id" id="input-sup_id" value="<?= $sup_id ?>"/>
                            <input type="text" name="sup_name" id="input-sup_code" class="uk-form-danger" value="<?= $sup_code ?>" readonly/>
                            <a type="button" class="uk-button uk-button-primary" href="#dialog-search_supplier_contact" data-uk-modal ><i class="uk-icon-search-plus"></i>ค้นหา</a>                            
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label for="input-sup_onwer" class="uk-form-label">ชื่อร้าน/ชื่อบริษัท</label>
                        <div class="uk-form-controls">
                            <input type="text" name="fname" id="input-sup_onwer" value="<?= $sup_onwer ?>"/>
                        </div>                   
                    </div>                                  
                    <div class="uk-form-row">
                        <label for="input-sup_address" class="uk-form-label">ที่อยู่ผู้จัดจำหน่าย</label>
                        <div class="uk-form-controls">
                            <textarea  rows="1" cols="100" name="sup_address" id="input-sup_address"><?= $sup_address ?></textarea>
                        </div>
                    </div>    
                </fieldset>
                <fieldset data-uk-margin>
                    <legend>ข้อมูลเอกสาร</legend>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-doc_code" class="uk-form-label">อ้างถึงเลขที่เอกสารลูกค้า</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="doc_code" id="input-doc_code" value="<?= $doc_code ?>" class="uk-form-danger"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก อ้างถึงเลขที่เอกสารลูกค้า" />
                                </div>                   
                            </div>
                        </div>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-doc_date" class="uk-form-label">อ้างถึงวันที่เอกสารของลูกค้า</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="doc_date" id="input-doc_date" value="<?= change_dateYMD_TO_DMY($doc_date) ?>"
                                           required class="uk-form-danger uk-width-3-5"
                                           readonly data-uk-datepicker="{format:'DD/MM/YYYY'}"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก อ้างถึงวันที่เอกสารของลูกค้า" />
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-fname" class="uk-form-label">เงื่อนไขการชำระเงิน</label>
                                <div class="uk-form-controls">
                                    <?php $query_pay = mysql_query("SELECT * FROM pay_condition") or die(mysql_error()); ?>
                                    <select id="form-s-s" name="pay_condition" class="uk-form-danger">                        
                                        <?php while ($row_pay = mysql_fetch_array($query_pay)) : ?>
                                            <?php if ($pay_condition == $row_pay['pay_id']): ?>
                                                <option value="<?= $row_pay['pay_id'] ?>" selected><?= $row_pay['pay_name'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $row_pay['pay_id'] ?>"><?= $row_pay['pay_name'] ?></option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>                   
                            </div>
                        </div>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-finfish_date" class="uk-form-label">วันครบกำหนด</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="finfish_date" id="input-finfish_date"  value="<?= change_dateYMD_TO_DMY($finfish_date) ?>"
                                           class="uk-form-danger uk-width-3-5"
                                           readonly data-uk-datepicker="{format:'DD/MM/YYYY'}"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก วันครบกำหนด" />
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-pay_code" class="uk-form-label">เลขที่ใบสั่งขาย</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="pay_code" id="input-pay_code" value="<?= $pay_code ?>"
                                           class="uk-form-danger"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก เลขที่ใบสั่งขาย" />
                                </div>                   
                            </div>
                        </div>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-sales_name" class="uk-form-label">พนักงานขาย</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="sales_name" id="input-sales_name"  value="<?= $sales_name ?>"
                                           class="uk-form-danger"/>
<!--                                    <button class="uk-button uk-button-primary"><i class="uk-icon-search-plus"></i> ค้นหา</button>
                                    <input type="text" name="officer_code" id="input-officer_code"
                                           class="uk-width-5-10"/>-->
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-location" class="uk-form-label">สถานที่จ่ายสินค้า</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="location" id="input-location" value="<?= $location ?>"
                                           class="uk-form-danger"
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก สถานที่จ่ายสินค้า" />
                                </div>                   
                            </div> 
                        </div>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <label for="input-location" class="uk-form-label">แนบไฟล์เอกสาร</label>
                                <div class="uk-form-controls">
                                    <input type="file" name="file" id="input-location" value="<?= $file ?>"
                                           class="uk-form-success"/>
                                </div>                   
                            </div> 
                        </div>
                    </div>
                </fieldset>
                </li>
                <!-- ########## TAB 1#############-->                   
                </ul>                                                          
            </fieldset>

        </div>
        <div class="uk-panel"><br/><br/>
            <!--<div class="uk-panel-badge uk-badge" id="my-2">เปิด</div>-->
            <h3 class="uk-panel-title"><legend>ข้อมูลรายการสินค้าเข้า</legend></h3>
            <fieldset data-uk-margin>
                <legend>สินค้าเข้า</legend>                  
                <div class="uk-grid">
                    <?php if ($person['per_status'] == '1'): ?>
                        <div class="uk-width-5-10">
                            <div class="uk-form-row">
                                <a class="uk-button uk-button-primary" href="#dialod-search_product" 
                                   data-uk-modal id="btn-search_product" onclick="loadDialogDataTable()">
                                    <i class="uk-icon-search-plus" ></i> ค้นหาสินค้า</a> 
                                <a class="uk-button uk-button-success" href="#dialod-new_product" data-uk-modal onclick="loadDialogNewProduct()">
                                    <i class="uk-icon-search-plus" ></i> สร้างสินค้าใหม่</a>
                            </div> 
                        </div>
                    <?php endif; ?>
                    <div class="uk-width-5-10" style="text-align: right">
                        <div class="uk-alert uk-alert-close">
                            <h3>เจ้าหน้าที่บันทึกข้อมูล <?= $_SESSION['person']['per_fname'] . "  " . $_SESSION['person']['per_lname'] ?></h3>                            
                        </div>                        
                    </div>
                </div>
                <div class="uk-form-row">
                    <table class="uk-table uk-table-condensed">
                        <thead>
                            <tr>
                                <th>รหัสสินค้า</th>
                                <th>รายการสินค้า</th>
                                <th>ชนิด</th>
                                <th>จำนวนในบิล</th>
                                <th>จำนวนนับจริง</th>
                                <th>สาเหตุ</th>                                        
                                <th>ราคา</th>
                                <th>ส่วนลด</th>
                                <th>จำนวนเงิน</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="table_product"></tbody>
                    </table>
                </div>                 
            </fieldset>
            <div class="uk-grid">
                <div class="uk-width-5-10" style="text-align: left">
                    <div class="uk-form-row">
                        <label class="uk-form-label">น้ำหนักสินค้ารวม</label>
                        <input type="text" name="weight" id="input-weight" value="<?= $weight ?>"
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก น้ำหนักสินค้ารวม"/>
                    </div>
                </div>
                <div class="uk-width-5-10" style="text-align: right">
                    <div class="uk-form-row">
                        <label class="uk-form-label">มูลค่าสินค้าก่อนภาษี</label>
                        <input type="text" name="pricebeforevat" id="input-beforeprice" value="<?= $pricebeforevat ?>" 
                               readonly
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก มูลค่าสินค้าก่อนภาษี"/>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">จำนวนภาษีมูลค่าเพิ่ม 7%</label>
                        <input type="text" name="vat" id="input-vat" onchange="calculateVat(this)" value="<?= $vat ?>"
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก จำนวนภาษีมูลค่าเพิ่ม 7%"/>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">จำนวนเงินรวมทั้งสิ้น</label>
                        <input type="text" name="priceaftervat" id="input-afterprice" value="<?= $priceaftervat ?>"
                               readonly/>
                    </div>
                </div>
            </div>
            <div class="uk-grid">
                <div class="uk-width-1-3">
                    <div class="uk-form-row">
                        <label for="input-location" class="uk-form-label">ผู้รับสินค้า</label>
                        <input type="text" class="uk-form-danger uk-width-9-10" name="receiver_name" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก ผู้รับสินค้า"
                               value="<?= $receiver_name ?>"/>                  
                    </div> 
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label">ผู้ส่งสินค้า</label>
                    <input type="text" class="uk-form-danger uk-width-9-10" name="sender_name" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ผู้ส่งสินค้า"
                           value="<?= $sender_name ?>"/>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label">ผู้รับมอบอำนาจ</label>
                    <input type="text" class="uk-form-danger uk-width-9-10" name="autherized_name" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ผู้รับมอบอำนาจ"
                           value="<?= $autherized_name ?>"/>
                </div>
            </div>
            <hr/>
            <!-- สำหรับ เจ้าของร้าน เท่านั้น ฉะนั้น จะแสดงเมื่อ คลิกมาจาก ปุ่มแก้ไข-->
            <?php if ($person['per_status'] == '1'): ?>
                <div class="uk-grid">
                    <div class="uk-width-4-4">
                        <div class="uk-form-row">
                            <input type="checkbox" class="uk-form-danger uk-width-9-10" 
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก เลือก"
                                   name="approve" <?= $bill_status_1 ?> value="1"/>                  
                            รออนุมัติการรับของเข้าคลังสินค้า [ผ่านการตรวจรับจากพนักงานประจาโกดังแล้ว]
                        </div> 
                    </div>
                </div>
                <hr/>
            <?php elseif ($person['per_status'] == '2'): ?>
                <div class="uk-grid">
                    <div class="uk-width-4-4">
                        <div class="uk-form-row">
                            <input type="checkbox" class="uk-form-danger uk-width-9-10" 
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก เลือก"
                                   name="approve" <?= $bill_status_2 ?> value="2"/>                  
                            รออนุมัติการรับของเข้าคลังสินค้า [ผ่านการสอบจากพนักงานประจาหน้าร้านแล้ว]
                        </div> 
                    </div>
                </div>                
            <?php elseif ($person['per_status'] == '3'): ?>
                <div class="uk-grid">
                    <div class="uk-width-4-4">
                        <div class="uk-form-row">
                            <input type="radio" class="uk-form-danger uk-width-9-10" 
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก เลือก"
                                   name="approve" <?= $bill_status_3 ?> value="3"/>                  
                            อนุมัติการรับของเข้าคลังสินค้า ผ่าน (ถ้าเลือกแล้วจะไม่สามารถ ปรับแกไข้ ใบบิลได้อีก)
                        </div> 
                    </div>
                </div>
                <hr/>
                <div class="uk-grid">
                    <div class="uk-width-4-4">
                        <div class="uk-form-row">                            
                            <input type="radio" class="uk-form-danger uk-width-9-10" 
                                   data-validation-engine="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก เลือก"
                                   name="approve" <?= $bill_status_4 ?> value="4"/>                  
                            อนุมัติการรับของเข้าคลังสินค้า ไม่ผ่าน (ถ้าเลือกแล้วจะไม่สามารถ ปรับแกไข้ ใบบิลได้อีก)
                        </div> 
                    </div>
                </div> 
            <?php endif; ?>
            <?php if ($person['per_status'] == '2' || $person['per_status'] == '3'): ?>
                <div class="uk-grid">
                    <div class="uk-width-4-4">
                        <div class="uk-form-row">          
                            <label for="input-location" class="uk-form-label">หมายเหตุ</label>
                            <textarea  rows="2" style="width: 100%" name="remark" id="input-remark" 
                                       data-validation-engine="validate[required]"
                                       data-errormessage-value-missing="เหตุผล" 
                                       ></textarea>
                        </div> 
                    </div>
                </div> 
            <?php endif; ?>    
            <div class="uk-grid">
                <div class="uk-width-3-4">
                    <div class="uk-form-row">
                        <div class="uk-form-controls" style="text-align: center">
                            <button class="uk-button uk-button-primary uk-button-large" id="btn-save" type="submit">
                                <i class="uk-icon-save"></i> ยืนยัน
                            </button>                            
                            <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_bill_in">
                                <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                            </a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
    </form>
</div>
<?php include './dialog_search_product_main.php'; ?>
<?php include './dialog_new_product.php'; ?>
<?php include './dialog_search_supplier_contact.php'; ?>
<script type="text/javascript">
    var LIST_PRODUCT_REMOVE = new Array();
    $(document).ready(function() {

        //############# checkbox approve ############
        checkbox_approve('approve', 'btn-save');
        //############# checkbox approve ############

        var valid = $('#frm-bill_in').validationEngine('attach', {
            promptPosition: "centerTop",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    console.log('save.....');
                    //PostJson('frm-bill_in', '../database/db_bill_in.php?method=create');
                    $.ajax({
                        url: '../database/db_bill_in.php?method=create',
                        data: {
                            form: JSON.stringify(getFormData('frm-bill_in')), //JSON.stringify($('#frm-bill_in').serializeArray()),
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
            url: '../database/db_bill_in.php?method=get_pro_product_by_biil_id',
            data: {bill_id: $('#bill_id').val()},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(index, object) {
                    //select_product(object.pro_code, object.pro_name);
                    var tr = '<tr>';
                    tr += '<td style="width:10%"><input type="hidden" name="id" value="' + object.billinpro_id + '"/>' + object.pro_code + '</td>';
                    tr += '<td style="width:8%">' + object.pro_name + '</td>';
                    tr += '<td style="width:5%">' + object.type_name + '</td>';
                    tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchasup_codenge="isInt(this)" value="' + object.billinpro_noinbill + '"/></td>';
                    tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" value="' + object.billinpro_nocount + '"/></td>';
                    tr += '<td><input type="text" class="uk-width-small-9-10" value="' + object.billinpro_remark + '"/></td>';
                    tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="calculatePrice(this)" value="' + object.pro_unitprice_buy + '"/></td>';
                    tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10 uk-form-danger" onchange="isInt(this)" value="' + object.pro_discount + '"/></td>';
                    tr += '<td style="width:8%"><input type="text" class="uk-width-small-9-10" onchange="calculateTotalPrice()" value="' + object.billinpro_totalprice + '"/></td>';
                    tr += '<td><button type="button" class="uk-button uk-button-mini uk-button-danger" onclick="remove_tr(this,' + object.billinpro_id + ')"><i class="uk-icon-trash-o"></i>ลบ</button></td>';
                    tr += '</tr>';
                    $('#table_product').append(tr);
                    calculateTotalPrice();
                });
                appendDropdownProductType();
            }
        });
        //#############LOAD PRODUCT ###########
        // ############ LOAD EDIT FROM ##########
    });
    function loadDialogDataTable() {
        $('#content-product').load('load_product.php');
    }
    function loadDialogNewProduct() {
        $('#frm-product')[0].reset();
    }
    function checkbox_approve(checkbox_name, button_id) {
        var checkbox_status = $('input[name=' + checkbox_name + ']').is(':checked');
        if (checkbox_status) {
            $('#' + button_id).attr('disabled', false);
        }
        $('input[name=' + checkbox_name + ']').on('click', function() {
            if (this.checked)
                $('#' + button_id).attr('disabled', false);
            else
                $('#' + button_id).attr('disabled', true);
        });
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
        var input_noinbill = $(cell3).find('input:text').val();
        var cell4 = $(element).find('td:eq(4)');
        var input_nocount = $(cell4).find('input:text').val();
        var cell5 = $(element).find('td:eq(5)');
        var input_remark = $(cell5).find('input:text').val();
        var cell6 = $(element).find('td:eq(6)');
        var input_price = $(cell6).find('input:text').val();
        var cell7 = $(element).find('td:eq(7)');
        var input_discount = $(cell7).find('input:text').val();
        var cell8 = $(element).find('td:eq(8)');
        var input_total_price = $(cell8).find('input:text').val();
        //console.log('cell5 : ' + input_total_price);
        var obj_product = new Object();
        obj_product.pro_id = txt_id;
        obj_product.pro_code = txt_code;
        obj_product.pro_name = txt_name;
        obj_product.pro_noinbill = input_noinbill;
        obj_product.pro_nocount = input_nocount;
        obj_product.pro_remark = input_remark;
        obj_product.pro_type = input_type;
        obj_product.pro_price = input_price;
        obj_product.pro_discount = input_discount;
        obj_product.pro_total_price = input_total_price;
        return obj_product;
    }
    function search_supplier() {
        var sup_id = $('#input-sup_id');
        var sup_code = $('#input-sup_code');
        var sup_onwer = $('#input-sup_onwer');
        var sup_address = $('#input-sup_address');
        $.ajax({
            url: '../database/db_sup_contact.php?method=searchsupplier',
            data: {code: sup_code.val()},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.status != 'fail') {
                    sup_id.val(data.sup_id);
                    sup_code.val(data.sup_code);
                    sup_onwer.val(data.sup_onwer);
                    sup_address.val(data.sup_address);
                } else {
                    uk_notify('ไม่พบข้อมูลที่ค้นหา', 'danger', 3);
                    sup_id.val("");
                    //sup_code.val("");
                    sup_onwer.val("");
                    sup_address.val("");
                }
            }
        });
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
            var cell6 = $(parent_tr).find('td:eq(6)');
            var input_price = $(cell6).find('input:text').val();
            if (isNaN(input_nocount))
                input_nocount = 0;
            if (isNaN(input_price))
                input_price = 0;
            var calPrice = parseInt(input_nocount) * parseInt(input_price);
            if (isNaN(calPrice))
                calPrice = 0;
            var cell8 = $(parent_tr).find('td:eq(8)');
            var object_totalprice = $(cell8).find('input:text');
            $(object_totalprice).val(calPrice);
            calculateTotalPrice();
        }
    }
    function calculateTotalPrice() {
        var totalPrcice = 0;
        $('#table_product tr').each(function(index, element) {
            var price = $(element).find('td:eq(8)').find('input:text').val();
            //console.log('price : ' + price);
            totalPrcice = totalPrcice + parseInt(price);
        });
        $('#input-beforeprice').val(totalPrcice);
    }
    function calculateVat(element) {
        if (isInt(element)) {
            var beforeprice = $('#input-beforeprice').val();
            var vat = $('#input-vat').val();
            var calVat = ((beforeprice * vat) / 100);
            var afterprice = parseInt(beforeprice) + parseInt(calVat);
            $('#input-afterprice').val(afterprice);
        }
    }
</script>

