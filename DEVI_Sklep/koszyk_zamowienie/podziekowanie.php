<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEVI - Sprzedaż laptopów poleasingowych</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header.php';?>
    <main>
        <?php
        // Wczytaj konfigurację bazy danych
        include '../baza/config.php';

        // Pobierz numer zamówienia i id_dostawy z bazy danych
        $order_id = 3; // Zakładamy, że chcesz pobrać zamówienie o ID 3
        $sql = "SELECT id_zamowienia, id_dostawy FROM zamowienia WHERE id_zamowienia = $order_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Pobierz dane zamówienia
            $row = $result->fetch_assoc();
            $id_zamowienia = $row["id_zamowienia"];
            $delivery_id = $row["id_dostawy"];
        } else {
            $id_zamowienia = "brak numeru zamówienia";
            $delivery_id = null;
        }

        // Pobierz podziekowanie_opis z tabeli dostawa dla danego id_dostawy
        if ($delivery_id) {
            $sql = "SELECT podziekowanie_opis FROM dostawa WHERE id_dostawy = $delivery_id";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $podziekowanie_opis = $row["podziekowanie_opis"];
            } else {
                $podziekowanie_opis = "Brak opisu dostawy dla ID $delivery_id";
            }
        } else {
            $podziekowanie_opis = "Brak powiązanego ID dostawy.";
        }
        ?>

        <!-- Wyświetlenie tekstu z numerem zamówienia i opisu dostawy -->
        <div class="main">
            <?php
            $text = "Dziękujemy za złożenie zamówienia!\nPoczekaj aż je potwierdzimy.\n\n<b>nr zamówienia: $id_zamowienia</b>\n\n";
            $text .= $podziekowanie_opis;
            echo nl2br($text);
            ?>
        </div>
    </main>
    <!-- STOPKA -->
    <?php include 'footer.php';?>

    <!-- Zamykanie połączenia z bazą danych -->
    <?php $mysqli->close(); ?>
</body>
</html>