<?php
include '../config/Connect.php';
$id = '';
$code = '';
$name = '';
$desc = '';
$orderday = '';
$deliveryday = '';
$address = '';
$telephone = '';
$fax = '';
$createdate = '';
$createby = '';
$updatedate = '';
$updateby = '';
if (!empty($_GET['id'])) { // แก้ไข
    $sql = "SELECT * FROM supplier_contact WHERE sup_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['sup_id'];
    $code = $data['sup_code'];
    $name = $data['sup_name'];
    $desc = $data['sup_desc'];
    $address = $data['sup_address'];
    $orderday = $data['sup_orderday'];
    $deliveryday = $data['sup_deliveryday'];
    $createdate = $data['sup_createdate'];
    $telephone = $data['sup_telephone'];
    $fax = $data['sup_fax'];
}
//################# GENARATE CODE ############
if (empty($code)) {
    $sql = "SELECT sup_code FROM supplier_contact ORDER BY sup_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = substr($result['sup_code'], 4);
    $code = 'SUP' . Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-sup_contact">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลผู้จัดจำหน่าย</legend>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">รหัสผู้จัดจำหน่าย</label>
                <div class="uk-form-controls">
                    <input type="text" name="id" id="input-id" value="<?= $id ?>"/>
                    <input type="text" name="code" id="input-code" value="<?= $code ?>" readonly/>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อร้าน/ชื่อบริษัท</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อร้าน" />
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-desc" class="uk-form-label">รายละเอียดการจัดจำหน่าย</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="desc" id="input-desc" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="คำอธิบาย" 
                               ><?= $desc ?></textarea>
                </div>
            </div>    

            <div class="uk-form-row">
                <label for="input-onwer" class="uk-form-label">วันที่สั่งของ</label>
                <div class="uk-form-controls">
                    <?php $ListOrderDay = List_Day(); ?>
                    <select name="orderday" class="mutiselect validate[required]" id="combo-orderday" multiple>
                        <option value=""></option>
                        <?php foreach ($ListOrderDay as $key => $data): ?>
                            <option value="<?= $key ?>"><?= $data ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="hidden-orderday" id="hidden-orderday"
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณาเลือก วัน" />
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-onwer" class="uk-form-label">วันที่ส่งของ</label>
                <div class="uk-form-controls">
                    <?php $ListDeliverDay = List_Day(); ?>
                    <select name="orderday" class="mutiselect" id="combo-deliveryday" multiple>
                        <option value=""></option>
                        <?php foreach ($ListDeliverDay as $key => $data): ?>
                            <option value="<?= $key ?>"><?= $data ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="hidden-deliveryday" id="hidden-deliveryday"
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณาเลือก วัน" />
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-address" class="uk-form-label">ที่อยู่</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="address" id="input-address" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก ที่อยู่ร้าน" 
                               ><?= $address ?></textarea>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">Tel.</label>
                <div class="uk-form-controls">
                    <input type="text" name="telephone" id="input-telephone" value="<?= $telephone ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก เบอร์โทรศัพท์" />
                </div>
            </div>  
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">Fax.</label>
                <div class="uk-form-controls">
                    <input type="text" name="fax" id="input-fax" value="<?= $fax ?>" />
                </div>
            </div>  

            <!--<div class="uk-form-row">
                <label class="uk-form-label" for="form-s-s">กลุ่ม/ประเภท</label>
                <div class="uk-form-controls">
            <?php $listStoreContact = List_StoreContactStatus(); ?>
                    <select id="form-s-s" name="type">                        
            <?php foreach ($listStoreContact as $key => $data): ?>
                <?php if ($status == $key): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="<?= $key ?>" selected><?= $data ?></option>
                <?php else : ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="<?= $key ?>"><?= $data ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
                    </select>
                </div>
            </div>-->
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_supplier_contact">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var selectDelivery = $('#combo-deliveryday').select2();
        var selectOrderday = $('#combo-orderday').select2();

        // ################ load default data ######
        var edit_id = $('#input-id').val();
        if (edit_id != '') {
            $.post('../database/db_supplier_contact.php?method=set_default',
                    {
                        id: edit_id,
                        field: 'sup_orderday'
                    }, function(defaultData) {
                selectOrderday.select2("data", defaultData);
                $('#hidden-orderday').val(selectOrderday.select2('val'));
            }, 'json');
            $.post('../database/db_supplier_contact.php?method=set_default',
                    {
                        id: edit_id,
                        field: 'sup_deliveryday'
                    }, function(defaultData) {
                selectDelivery.select2("data", defaultData);
                $('#hidden-deliveryday').val(selectDelivery.select2('val'));
            }, 'json');
        }
        // ################ load default data ######

        var valid = $('#frm-sup_contact').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true)
                    PostJson('frm-sup_contact', '../database/db_supplier_contact.php?method=create');
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
        // #############mutiselect ############
        // url : http://select2.github.io/select2/
        selectOrderday.select2({
            placeholder: "-- คลิกเลือกวันที่รับของ --",
            allowClear: true,
            closeOnSelect: true,
            //tags: true,
            width: '70%',
//            'select2-selecting' : function(e){
//                alert('value '+select2.select2('val'));
//            }
        }).on("select2-open", function() {
            $('#hidden-orderday').val(selectDelivery.select2('val'));
        }).on("select2-selecting", function(e) {
            //alert('value ' + select2.select2('val'));
            $('#hidden-orderday').val(e.val);
        }).on("change", function(e) {
            //alert('value ' + select2.select2('val'));
            $('#hidden-orderday').val(e.val);
        });


        selectDelivery.select2({
            placeholder: "-- คลิกเลือกวันที่ส่งของ --",
            allowClear: true,
            closeOnSelect: true,
            //tags: true,
            width: '70%',
        }).on("select2-open", function() {
            $('#hidden-deliveryday').val(selectDelivery.select2('val'));
        }).on("select2-selecting", function(e) {
            //alert('value ' + select2.select2('val'));
            $('#hidden-deliveryday').val(e.val);
        }).on("change", function(e) {
            //alert('value ' + select2.select2('val'));
            $('#hidden-deliveryday').val(e.val);
        });
        // #############mutiselect ############
    });
</script>