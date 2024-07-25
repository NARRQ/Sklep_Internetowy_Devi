<?php
include_once('config.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["login"]);
    $password = test_input($_POST["haslo"]);

    // Validate input
    if (empty($username) || empty($password)) {
        header('Location: login.php?info=empty');
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin WHERE login = :login LIMIT 1");
    $stmt->bindParam(':login', $username);
    $stmt->execute();

    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the user and password
    // if ($user && password_verify($password, $user['haslo'])) -- sprawdzenie usera i hasla po hashu
    if(($user['login'] == $username) && ($user['haslo'] == $password)) 
    {
        session_start();
        $_SESSION['logged_in'] = $user['id']; // Assumes there's an id field in the admin table
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        header("Location: admin_page.php");
        exit();
    } else {
        header("Location: login.php?info=login_error");
        exit();
    }
}
?>