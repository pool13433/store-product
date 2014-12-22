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
            $desc = $_POST['desc'];
            
            if (empty($_POST['id'])) {
                $sql = " INSERT INTO category (";
                $sql .= " cat_name,cat_desc,cat_createdate,cat_createby,";
                $sql .= " cat_updatedate,cat_updateby)VALUES(";
                $sql .= " '$name','$desc',NOW(),$per_id,";
                $sql .= " NOW(),$per_id)";
            } else {
                $sql = " UPDATE category SET ";
                $sql .= " cat_name = '$name',";
                $sql .= " cat_desc = '$desc',";
                $sql .= " cat_updatedate = NOW(),";
                $sql .= " cat_updateby = $per_id";
                $sql .= " WHERE cat_id = $id";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
                $url = "index.php?page=manage_category";
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
        $sql = "DELETE FROM category WHERE cat_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;

    default:
        break;
}



    