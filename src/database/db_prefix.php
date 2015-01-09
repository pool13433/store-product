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
            $name = $_POST['name'];
            //$desc = $_POST['desc'];

            if (empty($_POST['id'])) {
                $sql = " INSERT INTO prefix (";
                $sql .= " pre_name,pre_createdate,pre_createby,pre_updatedate,pre_updateby)VALUES(";
                $sql .= " '$name',NOW(),$per_id,NOW(),$per_id";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE prefix SET ";
                $sql .= " pre_name = '$name',";
                //$sql .= " pre_desc = '$desc',";
                $sql .= " pre_updatedate = NOW(),";
                $sql .= " pre_updateby = $per_id";
                $sql .= " WHERE pre_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_prefix";
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
        $sql = "DELETE FROM prefix WHERE pre_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    default:
        break;
}



    

