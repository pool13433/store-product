<?php
include '../config/Connect.php';
$billin_id = $_GET['billin_id'];
$sql_bill = "SELECT * FROM bill_in bi";
$sql_bill .= " LEFT JOIN supplier_contact sc ON sc.sup_id = bi.sup_id";
$sql_bill .= " LEFT JOIN pay_condition pc ON pc.pay_id = bi.pay_id";
$sql_bill .= " LEFT JOIN person p ON p.per_id = bi.billin_updateby";
$sql_bill .= " WHERE bi.billin_id = $billin_id";
$query_biil = mysql_query($sql_bill) or die(mysql_error());
$object = mysql_fetch_assoc($query_biil);
$billin_id = $object['billin_id'];
$billin_invoicescode = $object['billin_invoicescode'];
$billin_taxcode = $object['billin_taxcode'];
$billin_indate = $object['billin_indate'];
$sup_id = $object['sup_id'];
$store_name = $object['store_name'];
$store_onwer = $object['store_onwer'];
$store_address = $object['store_address'];
$billin_doccode = $object['billin_doccode'];
$billin_docdate = $object['billin_docdate'];
$pay_id = $object['pay_id'];
$pay_name = $object['pay_name'];
$billin_finishdate = $object['billin_finishdate'];
$billin_paycode = $object['billin_paycode'];
$officer_name = $object['per_name'];
$billin_localtioncode = $object['billin_localtioncode'];
$billin_weight = $object['billin_weight'];
$billin_pricebeforevat = $object['billin_pricebeforevat'];
$billin_vat = $object['billin_vat'];
$billin_priceaftervat = $object['billin_priceaftervat'];
$billin_sender = $object['billin_sender'];
$billin_receiver = $object['billin_receiver'];
$billin_autherized = $object['billin_autherized'];
$billin_createdate = $object['billin_createdate'];
$billin_status = $object['billin_status'];
?>
<h3>รายงานสินค้าเข้าคลคลัง เลขที่  <?=$billin_invoicescode?></h3>
<table>
    <tbody>
        <tr>
            <td>เลขที่ใบกำกับภาษี</td>
            <td><?= $billin_taxcode ?></td>
            <td>เลขที่ใบแจ้งหนี้</td>
            <td><?= $billin_invoicescode ?></td>
            <td>วันที่เอกสาร</td>
            <td><?= $billin_indate ?></td>
        </tr>
        <tr>
            <td>ซื้อจาก</td>
            <td><?= $store_name ?></td>
            <td>ชื่อ</td>
            <td><?= $store_onwer ?></td>
            <td>ที่อยู่</td>
            <td><?= $store_address ?></td>
        </tr>
        <tr>
            <td>เลขที่อ้างถึงเอกสาร</td>
            <td><?= $billin_doccode ?></td>
            <td>อ้างถึงวันที่ส่ง</td>
            <td><?= $billin_docdate ?></td>
            <td>เงื่อนไขการชำระเงิน</td>                        
            <td><?= $pay_name ?></td>
        </tr>
        <tr>
            <td>วันครบกำหนด</td>
            <td><?= $billin_finishdate ?></td>
            <td>เลขที่ใบสั่งขาย</td>
            <td><?= $pay_name ?></td>
            <td>พนักงานขาย</td>
            <td><?= $officer_name ?></td>
        </tr>
    </tbody>
</table>
<hr/>
<table class="uk-table uk-table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนจากบิล</th>
            <th>จำนวนนับจริง</th>
            <th>ราคา</th>
            <th>ส่วนลด</th>
            <th>ราคารวม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM bill_in_product bip ";
        $sql .= " JOIN product p ON p.pro_code = bip.pro_code";
        $sql .= " WHERE billin_id = $billin_id";
        $sql .= " ORDER BY p.pro_code ASC";
        $query = mysql_query($sql) or die(mysql_error());
        $no = 1;
        while ($data = mysql_fetch_array($query)):
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['pro_code'] ?></td>
                <td><?= $data['pro_name'] ?></td>
                <td><?= $data['billinpro_noinbill'] ?></td>
                <td><?= $data['billinpro_nocount'] ?></td>
                <td><?= $data['billinpro_unitprice'] ?></td>
                <td><?= $data['billinpro_discount'] ?></td>
                <td><?= $data['billinpro_totalprice'] ?></td>
            </tr>
            <?php
            $no++;
        endwhile;
        ?>
    </tbody>
</table>
<hr/>
<table>
    <tbody>
        <tr>
            <td>น้ำหนักสุทธิ</td>
            <td><?=$billin_weight?></td>
            <td></td>
            <td></td>
            <td style="text-align: right">ราคาก่อน VAT</td>
            <td><?=$billin_pricebeforevat?></td>
        </tr>
        <tr>            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right">VAT</td>
            <td><?=$billin_vat?></td>
        </tr>
        <tr>            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right">ราคาหลัง VAT</td>
            <td><?=$billin_priceaftervat?></td>
        </tr>
    </tbody>
</table>


