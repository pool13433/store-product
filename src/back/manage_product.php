<?php include '../config/Connect.php'; ?>
<div class="uk-panel uk-panel-box uk-width-medium-10-10">
    <div class="uk-panel-badge uk-badge uk-badge-info">
        <a href="index.php?page=form_product" class="uk-button-primary uk-button-mini">เพิ่ม</a>
    </div>
    <h3 class="uk-panel-title">จัดการข้อมูลสินค้า</h3>
    <table class="uk-table uk-table-condensed uk-table-line dataTable">
        <thead>
            <tr>
                <!--<th>ปรับสมดุล</th>
                <th>ลำดับ</th>-->
                <th style="text-align: center">รหัสสินค้า</th>
                <th style="text-align: center">ชื่อสินค้า</th>
                <!--<th>อธิบาย</th>-->
                <!--<th style="text-align: center">จำนวนสินค้าคงเหลือ</th>-->
                <th style="width: 13%">ราคาซื้อ(บาท)</th>
                <th style="width: 13%">ราคาขาย(บาท)</th>
                <th style="width: 13%">ส่วนลด</th>
                <th style="text-align: center">วันที่แก้ไข</th>
                <th style="text-align: center">แก้ไข</th>
                <th style="text-align: center">ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM product order by pro_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($row = mysql_fetch_array($query)):
                ?>
                <tr>
<!--                    <td>
                        <a  class="uk-button uk-button-primary uk-button-mini" href="#dialog-adjust_product<?= $row['pro_id'] ?>" data-uk-modal>
                            <i class="uk-icon-edit"></i> ปรับ
                        </a>
                        <a  class="uk-button uk-button-success uk-button-mini" href="index.php?page=manage_adjust&id=<?= $row['pro_id'] ?>">
                            <i class="uk-icon-edit"></i> แก้ไข
                        </a>
                         modal 
                        <div id="dialog-adjust_product<?= $row['pro_id'] ?>" class="uk-modal">
                            <?php
                            $sql_product = "SELECT * FROM product WHERE pro_id = " . $row['pro_id'];
                            $query_product = mysql_query($sql_product) or die(mysql_error());
                            $data = mysql_fetch_assoc($query_product);
                            ?>
                             This is the modal 
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
                                                    <input type="hidden" name="id" id="input-amount" value="" />
                                                    <input type="hidden" name="pro_id" id="input-amount" value="<?= $data['pro_id']?>" />
                                                    <input type="hidden" name="pro_amount" id="input-amount"/>
                                                    <input type="text" name="adj_product_lastamount" id="input-adj_product_lastamount" value="<?= $data['pro_amount'] ?>" readonly/>
                                                </div>
                                                <div class="uk-form-row">
                                                    <label for="input-code" class="uk-form-label">ประเภท</label>
                                                    <?php include '../config/dropdown_adjust_type.php';?>
                                                </div>
                                                <div class="uk-form-row">
                                                    <label for="input-code" class="uk-form-label">จำนวนที่ปรับ</label>
                                                    <input type="hidden" name="adj_no_old" value=""/>
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
                         modal 
                    </td>-->
                    <!--<td><?= $row['pro_id'] ?></td>-->
                    <td style="text-align: center"><?= $row['pro_code'] ?></td>
                    <td style="text-align: center"><?= $row['pro_name'] ?></td>
                   <!-- <td><?= $row['pro_desc'] ?></td>-->
                   <!-- <td style="text-align: center"><?= $row['pro_amount'] ?></td>-->
                    <td style="text-align: right"><?= $row['pro_unitprice_buy'] ?></td>
                    <td style="text-align: right"><?= $row['pro_unitprice_sell'] ?></td>
                    <td style="text-align: right"><?= $row['pro_discount'] ?></td>
                    <td  style="text-align: center"><?= change_dateYMD_TO_DMY($row['pro_updatedate']) ?></td>
                    <td  style="text-align: center"><a href="index.php?page=form_product&id=<?= $row['pro_id'] ?>"><button class="uk-button uk-button-success"><i class="uk-icon-edit"></i></button></a></td>
                    <td  style="text-align: center"><button class="uk-button uk-button-danger" onclick="deleteItem(<?= $row['pro_id'] ?>, '../database/db_product.php?method=delete')"><i class="uk-icon-trash-o"></i></button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>    
</div>

