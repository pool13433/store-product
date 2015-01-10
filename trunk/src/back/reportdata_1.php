<?php include '../config/Connect.php'; ?>
<table class="uk-table uk-table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>โค๊ด</th>
            <th>ชื่อ</th>
            <th>จำนวนคงเหลือ</th>
            <th>ราคาต่อหน่วย</th>
            <th>ส่วนลด</th>            
            <th>ชนิด</th>
            <th>กลุ่ม</th>                        
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = " SELECT * FROM product p";
        $sql .= " JOIN type t ON t.type_id = p.type_id";
        $sql .= " JOIN category c ON c.cat_id = p.cat_id";
        $sql .= " WHERE 1=1";
        if (!empty($_GET['date_start']) && !empty($_GET['date_end'])):
            //##########format########
            $array = explode("/", $_GET['date_start']);
            $date_start = $array[2] . "-" . $array[1] . "-" . $array[0];

            $array = explode("/", $_GET['date_end']);
            $date_end = $array[2] . "-" . $array[1] . "-" . $array[0];
            //$sql .= " AND DATE_FORMAT(p.pro_createdate,'%d/%m/%Y')";
            //$sql .= " BETWEEN STR_TO_DATE('$date_start','%Y-%m-%d') AND STR_TO_DATE('$date_end','%Y-%m-%d')";
            $sql .= " AND pro_createdate BETWEEN '$date_start' AND '$date_end'";
        endif;
        $sql .= " ORDER BY pro_code ASC";

        //echo '<pre> : ' . $sql . "</pre>";
        $query = mysql_query($sql) or die(mysql_error());
        $no = 1;
        while ($data = mysql_fetch_array($query)):
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['pro_code'] ?></td>
                <td><?= $data['pro_name'] ?></td>
                <td><?= $data['pro_amount'] ?></td>
                <td><?= $data['pro_unitprice'] ?></td>
                <td><?= $data['pro_discount'] ?></td>
                <td><?= $data['type_name'] ?></td>
                <td><?= $data['cat_name'] ?></td>                
            </tr>
            <?php
            $no++;
        endwhile;
        ?>
    </tbody>
</table>



