<!-- <?php
$host = 'localhost';
$db = 'sklepinternetowydevi';  
$user = 'root';  // nazwa do zmiany
$pass = '';  // haslo do zmiany

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection error: ' . $mysqli->connect_error);
}
?> -->
<?php

$conn = "";

try {
    $host = 'localhost';
    $db = 'sklepinternetowydevi';  
    $user = 'root';  // nazwa do zmiany
    $pass = '';  // haslo do zmiany
    
	$conn = new PDO(
		"mysql:host=$host; dbname=sklepinternetowydevi",
		$user, $pass
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>
