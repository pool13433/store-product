<?php

@session_start();
include '../config/Website.php';
include '../config/Connect.php';
// ######### url ?method=? ###########
$person = $_SESSION['person'];
$per_id = $person['per_id'];
switch ($_GET['method']) {
    case 'adjust':
        $pro_balance = 0;
        $pro_id = $_POST['pro_id'];
        $id = $_POST['id'];
        $pro_amount = $_POST['pro_amount'];
        $adj_product_lastamount = $_POST['adj_product_lastamount'];
        $adj_no = $_POST['adj_no'];
        $adj_no_old = '';
        $adj_type = $_POST['adjust_type'];
        $adj_remark = $_POST['adj_remark'];
        if (empty($_POST['id'])): // create
            // insert  table adjust 
            $sql_in = " INSERT INTO `adjust`(";
            $sql_in .= " `pro_id`, `adj_product_lastamount`,";
            $sql_in .= " `adj_adjust_no`, `adj_remark`,`adj_type`,`adj_createdate`,";
            $sql_in .= " `adj_createby`, `adj_updatedate`, `adj_updateby`) VALUES (";
            $sql_in .= " $pro_id,$adj_product_lastamount,";
            $sql_in .= " $adj_no,'$adj_remark','$adj_type',NOW(),";
            $sql_in .= " $per_id,NOW(),$per_id";
            $sql_in .= " )";
        else:
            $sql = " UPDATE `adjust` SET";
            $sql .= " `adj_product_lastamount` = $adj_product_lastamount,";
            $sql .= " `adj_adjust_no` = $adj_no,";
            $sql .= " `adj_remark` = '$adj_remark',";
            $sql .= " `adj_type` = '$adj_type',";
            $sql .= " `adj_updatedate` = NOW(),";
            $sql .= " `adj_updateby` = $per_id";
            $sql .= " WHERE adj_id = $id AND pro_id = $pro_id";

            $adj_no_old = $_POST['adj_no_old'];
        endif;
        //echo 'sql : '.$sql_in;
        $query_in = mysql_query($sql_in) or die(mysql_error());
        if ($query_in): // insert complete
            // update table product
            // ใช้วิธีคำนวน แบบ เพิ่มใหม่
            if ($adj_type == 'add'):
                $pro_balance = intval($adj_product_lastamount) + intval($adj_no);
            elseif ($adj_type == 'remove'):
                $pro_balance = intval($adj_product_lastamount) - intval($adj_no);
            endif;

            // ############ edit ###########
            // ใช้วิธีคำนวนใหม่
            if (!empty($_POST['id'])):
                if ($adj_no_old != $adj_no): // ค่า เก่าก่อนการเปลี่ยนแปลง ไม่เท่ากับ ค่าใหม่ที่เปลี่ยนแปลง แสดงว่าเกิดการแก้ไข
                    if ($adj_no_old > $adj_no): // เราแก้ไข ลดจำนวนลงจากเดิม
                        $pro_balance = $pro_amount + ($adj_no_old - $adj_no);
                    else: // เราแก้ไข เพิ่มจำนวนขึ้น
                        $pro_balance = $pro_amount - ($adj_no - $adj_no_old );
                    endif;
                endif;
            endif;
            // ############ edit ###########

            $sql_up = " UPDATE product SET ";
            $sql_up .= " pro_amount = $pro_balance,";
            $sql_up .= " pro_updatedate = NOW(),";
            $sql_up .= " pro_updateby = $per_id";
            $sql_up .= " WHERE pro_id = $pro_id";
            $query_up = mysql_query($sql_up) or die(mysql_error());
            if ($query_up):
                echo ReturnJson('success', '', 'ปรับสต๊อกสำเร็จเรียบร้อย', 'index.php?page=manage_product');
            else:
                echo ReturnJson('fail', '', 'ปรับสต๊อกไม่สำเร็จ', '');
            endif;
        endif; // end if insert adjust
        break;
    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM adjust WHERE adj_id=$id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
    default:
        break;
}



    
