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

            if (empty($_POST['id'])) {
                $sql = " INSERT INTO type (";
                $sql .= " type_name,type_desc,type_createdate)VALUES(";
                $sql .= " '$name','$desc',NOW()";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE type SET ";
                $sql .= " type_name = '$name',";
                $sql .= " type_desc = '$desc',";
                $sql .= " type_createdate = NOW()";
                $sql .= " WHERE type_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_type";
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
        $sql = "DELETE FROM type WHERE type_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    case 'get_list_type_all':
        $query = mysql_query("SELECT * FROM type WHERE type_id") or die(mysql_error());
        $data = array();
        while ($row = mysql_fetch_array($query)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;
    default:
        break;
}



    

