<?php

include '../config/Connect.php';

$query = mysql_query("SELECT * FROM person") or die(mysql_error());
$list = array();
while ($row = mysql_fetch_array($query)) {
    $list[] = $row;
}
//var_dump($list);
echo json_encode($list);
