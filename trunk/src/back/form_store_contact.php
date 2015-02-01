<?php
include '../config/Connect.php';
$id = "";
$code = "";
$name = "";
$desc = "";
$prefix = "";
$onwer = "";
$pid = "";
$address = "";
$telephone = "";
$createdate = "";
$createby = '';
$updatedate = "";
$updateby = '';
if (!empty($_GET['id'])) { // แก้ไข
    $sql = "SELECT * FROM store_contact WHERE sto_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['sto_id'];
    $code = $data['sto_code'];
    $name = $data['sto_name'];
    $desc = $data['sto_desc'];
    $prefix = $data['pre_id'];
    $onwer = $data['sto_onwer'];
    $address = $data['sto_address'];
    $createdate = $data['sto_createdate'];    
    $telephone = $data['sto_telephone'];
}
//################# GENARATE CODE ############
if (empty($code)) {
    $sql = "SELECT sto_id FROM store_contact ORDER BY sto_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = $result['sto_id'];
    $code = 'CUS' . Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-store_contact">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลลูกค้า</legend>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">รหัสลูกค้า</label>
                <div class="uk-form-controls">
                    <input type="text" name="code" id="input-code" value="<?= $code ?>" readonly/>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อร้าน</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อร้าน" />
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-desc" class="uk-form-label">รายละเอียดร้านค้า</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="desc" id="input-desc" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="คำอธิบาย" 
                               ><?= $desc ?></textarea>
                </div>
            </div>    
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">คำนำหน้าชื่อ</label>
                <div class="uk-form-controls">
                    <?php include '../config/dropdown_prefix.php'; ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-onwer" class="uk-form-label">ชื่อเจ้าของร้าน</label>
                <div class="uk-form-controls">
                    <input type="text" name="onwer" id="input-onwer" value="<?= $onwer ?>"
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อเจ้าของร้าน"/>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">รหัสบัตรประชาชน</label>
                <div class="uk-form-controls">                    
                    <input type="text" name="pid" id="input-pid" value="<?= $pid ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก รหัสบัตรประชาชน" />
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
                <label for="input-name" class="uk-form-label">เบอร์โทรศัพท์</label>
                <div class="uk-form-controls">
                    <input type="text" name="telephone" id="input-telephone" value="<?= $telephone ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก เบอร์โทรศัพท์" />
                </div>
            </div>              
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_store_contact">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </a>
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