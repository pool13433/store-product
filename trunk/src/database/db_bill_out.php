<?php

@session_start();
include '../config/Connect.php';
include '../config/Website.php';
$person = $_SESSION['person'];
$per_id = $person['per_id'];
switch ($_GET['method']) {
    case 'create':
        $form = json_decode($_POST['form'], true);
        $bill_id = $form['bill_id'];
        $customer_id = $form['customer_id'];
        $customer_onwer = $form['customer_onwer'];
        $customer_address = $form['customer_address'];
        $billcode = $form['billcode'];
        $billdate = $form['billdate'];
        $officer = $form['officer'];
        $pay_condition = $form['pay_condition'];
        $receiver = $form['receiver'];
        $sender = $form['sender'];
        $totalprice = $form['totalprice'];

        if (empty($form['bill_id'])) { //$form['bill_id']
            $sql_bill = " INSERT INTO `bill_out`(`billout_code`, `customer_id`,billout_outdate, ";
            $sql_bill .= " `officer_id`, `pay_id`, `billout_receiver`, `billout_sender`, ";
            $sql_bill .= " `billout_createdate`,`billout_createby`,";
            $sql_bill .= " `billout_updatedate`,`billout_updateby``billout_total`,billout_status) VALUES (";
            $sql_bill .= " '$billcode',$customer_id,'" . change_dateDMY_TO_YMD($billdate) . "',";
            $sql_bill .= " $officer,$pay_condition,'$receiver','$sender',";
            $sql_bill .= " NOW(),$per_id,";
            $sql_bill .= " NOW(),$per_id,$totalprice,1)";
        } else {
            $sql_bill = " UPDATE `bill_out` SET ";
            $sql_bill .= " `billout_code`='$billcode',";
            $sql_bill .= " `customer_id`=$customer_id,";
            $sql_bill .= " billout_outdate = '" . change_dateDMY_TO_YMD($billdate) . "',";
            $sql_bill .= " `officer_id`=$officer,";
            $sql_bill .= " `pay_id`=$pay_condition,";
            $sql_bill .= " `billout_receiver`='$receiver',";
            $sql_bill .= " `billout_sender`='$sender',";
            $sql_bill .= " `billout_updatedate`=NOW(),";
            $sql_bill .= " `billout_updateby`= $per_id,";
            $sql_bill .= " `billout_total`=$totalprice";
            $sql_bill .= " WHERE `billout_id`= $bill_id";
        }
        //echo  ' sql : '.$sql_bill;
        $query_bill = mysql_query($sql_bill) or die(mysql_error());
        $insert_bill_id = mysql_insert_id();

        if (empty($insert_bill_id)) {
            $insert_bill_id = $bill_id;
        }
        if ($query_bill) {
            $list_product = json_decode($_POST['list_product'], true);
            if (count($list_product) > 0):
                foreach ($list_product as $object):
                    $billpro_id = $object['pro_id'];
                    $pro_name = $object['pro_name'];
                    $pro_code = $object['pro_code'];
                    $pro_nocount = $object['pro_nocount'];
                    $pro_type = $object['pro_type'];
                    $pro_price = $object['pro_price'];
                    $pro_discount = $object['pro_discount'];
                    $pro_total_price = $object['pro_total_price'];

                    $product_stock = get_product_no($pro_code);

                    if (empty($form['bill_id'])) :
                        $sql_product = " INSERT INTO `bill_out_product`(`pro_code`,";
                        $sql_product .= " `billoutpro_nocount`, `billoutpro_unitprice`,";
                        $sql_product .= " `billoutpro_discount`, `billout_id`,billoutpro_totalprice,";
                        $sql_product .= " `billoutpro_createdate`) VALUES (";
                        $sql_product .= " '$pro_code',";
                        $sql_product .= " $pro_nocount,$pro_price,";
                        $sql_product .= " $pro_discount,$insert_bill_id,$pro_total_price,";
                        $sql_product .= " NOW()";
                        $sql_product .= " )";

                        mysql_query($sql_product) or die(mysql_error());
                    else:
                        $difference_nocount = 0;
                        $difference_price = 0;
                        $difference_discount = 0;

                        if (!empty($object['pro_id'])) {
                            $billpro_old = get_bill_product($billpro_id);

                            $difference_nocount = $billpro_old['billoutpro_nocount'] - $pro_nocount;
                            if ($difference_nocount != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_amount = " . ($product_stock['pro_amount'] - $difference_nocount);
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }

                            $difference_price = $billpro_old['billoutpro_unitprice'] - $pro_price;
                            if ($difference_price != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_unitprice = .$pro_price";
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }
                            $difference_discount = $billpro_old['billoutpro_discount'] - $pro_discount;
                            if ($difference_discount != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_discount = $pro_discount";
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }
                        }

                    endif;

                    if (empty($object['pro_id'])) {
                        $sql_bill_product = " INSERT INTO `bill_out_product`(";
                        $sql_bill_product .= " `pro_code`, `billoutpro_nocount`,";
                        $sql_bill_product .= " `billoutpro_unitprice`, `billoutpro_discount`,billoutpro_totalprice, ";
                        $sql_bill_product .= " `billout_id`, `billoutpro_createdate`) VALUES (";
                        $sql_bill_product .= " '$pro_code',$pro_nocount,";
                        $sql_bill_product .= " $pro_price,$pro_discount,$pro_total_price,";
                        $sql_bill_product .= " $insert_bill_id,NOW()";
                        $sql_bill_product .= " )";
                    } else {
                        $sql_bill_product = " UPDATE `bill_out_product` SET";
                        //$sql_bill_product .= " `pro_code`='$pro_code',";
                        $sql_bill_product .= " `billoutpro_nocount`=$pro_nocount,";
                        $sql_bill_product .= " `billoutpro_unitprice`=$pro_price,";
                        $sql_bill_product .= " `billoutpro_discount`=$pro_discount,";
                        $sql_bill_product .= " billoutpro_totalprice = $pro_total_price,";
                        //$sql_bill_product .= " `billoutpro_id`=$,";
                        $sql_bill_product .= " `billoutpro_createdate`=NOW()";
                        $sql_bill_product .= " WHERE `billoutpro_id`= $billpro_id";
                    }
                    //echo ' [sql : '.$sql_bill_product." ]";
                    mysql_query($sql_bill_product) or die(mysql_error() . 'SQL : ' . $sql_bill_product);

                endforeach;
            endif;

            $list_remove = json_decode($_POST['list_product_remove'], true);

            if (count($list_remove) > 0):
                foreach ($list_remove as $object):
                    $billpro_id = $object['pro_id'];
                    $pro_name = $object['pro_name'];
                    $pro_code = $object['pro_code'];
                    $pro_nocount = $object['pro_nocount'];
                    $pro_type = $object['pro_type'];
                    $pro_price = $object['pro_price'];
                    $pro_discount = $object['pro_discount'];
                    $pro_total_price = $object['pro_total_price'];

                    $product_stock = get_product_no($pro_code);

                    $billpro_old = get_bill_product($billpro_id);
                    $sql_update = "UPDATE product SET ";
                    $sql_update .= " pro_amount = " . ($product_stock['pro_amount'] - $pro_nocount);
                    $sql_update .= " WHERE pro_code = '$pro_code'";
                    mysql_query($sql_update) or die(mysql_error());

                endforeach;

                // ######### Remove ######
                foreach ($list_remove as $object):
                    $sql_remove = "DELETE FROM bill_out_product WHERE billoutpro_id = " . $object['pro_id'];
                    mysql_query($sql_remove) or die(mysql_error());
                endforeach;
            // ######### Remove ######
            endif;
            echo ReturnJson('success', 'บันทึก', 'บันทึกสำเร็จ', 'index.php?page=manage_bill_out');
        }
        break;
    case 'delete':
        $id = $_GET['id'];
        //$sql = "DELETE FROM bill_in WHERE billin_id=$id";
        $sql = " UPDATE bill_out SET ";
        $sql .= " billout_status = 0";
        $sql .= " WHERE billout_id = $id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
        break;
        break;
    case 'get_thaibath_text':
        $price = $_POST['price'];
        $text_thaibath = num2thai($price);
        echo $text_thaibath;
        break;
    case 'get_pro_product_by_biil_id':
        $bill_id = $_POST['bill_id'];
        $sql = "SELECT * FROM bill_out_product bp";
        $sql .= " JOIN product p ON bp.pro_code = p.pro_code";
        $sql .= " JOIN type t ON t.type_id = p.type_id";
        $sql .= " WHERE bp.billout_id = $bill_id";
        $query = mysql_query($sql) or die(mysql_error());
        $data = array();
        while ($row = mysql_fetch_array($query)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;
    default:
        break;
}

function get_product_no($pro_code) {
    $query = mysql_query("SELECT * FROM product WHERE pro_code = '$pro_code'") or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    //return intval($result['pro_amount']);
    return $result;
}

function num2thai($number) {
    $t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
    $zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
    (string) $number;
    $number = explode(".", $number);
    if (!empty($number[1])) {
        if (strlen($number[1]) == 1) {
            $number[1] .= "0";
        } elseif (strlen($number[1]) > 2) {
            if ($number[1]{2} < 5) {
                $number[1] = substr($number[1], 0, 2);
            } else {
                $number[1] = $number[1]{0} . ($number[1]{1} + 1);
            }
        }
    }
    for ($i = 0; $i < count($number); $i++) {
        $countnum[$i] = strlen($number[$i]);
        if ($countnum[$i] <= 7) {
            $var[$i][] = $number[$i];
        } else {
            $loopround = ceil($countnum[$i] / 6);
            for ($j = 1; $j <= $loopround; $j++) {
                if ($j == 1) {
                    $slen = 0;
                    $elen = $countnum[$i] - (($loopround - 1) * 6);
                } else {
                    $slen = $countnum[$i] - ((($loopround + 1) - $j) * 6);
                    $elen = 6;
                }
                $var[$i][] = substr($number[$i], $slen, $elen);
            }
        }
        $nstring[$i] = "";
        for ($k = 0; $k < count($var[$i]); $k++) {
            if ($k > 0)
                $nstring[$i] .= $t2[7];
            $val = $var[$i][$k];
            $tnstring = "";
            $countval = strlen($val);
            for ($l = 7; $l >= 2; $l--) {
                if ($countval >= $l) {
                    $v = substr($val, -$l, 1);
                    if ($v > 0) {
                        if ($l == 2 && $v == 1) {
                            $tnstring .= $t2[($l)];
                        } elseif ($l == 2 && $v == 2) {
                            $tnstring .= $t2[1] . $t2[($l)];
                        } else {
                            $tnstring .= $t1[$v] . $t2[($l)];
                        }
                    }
                }
            }
            if ($countval >= 1) {
                $v = substr($val, -1, 1);
                if ($v > 0) {
                    if ($v == 1 && $countval > 1 && substr($val, -2, 1) > 0) {
                        $tnstring .= $t2[0];
                    } else {
                        $tnstring .= $t1[$v];
                    }
                }
            }
            $nstring[$i] .= $tnstring;
        }
    }
    $rstring = "";
    if (!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])) {
        if ($nstring[0] == "")
            $nstring[0] = $t1[0];
        $rstring .= $nstring[0] . "บาท";
    }
    if (count($number) == 1 || empty($nstring[1])) {
        $rstring .= "ถ้วน";
    } else {
        $rstring .= $nstring[1] . "สตางค์";
    }
    return $rstring;
}

function get_bill_product($billpro_id) {
    $sql_billpro = "SELECT * FROM bill_out_product WHERE billoutpro_id = $billpro_id";
    $query_billpro = mysql_query($sql_billpro) or die(mysql_error());
    $result = mysql_fetch_assoc($query_billpro);
    return $result;
    /* return array(
      'billinpro_id' => $result['billinpro_id'],
      'pro_code' => $result['pro_code'],
      'billinpro_noinbill' => $result['billinpro_noinbill'],
      'billinpro_nocount' => $result['billinpro_nocount'],
      'billinpro_unitprice' => $result['billinpro_unitprice'],
      'billinpro_totalprice' => $result['billinpro_totalprice'],
      'billin_id' => $result['billin_id'],
      'billinpro_createdate' => $result['billinpro_createdate'],
      ); */
}
