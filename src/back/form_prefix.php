<?php
include '../config/Connect.php';
$id = "";
$name = "";
$createdate = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM prefix WHERE pre_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['pre_id'];
    $name = $data['pre_name'];
    $createdate = $data['pre_createdate'];
}
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-prefix">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลคำนำหน้าชื่อ</legend>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อ</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อ" />
                </div>
            </div>                               
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <a class="uk-button uk-button-danger uk-button-large" href="index.php?page=manage_prefix">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-prefix').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true){
                    PostJson('frm-prefix', '../database/db_prefix.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
