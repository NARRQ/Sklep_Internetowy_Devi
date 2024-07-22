<?php

// $conn = "";

// try {
//     $host = 'localhost';
//     $db = 'sklepinternetowydevi';  
//     $user = 'root';  // nazwa do zmiany
//     $pass = '';  // haslo do zmiany
    
// 	$conn = new PDO(
// 		"mysql:host=$host; dbname=sklepinternetowydevi",
// 		$user, $pass
// 	);
	
// $conn->setAttribute(PDO::ATTR_ERRMODE,
// 					PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOException $e) {
// 	echo "Connection failed: " . $e->getMessage();
// }
    $host="localhost";
    $user="root";
    $pass="";
    $database="sklepinternetowydevi";

    $conn=@mysqli_connect($host,$user,$pass,$database);
    if(!$conn){
        echo "Brak połączenia";
        exit();
    }
?>
