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
            $prefix = $_POST['prefix'];
            $onwer = $_POST['onwer'];
            $pid = $_POST['pid'];
            $telephone = $_POST['telephone'];
            if (empty($_POST['id'])) {

                $sql = " INSERT INTO `store_contact`";
                $sql .= " ( `sto_code`, `sto_name`, `sto_desc`,";
                $sql .= " `pre_id`, `sto_onwer`, sto_pid,`sto_address`, `sto_telephone`,";
                $sql .= " `sto_createdate`, `sto_createby`, `sto_updatedate`,";
                $sql .= " `sto_updateby`) VALUES (";
                $sql .= " '$code','$name','$desc',";
                $sql .= " $prefix,'$onwer','$pid','$address','$telephone',";
                $sql .= " NOW(),$per_id,NOW(),$per_id";
                $sql .= " )";

                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE store_contact SET ";
                $sql .= " `sto_code`='$code',";
                $sql .= " `sto_name`='$name',";
                $sql .= " `sto_desc`='$desc',";
                $sql .= " `pre_id`=$prefix,";
                $sql .= " `sto_onwer`='$onwer',";
                $sql .= " sto_pid = '$pid',";
                $sql .= " `sto_address`='$address',";
                $sql .= " `sto_telephone`='$telephone',";
                $sql .= " `sto_updatedate`=NOW(),";
                $sql .= " `sto_updateby`=$per_id";
                $sql .= " WHERE `sto_id` = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_store_contact";
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
        $sql = "DELETE FROM store_contact WHERE sto_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    case 'searchstore':
        $store_code = $_POST['code'];
        $sql = "SELECT * FROM store_contact WHERE store_code = '$store_code'";
        //echo 'SQL : ' . $sql;
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($query);
        if ($row >= 1) {
            $result = mysql_fetch_assoc($query);
            //var_dump($result['store_code']);  
            echo json_encode($result);
        } else {
            echo json_encode(array(
                'status' => 'fail'
            ));
        }
        break;
    default:
        break;
}



    