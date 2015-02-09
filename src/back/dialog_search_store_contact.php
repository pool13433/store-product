<div id="dialog-search_store_contact" class="uk-modal">
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
                        <th>ชื่อเจ้าของ</th>
                        <th>ที่อยู่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM store_contact WHERE 1=1";
                    $sql .= " order by sto_id";
                    $query = mysql_query($sql) or die(mysql_error());
                    while ($row = mysql_fetch_array($query)):
                        ?>
                        <tr>
                            <td>
                                <button type="button" class="uk-button uk-button-success" 
                                        onclick="select_sto_contact(<?= $row['sto_id'] ?>, '<?= $row['sto_code'] ?>', '<?= $row['sto_onwer'] ?>', '<?= $row['sto_address'] ?>')"><i class="uk-icon-plus-square-o"></i>
                                </button>
                            </td>
                            <td><?= $row['sto_id'] ?></td>
                            <td><?= $row['sto_code'] ?></td>
                            <td><?= $row['sto_name'] ?></td>
                            <td><?= $row['sto_desc'] ?></td>
                            <td><?= $row['sto_onwer'] ?></td>
                            <td><?= $row['sto_address'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function select_sto_contact(id, code, name, address) {
        $('#input-store_id').val(id);
        $('#input-store_code').val(code);
        $('#input-store_onwer').val(name);
        $('#input-store_address').val(address);
        $.UIkit.modal("#dialog-search_store_contact").hide();
    }
</script>
