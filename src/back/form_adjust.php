<?php
include '../config/Connect.php';
$id = "";
$adj_product_lastamount = "";
$pro_amount = "";
$pro_id = "";
$pro_name = "";
$adj_adjust_no = "";
$adj_remark = "";
$adjust_type = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM adjust ad";
    $sql .= " LEFT JOIN product p ON p.pro_id = ad.pro_id";
    $sql .= " WHERE  ad.adj_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);

    $id = $data['adj_id'];
    $adj_product_lastamount = $data['adj_product_lastamount'];
    $adj_adjust_no = $data['adj_adjust_no'];
    $$pro_amount = $data['pro_amount'];
    $pro_name = $data['pro_name'];
    $pro_id = $data['pro_id'];
    $adj_remark = $data['adj_remark'];
    $adjust_type = $data['adj_type'];
}
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-adjust">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลสินค้า</legend>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">จำนวนคงเหลือ</label>
                <input type="hidden" name="id" id="input-id" value="<?= $id ?>" />
                <input type="hidden" name="pro_id" id="input-pro_id" value="<?= $pro_id ?>" />
                <input type="hidden" name="pro_amount" id="input-amount" value="<?= $pro_amount ?>" readonly/>
                <input type="text" name="adj_product_lastamount" id="input-amount" value="<?= $adj_product_lastamount ?>" readonly/>
                <input type="text" name="pro_name" id="input-name" value="<?= $pro_name ?>" readonly/>
            </div>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">ประเภท</label>
                <?php include '../config/dropdown_adjust_type.php'; ?>
            </div>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">จำนวนที่ปรับ</label>
                <input type="hidden" name="adj_no_old" value="<?= $adj_adjust_no ?>"/>
                <input type="text" name="adj_no" id="input-name" class="validate[required]"
                       data-errormessage-value-missing="กรุณากรอก จำนวนที่ปรับ" value="<?= $adj_adjust_no ?>"/>
            </div>
            <div class="uk-form-row">
                <label for="input-remark" class="uk-form-label">เหตุผล/หมายเหตุ</label>
                <textarea  rows="5" cols="60" name="adj_remark" id="input-remark" 
                           class="validate[required]"
                           data-errormessage-value-missing="คำอธิบาย" 
                           ><?= $adj_remark ?></textarea>
            </div>     
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <a class="uk-button uk-button-danger uk-button-large uk-modal-close" href="index.php?page=manage_adjust&id=<?= $pro_id ?>">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก/ปิด
                    </a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-adjust').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true) {
                    PostJson('frm-adjust', '../database/db_adjust.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
