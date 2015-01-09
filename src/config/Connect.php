<?php

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "db_store");

$conn = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
if ($conn) {
    mysql_select_db(DATABASE);
    mysql_query("SET NAMES UTF8");
} else {
    die(mysql_error());
}
