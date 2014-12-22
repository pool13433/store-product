<?php
@session_start();
include '../config/Connect.php';
include '../config/Website.php';
$person = $_SESSION['person'];
$per_id = $person['per_id'];
switch ($_GET['method']) {
    case 'create':
//{"tax_code":"11","Invoices_code":"0000000001","in_date":"02/12/2014",
//"store_id":"1","store_name":"ven0000000001","fname":"222",
//"store_address":"ร้านขายพาสติก","doc_code":"11","doc_date":"02/12/2014",
//"pay_condition":"1","finfish_date":"11/12/2014","pay_code":"222"}
        $form = json_decode($_POST['form'], true);
        $bill_id = $form['bill_id'];
        $tax_code = $form['tax_code'];
        $Invoices_code = $form['Invoices_code'];
        $in_date = $form['in_date'];
        $store_id = $form['store_id'];
        $store_name = $form['store_name'];
        $store_address = $form['store_address'];
        $doc_code = $form['doc_code'];
        $doc_date = $form['doc_date'];
        $pay_condition = $form['pay_condition'];
        $finfish_date = $form['finfish_date'];
        $pay_code = $form['pay_code'];
        $officer_id = $form['officer_id'];
        $location = $form['location'];
        $weight = $form['weight'];
        $pricebeforevat = $form['pricebeforevat'];
        $vat = $form['vat'];
        $priceaftervat = $form['priceaftervat'];
        $sender_name = $form['sender_name'];
        $receiver_name = $form['receiver_name'];
        $autherized_name = $form['autherized_name'];
        // ######## INSERT BILL_IN ##########
        if (empty($form['bill_id'])) { // INSERT NEW BILL
            $sql_bill = "INSERT INTO bill_in (`billin_invoicescode`,";
            $sql_bill .= " `billin_taxcode`, `billin_indate`, `store_id`, `billin_doccode`,";
            $sql_bill .= " `billin_docdate`, `pay_id`, `billin_finishdate`, `billin_paycode`,";
            $sql_bill .= " `officer_id`, `billin_localtioncode`,";
            $sql_bill .= " `billin_weight`, `billin_pricebeforevat`, `billin_vat`,";
            $sql_bill .= " `billin_priceaftervat`, `billin_sender`, `billin_receiver`, `billin_autherized`,";
            $sql_bill .= " `billin_createdate`,`billin_createby`,`billin_updatedate`,`billin_updateby`)VALUES(";
            $sql_bill .= " '$Invoices_code',";
            $sql_bill .= " '$tax_code','" . change_dateDMY_TO_YMD($in_date) . "','$store_id','$doc_code',";
            $sql_bill .= " '" . change_dateDMY_TO_YMD($doc_date) . "','$pay_condition','" . change_dateDMY_TO_YMD($finfish_date) . "','$pay_code',";
            $sql_bill .= " $officer_id,'$location',";
            $sql_bill .= " $weight,$pricebeforevat,$vat,$priceaftervat,";
            $sql_bill .= " '$receiver_name','$sender_name','$autherized_name',";
            $sql_bill .= " NOW(),$per_id,NOW(),$per_id";
            $sql_bill .= " )";
        } else {
            $sql_bill = " UPDATE bill_in SET ";
            $sql_bill .= " billin_invoicescode = '$Invoices_code',";
            $sql_bill .= " billin_taxcode = '$tax_code',";
            $sql_bill .= " billin_indate = '" . change_dateDMY_TO_YMD($in_date) . "',";
            $sql_bill .= " store_id = $store_id,";
            $sql_bill .= " billin_doccode = '$doc_code',";
            $sql_bill .= " billin_docdate = '" . change_dateDMY_TO_YMD($doc_date) . "',";
            $sql_bill .= " pay_id = $pay_condition,";
            $sql_bill .= " billin_finishdate = '" . change_dateDMY_TO_YMD($finfish_date) . "',";
            $sql_bill .= " billin_paycode = '$pay_code',";
            $sql_bill .= " officer_id = $officer_id,";
            $sql_bill .= " billin_localtioncode = '$location',";
            $sql_bill .= " `billin_weight`=$weight,";
            $sql_bill .= " `billin_pricebeforevat`=$pricebeforevat,";
            $sql_bill .= " `billin_vat`= $vat,";
            $sql_bill .= " `billin_priceaftervat`=$priceaftervat,";
            $sql_bill .= " `billin_sender`='$sender_name',";
            $sql_bill .= " `billin_receiver`='$receiver_name',";
            $sql_bill .= " `billin_autherized`='$autherized_name',";
            $sql_bill .= " billin_updatedate = NOW(),";
            $sql_bill .= " billin_updateby = $per_id";
            $sql_bill .= " WHERE billin_id = $bill_id";
        }
        //echo ' sql_bill : ' + $sql_bill;
        $query_bill = mysql_query($sql_bill) or die(mysql_error());
        $insert_bill_id = mysql_insert_id();
        // ######## INSERT BILL_IN ##########

        if (empty($insert_bill_id)) {
            $insert_bill_id = $bill_id;
        }

        if ($query_bill) {
//            $sql_remove = " DELETE FROM bill_in_product WHERE  billin_id = $bill_id";
//            mysql_query($sql_remove) or die(mysql_error());

            $list_product = json_decode($_POST['list_product'], true);
            if (count($list_product) > 0):
                foreach ($list_product as $object):
                    //[{"pro_code":"0000000004","pro_no":"1","pro_price":"1","pro_discount":"1","pro_total_price":"1"}]
                    $billpro_id = $object['pro_id'];
                    $pro_name = $object['pro_name'];
                    $pro_code = $object['pro_code'];
                    $pro_nobill = $object['pro_noinbill'];
                    $pro_nocount = $object['pro_nocount'];
                    $pro_remark = $object['pro_remark'] != "" ? $object['pro_remark'] : "";
                    $pro_type = $object['pro_type'];
                    $pro_price = $object['pro_price'];
                    $pro_discount = $object['pro_discount'];
                    $pro_total_price = $object['pro_total_price'];

                    //
                    //#########GET BILL PRODUCT ############                
                    $product_stock = get_product_no($pro_code);

                    if (empty($form['bill_id'])) : // new แสดงว่า ไปบวก ของเข้าสต๊อกอย่างเดียว
                        ######## UPDATE PRODUCT NO ##########                    
                        $sql_product = " UPDATE `product` SET ";
                        $sql_product .= " pro_unitprice = $pro_price,";
                        $sql_product .= " `pro_amount`= " . ($pro_nocount + intval($product_stock['pro_amount'])) . ",";
                        $sql_product .= " pro_discount = $pro_discount,";
                        $sql_product .= " pro_createdate = NOW()";
                        $sql_product .= " WHERE pro_code = '$pro_code'";
                        $query_product = mysql_query($sql_product) or die(mysql_error() . " SQL : " . $sql_product);
                        $row_update = mysql_affected_rows();
                    ######## UPDATE PRODUCT NO ##########
                    else : // edit ต้องดู จำนวนที่แก้ไข
                        $difference_nocount = 0;
                        $difference_price = 0;
                        $difference_discount = 0;

                        // ####### กรณี ค่าที่แก้ไข น้อยกว่าของเดิม ########
                        // ########## number_count ##############
                        //var_dump($billpro_old);
                        /* echo '---------------------------------------------------------------------------------------------------------';
                          echo ' # billpro_old = billinpro_nocount => ' . $billpro_old['billinpro_nocount'];
                          echo ' # pro_nocount => ' . $pro_nocount;
                          echo '---------------------------------------------------------------------------------------------------------';
                          echo ' # billpro_old = billinpro_unitprice =>' . $billpro_old['billinpro_unitprice'];
                          echo ' # pro_price => ' . $pro_price;
                          echo '---------------------------------------------------------------------------------------------------------';
                          echo ' # billpro_old = billinpro_discount => ' . $billpro_old['billinpro_discount'];
                          echo ' # pro_discount => ' . $pro_discount;
                          echo '---------------------------------------------------------------------------------------------------------';
                          echo '##############################'; */


                        if (!empty($object['pro_id'])) {
                            $billpro_old = get_bill_product($billpro_id);

                            $difference_nocount = $billpro_old['billinpro_nocount'] - $pro_nocount;
                            if ($difference_nocount != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_amount = " . ($product_stock['pro_amount'] - $difference_nocount);
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }

                            $difference_price = $billpro_old['billinpro_unitprice'] - $pro_price;
                            if ($difference_price != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_unitprice = .$pro_price";
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }
                            $difference_discount = $billpro_old['billinpro_discount'] - $pro_discount;
                            if ($difference_discount != 0) {
                                // ######## UPDATE STOCK #########
                                $sql_update = "UPDATE product SET ";
                                $sql_update .= " pro_discount = $pro_discount";
                                $sql_update .= " WHERE pro_code = '$pro_code'";
                                mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                                // ######## UPDATE STOCK #########
                            }
                            /* if ($billpro_old['billinpro_nocount'] > $pro_nocount) {
                              $difference_nocount = $billpro_old['billinpro_nocount'] - $pro_nocount;
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_amount = " . ($product_stock['pro_amount'] - $difference_nocount);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                              ;
                              // ######## UPDATE STOCK #########
                              } else if ($billpro_old['billinpro_nocount'] < $pro_nocount) {
                              $difference_nocount = $pro_nocount - $billpro_old['billinpro_nocount'];
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_amount = " . ($product_stock['pro_amount'] + $difference_nocount);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);

                              // ######## UPDATE STOCK #########
                              }
                              // ########## number_count ##############
                              //
                              // ########## price ##############
                              if ($billpro_old['billinpro_unitprice'] > $pro_price) {
                              $difference_price = $billpro_old['billinpro_unitprice'] - $pro_price;
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_unitprice = " . ($product_stock['pro_unitprice'] - $difference_price);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);

                              // ######## UPDATE STOCK #########
                              } else if ($billpro_old['billinpro_unitprice'] < $pro_price) {
                              $difference_price = $pro_price - $billpro_old['billinpro_unitprice'];
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_unitprice = " . ($product_stock['pro_unitprice'] + $difference_price);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                              // ######## UPDATE STOCK #########
                              }
                              // ########## price ##############
                              //
                              // ########## discount ##############
                              if ($billpro_old['billinpro_discount'] > $pro_discount) {
                              $difference_discount = $billpro_old['billinpro_unitprice'] - $pro_discount;
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_discount = " . ($product_stock['pro_discount'] - $difference_discount);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                              // ######## UPDATE STOCK #########
                              } else if ($billpro_old['billinpro_discount'] < $pro_discount) {
                              $difference_discount = $pro_discount - $billpro_old['billinpro_unitprice'];
                              // ######## UPDATE STOCK #########
                              $sql_update = "UPDATE product SET ";
                              $sql_update .= " pro_discount = " . ($product_stock['pro_discount'] + $difference_discount);
                              $sql_update .= " WHERE pro_code = '$pro_code'";
                              mysql_query($sql_update) or die(mysql_error() . " SQL : " . $sql_update);
                              // ######## UPDATE STOCK #########
                              }
                              // ########## discount ##############
                             */
                        }
                    endif;

                    if (empty($object['pro_id'])) {
                        // ######## INSERT BILL_PRODUCT ##########                        
                        $sql_bill_product = " INSERT INTO `bill_in_product`(";
                        $sql_bill_product .= "  `pro_code`, `billinpro_noinbill`, `billinpro_unitprice`,";
                        $sql_bill_product .= "  `billinpro_nocount`,`billinpro_remark`,";
                        $sql_bill_product .= " `billinpro_totalprice`, `billin_id`,`billinpro_discount`, `billinpro_createdate`) VALUES (";
                        $sql_bill_product .= " '$pro_code',$pro_nobill,$pro_price,";
                        $sql_bill_product .= " $pro_nocount,'$pro_remark',";  //'" . mysql_real_escape_string($pro_remark) . "',";
                        $sql_bill_product .= " $pro_total_price,$insert_bill_id,$pro_discount,NOW()";
                        $sql_bill_product .= " )";
                        // ######## INSERT BILL_PRODUCT ##########
                    } else {
                        // ######## UPDATE BILL_PRODUCT ##########
                        // echo 'billpro_id : ' . $billpro_id;
                        $sql_bill_product = "UPDATE bill_in_product SET ";
                        $sql_bill_product .= " billinpro_noinbill = $pro_nobill,";
                        $sql_bill_product .= " billinpro_nocount = $pro_nocount,";
                        $sql_bill_product .= " billinpro_unitprice = $pro_price,";
                        $sql_bill_product .= " billinpro_remark = '$pro_remark',";
                        $sql_bill_product .= " billinpro_discount = $pro_discount";
                        $sql_bill_product .= " WHERE billinpro_id = $billpro_id";
                        // ######## UPDATE BILL_PRODUCT ##########
                    }

                    mysql_query($sql_bill_product) or die(mysql_error() . 'SQL : ' . $sql_bill_product);
                    // ######## INSERT BILL_PRODUCT ##########                    

                endforeach;
            endif;

            $list_remove = json_decode($_POST['list_product_remove'], true);

            if (count($list_remove) > 0):

                foreach ($list_remove as $object):
                    $billpro_id = $object['pro_id'];
                    $pro_name = $object['pro_name'];
                    $pro_code = $object['pro_code'];
                    $pro_nobill = $object['pro_noinbill'];
                    $pro_nocount = $object['pro_nocount'];
                    $pro_remark = $object['pro_remark'];
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
                    $sql_remove = "DELETE FROM bill_in_product WHERE billinpro_id = " . $object['pro_id'];
                    mysql_query($sql_remove) or die(mysql_error());
                endforeach;
            // ######### Remove ######
            endif;

            echo ReturnJson('success', 'บันทึก', 'บันทึกสำเร็จ', 'index.php?page=manage_bill_in');
        }
        break;
    case 'get_pro_product_by_biil_id':
        $bill_id = $_POST['bill_id'];
        $sql = "SELECT * FROM bill_in_product bp";
        $sql .= " JOIN product p ON bp.pro_code = p.pro_code";
        $sql .= " JOIN type t ON t.type_id = p.type_id";
        $sql .= " WHERE bp.billin_id = $bill_id";
        $query = mysql_query($sql) or die(mysql_error());
        $data = array();
        while ($row = mysql_fetch_array($query)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;
    case 'delete':
        $id = $_GET['id'];
        //$sql = "DELETE FROM bill_in WHERE billin_id=$id";
        $sql = " UPDATE bill_in SET ";
        $sql .= " billin_status = 0";
        $sql .= " WHERE billin_id = $id";
        $query = mysql_query($sql) or die(mysql_error());
        if ($query)
            echo ReturnJson('success', '', 'ลบสำเร็จ', '');
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

function genProductCode() {
    //################# GENARATE CODE ############
    $sql = "SELECT pro_code FROM product ORDER BY pro_code DESC LIMIT 0,1";
    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);
    $last_code = substr($result['pro_code'], 4);
    return Gen_Code(intval($last_code));
    //################# GENARATE CODE ############
}

function get_bill_product($billpro_id) {
    $sql_billpro = "SELECT * FROM bill_in_product WHERE billinpro_id = $billpro_id";
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
