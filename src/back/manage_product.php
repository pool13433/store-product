<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_product" class="uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการสินค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <th>ปรับสมดุล</th>
                <th>ลำดับ</th>
                <th>CODE</th>
                <th>ชื่อสินค้า</th>
                <th>อธิบาย</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>ส่วนลด</th>
                <th>วันที่แก้ไข</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM product order by pro_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td>
                        <a  class="uk-button uk-button-primary uk-button-mini" href="#dialog-adjust_product<?= $row['pro_id'] ?>" data-uk-modal>
                            <i class="uk-icon-edit"></i> ปรับ
                        </a>
                        <!-- modal -->
                        <div id="dialog-adjust_product<?= $row['pro_id'] ?>" class="uk-modal">
                            <?php
                            $sql_product = "SELECT * FROM product WHERE pro_id = " . $row['pro_id'];
                            $query_product = mysql_query($sql_product) or die(mysql_error());
                            $data = mysql_fetch_assoc($query_product);
                            ?>
                            <!-- This is the modal -->
                            <div class="uk-modal-dialog uk-modal-dialog-frameless" style="padding: 20px;">
                                <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                                <div class="uk-panel">
                                    <h3 class="uk-panel-title">ปรับสมดุลสินค้า [<?= $data['pro_name'] ?>]</h3>

                                    <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
                                        <form class="uk-form uk-form-horizontal" id="frm-adjust<?=$row['pro_id']?>">        
                                            <fieldset data-uk-margin>
                                                <legend>กรอกข้อมูลสินค้า</legend>
                                                <div class="uk-form-row">
                                                    <label for="input-code" class="uk-form-label">จำนวนคงเหลือ</label>
                                                    <input type="hidden" name="pro_id" id="input-amount" value="<?= $data['pro_id']?>" />
                                                    <input type="text" name="pro_amount" id="input-amount" value="<?= $data['pro_amount'] ?>" readonly/>
                                                </div>
                                                <div class="uk-form-row">
                                                    <label for="input-code" class="uk-form-label">ประเภท</label>
                                                    <?php include '../config/dropdown_adjust_type.php';?>
                                                </div>
                                                <div class="uk-form-row">
                                                    <label for="input-code" class="uk-form-label">จำนวนที่ปรับ</label>
                                                    <input type="text" name="adj_no" id="input-name" class="validate[required]"
                                                           data-errormessage-value-missing="กรุณากรอก จำนวนที่ปรับ" />
                                                </div>
                                                <div class="uk-form-row">
                                                    <label for="input-remark" class="uk-form-label">เหตุผล/หมายเหตุ</label>
                                                    <textarea  rows="5" cols="60" name="adj_remark" id="input-remark" 
                                                               class="validate[required]"
                                                               data-errormessage-value-missing="คำอธิบาย" 
                                                               ></textarea>
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
                                var valid = $('#frm-adjust<?=$row['pro_id']?>').validationEngine('attach', {
                                    promptPosition: "centerRight",
                                    scroll: false,
                                    onValidationComplete: function(form, status) {
                                        if (status == true) {
                                            PostJson('frm-adjust<?=$row['pro_id']?>', '../database/db_adjust.php?method=adjust');
                                        }
                                    }
                                });
                                valid.css({
                                    'box-shadow': '2px 2px 2px 2px #888888',
                                    'padding': '15px',
                                });
                            });
                        </script>
                        </div>
                        <!-- modal -->
                    </td>
                    <td><?= $row['pro_id'] ?></td>
                    <td><?= $row['pro_code'] ?></td>
                    <td><?= $row['pro_name'] ?></td>
                    <td><?= $row['pro_desc'] ?></td>
                    <td><?= $row['pro_amount'] ?></td>
                    <td><?= $row['pro_unitprice'] ?></td>
                    <td><?= $row['pro_discount'] ?></td>
                    <td><?= change_dateYMD_TO_DMY($row['pro_updatedate']) ?></td>
                    <td><a href="index.php?page=form_product&id=<?= $row['pro_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['pro_id'] ?>, '../database/db_product.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>    
</div>

