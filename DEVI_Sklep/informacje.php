<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEVI - Sprzedaż laptopów poleasingowych</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header.php'; ?>

    <informacje>
        <?php
        // Wczytaj konfigurację bazy danych
        include 'baza/config.php';

        $info_id = 1;
        $sql = "SELECT informacja_opis FROM informacje WHERE id_info = $info_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $informacja_opis = $row["informacja_opis"];
        } else {
            $informacja_opis = "Brak informacji";
        }
        ?>

        <!-- Wyświetlenie tekstu z numerem zamówienia i opisu dostawy -->
        <div class="informacje">
            <?php
            echo nl2br($informacja_opis);
            ?>
        </div>
    </informacje>

    <!-- STOPKA -->
    <?php include 'footer.php'; ?>

    <!-- Zamykanie połączenia z bazą danych -->
    <?php $conn->close(); ?>
</body>
</html>