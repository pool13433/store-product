<?php
include '../config/Connect.php';
$id = "";
$name = "";
$time = "";
$createdate = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM pay_condition WHERE pay_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['pay_id'];
    $name = $data['pay_name'];
    $time = $data['pay_time'];
    $createdate = $data['pay_createdate'];
}
?>
<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-pay_codition">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลเงื่อนไขการชำระเงิน</legend>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อระยะเวลาการชำระเงิน</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           class="uk-width-8-10"
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อกลุ่ม" />
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-time" class="uk-form-label">ระยะเวลา/วัน</label>
                <div class="uk-form-controls">
                    <input type="text" name="time" id="input-time" value="<?= $time ?>" 
                           class="uk-width-1-10"
                           data-validation-engine="validate[required,custom[number]]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อกลุ่ม"
                           data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"
                           />
                </div>
            </div>                                 
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary uk-button-large" type="submit">
                            <i class="uk-icon-save"></i> บันทึก
                        </button>
                        <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_pay_condition">
                            <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                        </a>
                    </div>
                </div>                
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-pay_codition').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true) {
                    PostJson('frm-pay_codition', '../database/db_pay_condition.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
