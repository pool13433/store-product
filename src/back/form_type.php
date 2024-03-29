<?php
@session_start();
include '../config/Connect.php';
$id = "";
$name= "";
$desc = "";
$createdate = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM type WHERE type_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['type_id'];
    $name = $data['type_name'];
    $desc = $data['type_desc'];    
    $createdate = $data['type_createdate'];
}
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-type">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลชนิดสินค้า</legend>            
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อชนิดสินค้า</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชนิดสินค้า" />
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-desc" class="uk-form-label">อธิบาย</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="desc" id="input-desc" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="คำอธิบาย" 
                               ><?= $desc ?></textarea>
                </div>
            </div>                                 
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_type">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-type').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true)
                    PostJson('frm-type', '../database/db_type.php?method=create');
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>