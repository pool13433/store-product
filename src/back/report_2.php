<div class="uk-panel" style="padding-right: 20px">    
    <h3 class="uk-panel-title">ใบรายการสินค้าเข้าทั้งหมดในระบบ</h3>
    <table class="uk-table uk-table-condensed" id="table-report_2">
        <thead>
            <tr>
                <th>รหัสใบซื้อ</th>
                <th>เลขที่ใบภาษี</th>
                <th>เลขที่เอกสาร</th>
                <th>วันที่เข้าเอกสาร</th>
                <th>จำนวนสินค้าเข้า</th>
                <th>ซื้อจากร้าน</th>
                <th>ออกรายงาน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../config/Connect.php';
            $sql = "SELECT bi.*,";
            $sql .= " (SELECT COUNT(*) FROM bill_in_product WHERE billin_id = bi.billin_id) count_ptoduct,";
            $sql .= " sc.*";
            $sql .= " FROM bill_in bi";
            $sql .= " JOIN store_contact sc ON sc.store_id = bi.store_id";
            $sql .= " ORDER BY bi.billin_id ASC";
            $query = mysql_query($sql) or die(mysql_error());
            while ($data = mysql_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $data['billin_invoicescode'] ?></td>
                    <td><?= $data['billin_taxcode'] ?></td>
                    <td><?= $data['billin_doccode'] ?></td>
                    <td><?= $data['billin_indate'] ?></td>
                    <td><?= $data['count_ptoduct'] ?></td>
                    <td><?= $data['store_name'] ?></td>
                    <td style="text-align: right">
                        <a href="../report/report.php?method=report_2-1&billin_id=<?= $data['billin_id'] ?>" class="uk-button uk-button-primary">
                            <i class="uk-icon-print"></i> ออกรายงาน
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!--    <div class="uk-form-row" style="text-align: right">
            <div class="uk-form-controls">
                <a class="uk-button uk-button-primary" 
                   href="../report/report.php?method=report_2" target="_blank">
                    <i class="uk-icon-print"></i> ออกรายงาน
                </a>
            </div>
        </div>-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-report_2').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "../../lib/TableTools-2.2.3/swf/copy_csv_xls_pdf.swf"
            }
        });
    });
</script>