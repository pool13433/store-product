<?php

session_start();
include '../config/Website.php';
include '../config/Connect.php';
// ######### url ?method=? ###########

switch ($_GET['method']) {
    case 'create':
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $address = $_POST['address'];
            $onwer = $_POST['onwer'];
            $type = $_POST['type'];
            if (empty($_POST['id'])) {
                $code = $_POST['type'] . $_POST['code'];
                $sql = " INSERT INTO store_contact(";
                $sql .= " store_code,store_name,store_desc,store_onwer,";
                $sql .= " store_address,store_type,store_createdate)VALUES(";
                $sql .= " '$code','$name','$desc','$onwer',";
                $sql .= " '$address','$type',NOW()";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $code = $_POST['type'] . substr($_POST['code'], 4);
                $sql = " UPDATE store_contact SET ";
                $sql .= " store_code = '$code',";
                $sql .= " store_name = '$name',";
                $sql .= " store_desc = '$desc',";
                $sql .= " store_onwer = '$onwer',";
                $sql .= " store_address = '$address',";
                $sql .= " store_type = '$type',";
                $sql .= " store_createdate = NOW()";
                $sql .= " WHERE store_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
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
        $sql = "DELETE FROM store_contact WHERE store_id=$id";
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
        }else{
            echo json_encode(array(
                'status' => 'fail'
            ));
        }
        break;
    default:
        break;
}



    