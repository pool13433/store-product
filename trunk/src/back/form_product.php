<?php
include '../config/Connect.php';
$id = "";
$name = "";
$desc = "";
$type = "";
$cat_id = "";
$price = "";
$discount = "";
$amount = "";
$createdate = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM product WHERE pro_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['pro_id'];
    $code = $data['pro_code'];
    $name = $data['pro_name'];
    $desc = $data['pro_desc'];
    $type = $data['type_id'];
    $cat_id = $data['cat_id'];
    $price = $data['pro_unitprice'];
    $discount = $data['pro_discount'];
    $amount = $data['pro_amount'];
    $createdate = $data['pro_createdate'];
}
//################# GENARATE CODE ############
if (empty($code)) {
    $sql = "SELECT pro_code FROM product ORDER BY pro_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = substr($result['pro_code'], 4);
    $code = 'ITEM'.Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-product">        
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลสินค้า</legend>
            <div class="uk-form-row">
                <label for="input-code" class="uk-form-label">รหัสสินค้า</label>
                <div class="uk-form-controls">
                    <input type="text" name="code" id="input-code" value="<?= $code ?>" readonly/>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-name" class="uk-form-label">ชื่อสินค้า</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="text" name="name" id="input-name" value="<?= $name ?>" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อกลุ่ม" />
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-desc" class="uk-form-label">รายละเอียดสินค้า</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="desc" id="input-desc" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="คำอธิบาย" 
                               ><?= $desc ?></textarea>
                </div>
            </div>   
            <div class="uk-form-row">
                <label for="input-amount" class="uk-form-label">จำนวน</label>
                <div class="uk-form-controls">
                    <input type="text" name="amount" id="input-amount" value="<?= $amount ?>" 
                           data-validation-engine="validate[required,custom[number]]"
                           data-errormessage-value-missing="กรุณากรอก จำนวน"
                           data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/>
                </div>
            </div> 
            <div class="uk-form-row">
                <label class="uk-form-label" for="form-s-s">ชนิด</label>
                <div class="uk-form-controls">
                    <?php
                    $sql_type = "SELECT * FROM type ORDER BY type_name ASC";
                    $query_type = mysql_query($sql_type) or die(mysql_error());
                    ?>
                    <select id="select-type" name="type">                        
                        <?php while ($row_type = mysql_fetch_array($query_type)): ?>
                            <?php if ($type == $row_type['type_id']): ?>
                                <option value="<?= $row_type['type_id'] ?>" selected><?= $row_type['type_name'] ?></option>
                            <?php else : ?>
                                <option value="<?= $row_type['type_id'] ?>"><?= $row_type['type_name'] ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="form-s-s">กลุ่ม</label>
                <div class="uk-form-controls">
                    <?php
                    $sql_category = "SELECT * FROM category ORDER BY cat_name DESC";
                    $query_category = mysql_query($sql_category) or die(mysql_error());
                    ?>
                    <select id="select-cat" name="cat_id">                        
                        <?php while ($row_cat = mysql_fetch_array($query_category)): ?>
                            <?php if ($cat_id == $row_cat['cat_id']): ?>
                                <option value="<?= $row_cat['cat_id'] ?>" selected><?= $row_cat['cat_name'] ?></option>
                            <?php else : ?>
                                <option value="<?= $row_cat['cat_id'] ?>"><?= $row_cat['cat_name'] ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-price" class="uk-form-label">ราคาซื้อ/หน่วย</label>
                <div class="uk-form-controls">
                    <input type="text" name="price" id="input-price" value="<?= $price ?>" 
                           data-validation-engine="validate[required,custom[number]]"
                           data-errormessage-value-missing="กรุณากรอก ราคา"
                           data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/> บาท
                </div>
            </div> 
            <div class="uk-form-row">
                <label for="input-discount" class="uk-form-label">ราคาขาย/หน่วย</label>
                <div class="uk-form-controls">
                    <input type="text" name="discount" id="input-discount" value="<?= $discount ?>" 
                           data-validation-engine="validate[required,custom[number]]"
                           data-errormessage-value-missing="กรุณากรอก ส่วนลด"
                           data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/> บาท
                </div>
            </div> 
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
        var valid = $('#frm-product').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true){
                    PostJson('frm-product', '../database/db_product.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
