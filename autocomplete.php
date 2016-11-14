<?php

// db settings
$db_host = 'localhost'; // Name oder IP-Adresse des Server
$db_user = 'root'; // Benutzernamen um sich bei der Datenbank einzuloggen
$db_pass = ''; // Passwort zum Einloggen
$db_database = 'name_der_datenbank';

// connect
$con = mysql_connect($db_host, $db_user, $db_pass);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

// set content-type & charset
mysql_set_charset('utf8', $con);

// select db
mysql_select_db($db_database, $con);

?>
