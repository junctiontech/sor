<?php

$db_connect = mysql_connect ("localhost","root","") or die("Error 1");
$db_select = mysql_select_db("dev_sor", $db_connect) or die("Error 2");

?>