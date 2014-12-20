<?php

session_start();
include '../config/Website.php';
include '../config/Connect.php';
// ######### url ?method=? ###########

switch ($_GET['method']) {
    case 'create':
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $type = $_POST['type'];
            $cat_id = $_POST['cat_id'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $amount = $_POST['amount'];

            if (empty($_POST['id'])) {
                $sql = " INSERT INTO product (";
                $sql .= " pro_code,pro_name,pro_desc,";
                $sql .= " pro_amount,pro_type,cat_id,";
                $sql .= " pro_unitprice,pro_discount,";
                $sql .= " pro_createdate)VALUES(";
                $sql .= " '$code','$name','$desc',";
                $sql .= " $amount,$type,$cat_id,";
                $sql .= " $price,$discount,NOW()";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE product SET ";
                $sql .= " pro_code = '$code',";
                $sql .= " pro_name = '$name',";
                $sql .= " pro_desc = '$desc',";
                $sql .= " pro_amount = $amount,";
                $sql .= " pro_type = $type,";
                $sql .= " cat_id = $cat_id,";
                $sql .= " pro_unitprice = $price,";
                $sql .= " pro_discount = $discount,";
                $sql .= " pro_createdate = NOW()";
                $sql .= " WHERE pro_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_product";
            } else {
                $status = "fail";
                $title = "insert fail ";
                $msg = "เพิ่มข้อมูลไม่ได้ กรุณาติดต่อเจ้าหน้าที่";
                $url = "";
            }
            echo ReturnJson($status, $title, $msg, $url);
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM product WHERE pro_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    case 'searchproduct':
        $code = $_POST['code'];
        $sql = "SELECT * FROM product WHERE pro_code = '$code'";
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($query);
        if ($row >= 1) {
            $result = mysql_fetch_assoc($query);
            echo json_encode($result);
        } else {
            echo json_encode(array(
                'status' => 'fail'
            ));
        }
        break;
    case 'get_product_all':
        $query = mysql_query("SELECT * FROM product p JOIN category c ON c.cat_id = p.cat_id JOIN type t ON t.type_id = p.pro_type  ") or die(mysql_error());
        $data = array();
        while ($row = mysql_fetch_array($query)):
            $data[] = array(
                'pro_id' => $row['pro_id'],
                'pro_code' => $row['pro_code'],
                'pro_name' => $row['pro_name'],
                'pro_desc' => $row['pro_desc'],
                'cat_name' => $row['cat_name'],
            );
        endwhile;
        echo json_encode($data);
        break;
    default:
        break;
}
