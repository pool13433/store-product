<div id="dialog-search_supplier_contact" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
        <div class="uk-panel" id="content-product">
            <h3 class="uk-panel-title">ค้นหาลูกค้า</h3>
            <table class="uk-table uk-table-condensed uk-table-line dataTable">
                <thead>
                    <tr>
                        <th>เลือก</th>
                        <th>ลำดับ</th>
                        <th>CODE</th>
                        <th>ชื่อร้าน</th>
                        <th>ร้านเกี่ยวกับ</th>
                        <!--<th>ชื่อเจ้าของ</th>-->
                        <th>ที่อยู่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM supplier_contact WHERE 1=1";
                    $sql .= " order by sup_id";
                    $query = mysql_query($sql) or die(mysql_error());
                    while ($row = mysql_fetch_array($query)):
                        ?>
                        <tr>
                            <td>
                                <button type="button" class="uk-button uk-button-success" 
                                        onclick="select_supplier_contact(<?= $row['sup_id'] ?>, '<?= $row['sup_code'] ?>', '<?= $row['sup_name'] ?>', '<?= $row['sup_address'] ?>')"><i class="uk-icon-plus-square-o"></i>
                                </button>
                            </td>
                            <td><?= $row['sup_id'] ?></td>
                            <td><?= $row['sup_code'] ?></td>
                            <td><?= $row['sup_name'] ?></td>
                            <td><?= $row['sup_desc'] ?></td>
                            <!--<td><?= $row['sup_onwer'] ?></td>-->
                            <td><?= $row['sup_address'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function select_supplier_contact(id, code, name, address) {
        $('#input-sup_id').val(id);
        $('#input-sup_code').val(code);
        $('#input-sup_onwer').val(name);
        $('#input-sup_address').val(address);
        $.UIkit.modal("#dialog-search_supplier_contact").hide();
    }
</script>
