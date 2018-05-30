<?php


$dbhost = 'localhost';
$dbname = 'vpscogni_herdesire';
$dbuser = 'root';
$dbpass = 'mysql';



$mysqli = new mysqli($dbhost, $dbuser, $dbpass);

$mysqli->select_db($dbname);

if(mysqli_connect_errno()){
    die ("Unable to connect to Database");
}

?>