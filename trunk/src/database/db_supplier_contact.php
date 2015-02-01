<?php

@session_start();
include '../config/Website.php';
include '../config/Connect.php';
// ######### url ?method=? ###########
$person = $_SESSION['person'];
$per_id = $person['per_id'];
switch ($_GET['method']) {
    case 'create':
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $address = $_POST['address'];
            $orderday = $_POST['hidden-orderday'];
            $deliveryday = $_POST['hidden-deliveryday'];
            $telephone = $_POST['telephone'];
            $fax = $_POST['fax'];
            if (empty($_POST['id'])) {
                $sql = " INSERT INTO supplier_contact(";
                $sql .= " sup_code,sup_name,sup_desc,sup_orderday,";
                $sql .= " sup_address,sup_deliveryday,sup_telephone,sup_fax,sup_createdate,sup_createby,";
                $sql .= " sup_updatedate,sup_updateby)VALUES(";
                $sql .= " '$code','$name','$desc','$orderday',";
                $sql .= " '$address','$deliveryday','$telephone','$fax',NOW(),$per_id,";
                $sql .= " NOW(),$per_id";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE supplier_contact SET ";
                $sql .= " sup_code = '$code',";
                $sql .= " sup_name = '$name',";
                $sql .= " sup_desc = '$desc',";
                $sql .= " sup_orderday = '$orderday',";
                $sql .= " sup_deliveryday = '$deliveryday',";
                $sql .= " sup_address = '$address',";
                $sql .= " sup_telephone = '$telephone',";
                $sql .= " sup_fax = '$fax',";
                $sql .= " sup_updatedate = NOW(),";
                $sql .= " sup_updateby = $per_id";
                $sql .= " WHERE sup_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : ' . $sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_supplier_contact";
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
        $sql = "DELETE FROM supplier_contact WHERE sup_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    case 'set_default':
        $id = $_POST['id'];
        $field = $_POST['field'];
        $sql = "SELECT * FROM supplier_contact WHERE sup_id = $id";
        $query = mysql_query($sql) or die(mysql_error());
        $data = mysql_fetch_assoc($query);
        $result = $data[$field];
        $arrdata = array();
        $arrdata = explode(',', $result);
        $return = array();
        foreach ($arrdata as $value):
            $return[] = array(
                'id' => $value,
                'text' => Get_Day($value),
            );
        endforeach;
        echo json_encode($return);
        break;
    default:
        break;
}



    