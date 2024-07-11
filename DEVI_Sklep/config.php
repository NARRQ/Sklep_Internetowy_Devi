<?php
$host = 'localhost';
$db = 'sklepinternetowydevi';  
$user = 'root';  // nazwa do zmiany
$pass = '';  // haslo do zmiany

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection error: ' . $mysqli->connect_error);
}
?>
