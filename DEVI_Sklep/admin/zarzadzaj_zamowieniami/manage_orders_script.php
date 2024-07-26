<?php
require('../baza/config.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $query = "";

    switch ($action) {
        case 'zatwierdz':
            $query = "UPDATE zamowienia SET status='W trakcie' WHERE id_zamowienia=$id";
            break;
        case 'odrzuc':
            $query = "UPDATE zamowienia SET status='Zakończony' WHERE id_zamowienia=$id";
            break;
        case 'usun':
            $query = "DELETE FROM zamowienia WHERE id_zamowienia=$id";
            break;
        default:
            echo "Nieznana akcja";
            exit;
    }

    if (mysqli_query($conn, $query)) {
        echo '<div class="message">Informacje zostały zaktualizowane pomyślnie.</div>';
    } else {
        echo '<div class="message">Błąd aktualizacji informacji: ' . mysqli_error($conn) . '</div>';
    }

    // Redirect to manage_orders_individual.php after 3 seconds
    echo '<script>
        setTimeout(function() {
            window.location.href = "manage_orders_individual.php?id=' . $id . '";
        }, 3000);
    </script>';
} else {
    echo "Niepoprawne żądanie";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualizacja zamówienia</title>
    <style>
        .message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    
</body>
</html>