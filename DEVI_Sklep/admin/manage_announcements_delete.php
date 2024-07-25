<?php
    require('../baza/config.php');
    
    if (isset($_GET['id'])&& is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $query1 = "DELETE FROM lap_zamowienia WHERE id_laptopa=$id";
        $query2 = "DELETE FROM laptopy WHERE id_laptopa=$id";

        if (mysqli_query($conn, $query1)&&mysqli_query($conn, $query2)) {
            echo '<div class="message">Ogłoszenie pomyślnie usunięto</div>';
        } else {
            echo '<div class="message">Błąd usunięcia ogłoszenia: ' . mysqli_error($conn) . '</div>';
        }
        // Redirect to manage_announcements.php after 3 seconds
        echo '<script>
            setTimeout(function() {
                window.location.href = "manage_announcements.php?id=' . $id . '";
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
    <title>Usuwanie ogłoszenia</title>
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