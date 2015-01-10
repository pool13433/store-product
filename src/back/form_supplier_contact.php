﻿<?php
include '../config/Connect.php';
$id = "";
$code = "";
$name = "";
$desc = "";
$prefix = "";
$onwer = "";
$address = "";
$type = "";
$createdate = "";
$pid = "";
$telephone = "";
if (!empty($_GET['id'])) { // แก้ไข
    $sql = "SELECT * FROM store_contact WHERE store_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
   $id = $data['store_id']; 
    $code = $data['store_code'];
    $name = $data['store_name'];
    $desc = $data['store_desc'];
    $address = $data['store_address'];
    $type = $data['store_type'];
    $createdate = $data['store_createdate'];
    $pid = $data['store_pid'];
    $telephone = $data['store_telephone'];
}
//################# GENARATE CODE ############
if (empty($code)) {
    $sql = "SELECT store_code FROM store_contact ORDER BY store_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = substr($result['store_code'], 4);
    $code = 'SUP' . Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-store_contact">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลผู้จัดจำหน่าย</legend>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">รหัสผู้จัดจำหน่าย</label>
                <div class="uk-form-controls">
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
                    <?php $ListDay = List_Day(); ?>
                    <?php foreach ($ListDay as $key => $data): ?>
                        <input type="checkbox" name="group[group]" id="input-<?=$key?>" class="checkbox"
                               data-validation-engine="validate[minCheckbox[1]]"
                               data-errormessage-range-underflow="กรุณาเลือกอย่างน้อย 1 วัน" 
                               value="<?= $key ?>"/> <?=$data?>
                           <?php endforeach; ?>
                </div>
            </div>
        <div class="uk-form-row">
                <label for="input-onwer" class="uk-form-label">วันที่ส่งของ</label>
                <div class="uk-form-controls">
                    <?php $ListDay = List_Day(); ?>
                    <?php foreach ($ListDay as $key => $data): ?>
                        <input type="checkbox" name="group[group]" id="input-<?=$key?>" class="checkbox"
                               data-validation-engine="validate[minCheckbox[1]]"
                               data-errormessage-range-underflow="กรุณาเลือกอย่างน้อย 1 วัน" 
                               value="<?= $key ?>"/> <?=$data?>
                           <?php endforeach; ?>
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
                    <input type="text" name="telephone" id="input-telephone" value="<?= $telephone ?>" 
                           />
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
                    <button class="uk-button uk-button-danger uk-button-large" type="button">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-store_contact').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true)
                    PostJson('frm-store_contact', '../database/db_store_contact.php?method=create');
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>