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
                        <th>ประเภท</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                    
                    $sql = "SELECT * FROM store_contact WHERE 1=1";
                    $page = $_GET['page'];
                    if (!empty($page)) {
                        //ven,cus
                        if ($page == 'form_bill_in') {
                            $sql .= " AND store_type = 'ven'";
                        } else if ($page == 'form_bill_out') {
                            $sql .= " AND store_type = 'cus'";
                        }
                    }
                    $sql .= " order by store_id";
                    $query = mysql_query($sql) or die(mysql_error());
                    while ($row = mysql_fetch_array($query)):
                        ?>
                        <tr>
                            <td>
                                <button type="button" class="uk-button uk-button-success" 
                                        onclick="select_store_contact(<?= $row['store_id'] ?>, '<?= $row['store_code'] ?>', '<?= $row['store_onwer'] ?>', '<?= $row['store_address'] ?>')"><i class="uk-icon-plus-square-o"></i>
                                </button>
                            </td>
                            <td><?= $row['store_id'] ?></td>
                            <td><?= $row['store_code'] ?></td>
                            <td><?= $row['store_name'] ?></td>
                            <td><?= $row['store_desc'] ?></td>
                            <td><?= $row['store_onwer'] ?></td>
                            <td><?= $row['store_address'] ?></td>
                            <td><?= Get_StoreContactStatus($row['store_type']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function select_store_contact(id, code, name, address) {
        $('#input-store_id').val(id);
        $('#input-store_code').val(code);
        $('#input-store_onwer').val(name);
        $('#input-store_address').val(address);
        $.UIkit.modal("#dialog-search_store_contact").hide();
    }
</script>
