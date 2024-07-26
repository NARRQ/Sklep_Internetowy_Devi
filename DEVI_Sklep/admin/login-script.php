<?php
include_once('config.php');

session_start(); // Moved to the top to ensure session starts early

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
    $stmt = $conn->prepare("SELECT `id_admina`, `login`, `haslo` FROM `admin` WHERE login = :login LIMIT 1");
    
    // Bind the parameters to prevent SQL injection
    $stmt->bindParam(':login', $username, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();

    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['haslo'])) {
        $_SESSION['logged_in'] = $user['id_admina']; // Assuming 'id_admina' is the correct column name for user ID
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        header("Location: admin_page.php");
        exit();
    } else {
        header("Location: login.php?info=login_error");
        exit();
    }
}
?>
