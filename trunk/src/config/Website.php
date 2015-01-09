<?php

define("MAINPAGE", "login.php");

function MsgBox($color, $msg) {

    $alert = '<div class="uk-alert uk-alert-' . $color . '">';
    $alert .= $msg;
    $alert .= '</div>';
    return $alert;
}

function ReturnJson($status, $title, $msg, $url) {
    return json_encode(array(
        'status' => $status,
        'title' => $title,
        'msg' => $msg,
        'url' => $url
    ));
}

function ServerInfo() {
    $indicesServer = array('PHP_SELF',
        'argv',
        'argc',
        'GATEWAY_INTERFACE',
        'SERVER_ADDR',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'SERVER_PROTOCOL',
        'REQUEST_METHOD',
        'REQUEST_TIME',
        'REQUEST_TIME_FLOAT',
        'QUERY_STRING',
        'DOCUMENT_ROOT',
        'HTTP_ACCEPT',
        'HTTP_ACCEPT_CHARSET',
        'HTTP_ACCEPT_ENCODING',
        'HTTP_ACCEPT_LANGUAGE',
        'HTTP_CONNECTION',
        'HTTP_HOST',
        'HTTP_REFERER',
        'HTTP_USER_AGENT',
        'HTTPS',
        'REMOTE_ADDR',
        'REMOTE_HOST',
        'REMOTE_PORT',
        'REMOTE_USER',
        'REDIRECT_REMOTE_USER',
        'SCRIPT_FILENAME',
        'SERVER_ADMIN',
        'SERVER_PORT',
        'SERVER_SIGNATURE',
        'PATH_TRANSLATED',
        'SCRIPT_NAME',
        'REQUEST_URI',
        'PHP_AUTH_DIGEST',
        'PHP_AUTH_USER',
        'PHP_AUTH_PW',
        'AUTH_TYPE',
        'PATH_INFO',
        'ORIG_PATH_INFO');

    echo '<table cellpadding="10">';
    foreach ($indicesServer as $arg) {
        if (isset($_SERVER[$arg])) {
            echo '<tr><td>' . $arg . '</td><td>' . $_SERVER[$arg] . '</td></tr>';
        } else {
            echo '<tr><td>' . $arg . '</td><td>-</td></tr>';
        }
    }
    echo '</table>';
}

function List_PersonStatus() {
    $array = array(
        '1' => 'รอ Wait',
        '2' => 'ผู้ดูแลระบบ Admin',
        '3' => 'เจ้าหน้าที่ Officer',
        '4' => 'ลูกค้า Customer',
        '5' => 'Vender',
    );
    return $array;
}

function Get_PersonStatus($params) {
    $array = List_PersonStatus();
    if (!empty($params)):
        $result = "";
        foreach ($array as $key => $value):
            if (strval($key) === strval($params)):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}

function List_StoreContactStatus() {
    // vender,customer
    $array = array(
        'ven' => 'Supplier',
        'cus' => 'Store Site',
    );
    return $array;
}

function Get_StoreContactStatus($params) {
    $array = List_StoreContactStatus();
    if (!empty($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == $params):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}

function List_BillInStatus() {
    $array = array(
        '0' => 'ลบ',
        '1' => 'ปกติ รับของเรียบร้อย',
        '2' => 'อนุมัติ ผ่าน',
        '3' => 'อนุมัติ ไม่ผ่าน'
    );
    return $array;
}
function List_Adjust() {
    $array = array(
        'add' => 'เพิ่ม',
        'remove' => 'ลบออก',
    );
    return $array;
}

function Get_BillInStatus($params) {
    $array = List_BillInStatus();
    if (!empty($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == $params):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}

function Gen_Code($code) {
    $code = intval($code) + 1;
    $nextNumber = "0000000000";
    // 0000000001
    if ($code < 10) { //9
        $nextNumber = "000000000" . $code;
        return $nextNumber;
    } else {
        if ($code < 100) { // 99
            $nextNumber = "00000000" . $code;
            return $nextNumber;
        } else {
            if ($code < 1000) { // 999 
                $nextNumber = "0000000" . $code;
                return $nextNumber;
            } else {
                if ($code < 10000) { // 9999
                    $nextNumber = "000000" . $code;
                    return $nextNumber;
                } else {
                    if ($code < 100000) { // 99999
                        $nextNumber = "00000" . $code;
                        return $nextNumber;
                    } else {
                        if ($code < 1000000) { //999999
                            $nextNumber = "0000" . $code;
                            return $nextNumber;
                        } else {
                            if ($code < 10000000) { //9999999
                                $nextNumber = "000" . $code;
                                return $nextNumber;
                            } else {
                                if ($code < 100000000) { //99999999
                                    $nextNumber = "00" . $code;
                                    return $nextNumber;
                                } else {
                                    if ($code < 1000000000) { //99999999
                                        $nextNumber = "0" . $code;
                                        return $nextNumber;
                                    } else {
                                        return -1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function change_dateFormat($deforeDate, $formatIn, $formatOut) {
    $newDate = "";
    if (!empty($deforeDate)) {
        //    $date = date_create($deforeDate); //'2000-01-01');
        //    return date_format($date, 'Y-m-d');
        $myDateTime = new DateTime($formatIn, $deforeDate); //createFromFormat($formatIn, $deforeDate); //'d/m/Y
        $newDate = $myDateTime->format($formatOut); //'Y-m-d');
    } else {
        $newDate = "";
    }
    return $newDate;
}

function change_dateDMY_TO_YMD($beforDate) {
    $array = explode("/", $beforDate);
    return $array[2] . "-" . $array[1] . "-" . $array[0];
}

function change_dateYMD_TO_DMY($beforDate) {
    if (!empty($beforDate)) {
        $array = explode("-", $beforDate);
        return $array[2] . "/" . $array[1] . "/" . $array[0];
    } else {
        return "";
    }
}

function change_dateTimeFormat($deforeDate) {
    $myDateTime = DateTime::createFromFormat('d/m/Y', $deforeDate);
    return $myDateTime->format('Y-m-d H:i:s');
}

function getMonthFullThai() {
    $months = array();
    $ArrayMonths = array('-- Select --', 'มกราคม', 'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน ',
        'ตุลาคม',
        'พฤศจิกายน',
        'ธันวาคม');
    for ($i = 0; $i < count($ArrayMonths); $i++):
        if ($i > 0) {
            if ($i < 10):
                $months["0" . $i] = $ArrayMonths[$i];
            else:
                $months[$i] = $ArrayMonths[$i];
            endif;
        }else {
            $months[''] = '-- Select --';
        }
    endfor;
    return $months;
}

function getYearAD($length = null) {
    $years = array();
    $years[''] = '-- Select --';
    $currentyear = date('Y');
    if (empty($length)) {
        $length = 10;
    }
    for ($i = 0; $i < $length; $i++):
        $year = ($currentyear - $i);
        $years[$year] = $year;

    endfor;
    return $years;
}
