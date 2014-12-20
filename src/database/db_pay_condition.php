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
            $time = $_POST['time'];
            
            if (empty($_POST['id'])) {
                $sql = " INSERT INTO pay_condition (";
                $sql .= " pay_name,pay_time,pay_createdate)VALUES(";
                $sql .= " '$name',$time,NOW()";
                $sql .= " )";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else {
                $sql = " UPDATE pay_condition SET ";
                $sql .= " pay_name = '$name',";
                $sql .= " pay_time = '$time',";
                $sql .= " pay_createdate = NOW()";
                $sql .= " WHERE pay_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";                
                $url = "index.php?page=manage_pay_condition";
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
        $sql = "DELETE FROM pay_condition WHERE pay_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;

    default:
        break;
}



    