<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
    // Redirect to login page if not authenticated
    header('Location: login.php?info=not_logged_in');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 10;
	        padding: 0;
        }
        main {
            padding: 100px;
        }
        .login-container {
            width: 100%;
            margin: 10 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
	        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	        align-self: center;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        button {
            background-color: #555555;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            margin: 10px;
            display: inline-block;
        }
        button a {
            color: #fff;
            text-decoration: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form textarea {
            resize: vertical;
            height: 500px;
        }
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .image-preview-container img {
            max-width: 100px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header_admin.php';?>
    <main>
    <div class="login-container">
        <h1>Panel Administratora</h1>
        <div>
            <button><a href="dodaj_ogloszenie/add_announcement.php">Dodaj <br> ogłoszenie</a></button>
            <button><a href="zarzadzaj_ogloszeniami/manage_announcements.php">Zarządzaj <br> ogłoszeniami</a></button>
        </div>
        <br>
        <div>
            <button><a href="zarzadzaj_zamowieniami/manage_orders.php">Zarządzaj <br> zamówieniami</a></button>
            <button><a href="edytuj_informacje/edit_information.php">Edytuj  <br>informacje</a></button>
        </div>
    </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
