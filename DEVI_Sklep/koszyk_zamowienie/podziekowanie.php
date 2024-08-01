<?php
session_start();
include '../baza/config.php';

// Sprawdź, czy podano ID zamówienia w URL
if (!isset($_GET['id_zamowienia'])) {
    header('Location: koszyk.php');
    exit();
}

$id_zamowienia = intval($_GET['id_zamowienia']);

// Pobierz numer zamówienia i id_dostawy z bazy danych
$sql = "SELECT id_zamowienia, id_dostawy FROM zamowienia WHERE id_zamowienia = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_zamowienia);
$stmt->execute();
$result = $stmt->get_result();

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
    $sql = "SELECT podziekowanie_opis FROM dostawa WHERE id_dostawy = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delivery_id);
    $stmt->execute();
    $result = $stmt->get_result();

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
    <?php include 'header_k.php';?>
    <podziekowanie>
        <!-- Wyświetlenie tekstu z numerem zamówienia i opisu dostawy -->
        <div class="podziekowanie">
            <?php
            $text = "Dziękujemy za złożenie zamówienia!\nPoczekaj aż je potwierdzimy.\n\n<b>nr zamówienia: $id_zamowienia</b>\n\n";
            $text .= $podziekowanie_opis;
            echo nl2br($text);
            ?>
        </div>
    </podziekowanie>
    <!-- STOPKA -->
    <?php include 'footer_k.php';?>

    <!-- Zamykanie połączenia z bazą danych -->
    <?php $conn->close(); ?>
</body>
</html>
