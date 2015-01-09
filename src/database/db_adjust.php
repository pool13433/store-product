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
        $pro_amount = $_POST['pro_amount'];
        $adj_no = $_POST['adj_no'];
        $adj_type = $_POST['adjust_type'];
        $adj_remark = $_POST['adj_remark'];

        // insert  table adjust 
        $sql_in = " INSERT INTO `adjust`(";
        $sql_in .= " `pro_id`, `adj_product_lastamount`,";
        $sql_in .= " `adj_adjust_no`, `adj_remark`,`adj_type`,`adj_createdate`,";
        $sql_in .= " `adj_createby`, `adj_updatedate`, `adj_updateby`) VALUES (";
        $sql_in .= " $pro_id,$pro_amount,";
        $sql_in .= " $adj_no,'$adj_remark','$adj_type',NOW(),";
        $sql_in .= " $per_id,NOW(),$per_id";
        $sql_in .= " )";
        $query_in = mysql_query($sql_in) or die(mysql_error());
        if ($query_in): // insert complete
            // update table product

            if ($adj_type == 'add'):
                $pro_balance = intval($pro_amount) + intval($adj_no);
            elseif ($adj_type == 'remove'):
                $pro_balance = intval($pro_amount) - intval($adj_no);
            endif;

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

    default:
        break;
}



    