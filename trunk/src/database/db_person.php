<?php

session_start();
include '../config/Website.php';
include '../config/Connect.php';
// ######### url ?method=? ###########

switch ($_GET['method']) {
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM person WHERE per_username = '$username' and per_password = '$password' and per_status > 0";
//echo ' sql : ' . $sql;
        $query = mysql_query($sql) or die(mysql_error());
        $result = mysql_fetch_assoc($query);
        if ($result) {
            $_SESSION['person'] = $result;
            $status = 'success';
            $title = "";
            $msg = 'เข้าระบบสำเร็จ';
            if ($result['per_status'] == 0) {
                $url = 'index.php?page=welcome';
            } else if ($result['per_status'] == 1) { // admin
                $url = 'back/index.php?page=home';
            } else if ($result['per_status'] == 2) { //officer
                $url = 'index.php?page=welcome';
            } else if ($result['per_status'] == 3) { // customer
                $url = 'index.php?page=welcome';
            } else if ($result['per_status'] == 4) { // vender
                $url = 'index.php?page=welcome';
            }
        } else {
            $status = 'fail';
            $title = "";
            $msg = 'ไม่มี ข้อมูลในระบบ';
            $url = '';
        }
        echo ReturnJson($status, $title, $msg, $url);
        break;
    case 'register':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];

        $sql = "INSERT INTO person (per_username,per_password,";
        $sql .= " per_fname,per_lname,per_address,";
        $sql .= " per_mobile,per_email,per_createdate)values(";
        $sql .= " '$username','$password', ";
        $sql .= " '$fname','$lname','$address',";
        $sql .= " '$mobile','$email',NOW())";
        $sql .= " ";
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_affected_rows();
        if ($row > 0) {
            $status = "success";
            $title = "insert ok ";
            $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ รอการอนุมัติจากระบบ";
            $url = "index.php?page=login";
        } else {
            $status = "fail";
            $title = "insert fail ";
            $msg = "การลทะเบียนเกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่";
            $url = "";
        }
        echo ReturnJson($status, $title, $msg, $url);
        break;
    case 'create':
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $code = $_POST['code'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $status = $_POST['status'];
            if (empty($_POST['id'])) { // new person
                $sql = "INSERT INTO person (per_code,per_username,per_password,";
                $sql .= " per_fname,per_lname,per_address,";
                $sql .= " per_mobile,per_email,per_createdate,per_status)values(";
                $sql .= " '$code','$username','$password', ";
                $sql .= " '$fname','$lname','$address',";
                $sql .= " '$mobile','$email',NOW(),$status)";
                $msg = "เพิ่มข้อมูลเข้าระบบสำเร็จ";
            } else { //edit person
                $sql = " UPDATE person SET";
                $sql .= " per_code = '$code',";
                $sql .= " per_username = '$username',";
                $sql .= " per_password = '$password',";
                $sql .= " per_fname = '$fname',";
                $sql .= " per_lname = '$lname',";
                $sql .= " per_address = '$address',";
                $sql .= " per_mobile = '$mobile',";
                $sql .= " per_email = '$email',";
                $sql .= " per_status = $status,";
                $sql .= " per_createdate = NOW()";
                $sql .= " WHERE per_id = $id";
                $msg = "แก้ไขข้อมูลเข้าระบบสำเร็จ";
            }
            //echo 'sql : '.$sql;
            $query = mysql_query($sql) or die(mysql_error());
            //$row = mysql_affected_rows();
            if ($query) {
                $status = "success";
                $title = "insert ok ";
                $url = "index.php?page=manage_person";
            } else {
                $status = "fail";
                $title = "insert fail ";
                $msg = "เพิ่มผู้ใช้งานไม่ได้ กรุณาติดต่อเจ้าหน้าที่";
                $url = "";
            }
            echo ReturnJson($status, $title, $msg, $url);
        }
        break;
    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM person WHERE per_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    default:
    case 'logout':
        unset($_SESSION['person']);
    default:
        break;
}

