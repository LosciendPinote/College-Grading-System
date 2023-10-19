<?php



$db_host = 'localhost';
$db_name = 'djemfcst_db';
$db_username = 'root';
$db_password = '';

$dsn = "mysql:host=$db_host;dbname=$db_name";

try {
   $db_con = new PDO($dsn,$db_username,$db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET SESSION SQL_BIG_SELECTS=1'));
   

} catch (PDOException $e) {
    die('Connection Lost: '. $e->getMessage());
}




