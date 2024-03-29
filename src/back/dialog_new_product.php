<?php
//include '../config/Connect.php';
$id = "";
$name = "";
$desc = "";
$type = "";
$cat_id = "";
$price_buy = "";
$price_sell = "";
$discount = "";
$amount = "";
$createdate = "";
$code = "";
//################# GENARATE CODE ############
if (empty($code)) {
    $sql = "SELECT pro_code FROM product ORDER BY pro_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = substr($result['pro_code'], 4);
    $code = Gen_Code(intval($last_code));
}
//################# GENARATE CODE ############
?>
<!-- This is the modal -->
<div id="dialod-new_product" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
        <div class="uk-panel">
            <h3 class="uk-panel-title">เพิ่มสินค้าเร่งด่วน</h3>

            <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
                <form class="uk-form uk-form-horizontal" id="frm-product">        
                    <fieldset data-uk-margin>
                        <legend>กรอกข้อมูลสินค้า</legend>
                        <div class="uk-form-row">
                            <label for="input-code" class="uk-form-label">CODE</label>
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
                            <label for="input-desc" class="uk-form-label">อธิบาย</label>
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
                            <label for="input-price_buy" class="uk-form-label">ราคาซื้อ/หน่วย</label>
                            <div class="uk-form-controls">
                                <input type="text" name="price_buy" id="input-price_buy" value="<?= $price_buy ?>" 
                                       data-validation-engine="validate[required,custom[number]]"
                                       data-errormessage-value-missing="กรุณากรอก ราคาซื้อ/หน่วย"
                                       data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/> บาท
                            </div>
                        </div> 
                        <div class="uk-form-row">
                            <label for="input-price_sell" class="uk-form-label">ราคาขาย/หน่วย</label>
                            <div class="uk-form-controls">
                                <input type="text" name="price_sell" id="input-price_sell" value="<?= $price_sell ?>" 
                                       data-validation-engine="validate[required,custom[number]]"
                                       data-errormessage-value-missing="กรุณากรอก ราคาขาย/หน่วย"
                                       data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/> บาท
                            </div>
                        </div>  
                        <div class="uk-form-row">
                            <label for="input-discount" class="uk-form-label">ส่วนลด</label>
                            <div class="uk-form-controls">
                                <input type="text" name="discount" id="input-discount" value="<?= $discount ?>" 
                                       data-validation-engine="validate[required,custom[number]]"
                                       data-errormessage-value-missing="กรุณากรอก ส่วนลด"
                                       data-errormessage-custom-error="กรุณากรอกเป็นตัวเลขเท่านั้น"/>
                            </div>
                        </div> 
                        <div class="uk-form-row">
                            <div class="uk-form-controls">
                                <button class="uk-button uk-button-primary uk-button-large" type="submit">
                                    <i class="uk-icon-save"></i> บันทึก
                                </button>
                                <button class="uk-button uk-button-danger uk-button-large uk-modal-close" type="button">
                                    <i class="uk-icon-arrow-circle-left"></i> ยกเลิก/ปิด
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-product').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true) {
                    //PostJson('frm-product', '../database/db_product.php?method=create');
                    $.ajax({
                        url: '../database/db_product.php?method=create',
                        data: $('#frm-product').serialize(),
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 'success') {
                                $.UIkit.modal("#dialod-new_product").hide();
                            }
                        }
                    });
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
