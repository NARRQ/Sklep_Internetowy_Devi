<?php
session_start();
include '../baza/config.php'; // Upewnij się, że to jest poprawna ścieżka do Twojego pliku z konfiguracją bazy danych

// Obsługuje usunięcie produktu
if (isset($_GET['remove'])) {
    $id_laptopa = intval($_GET['remove']);
    if (isset($_SESSION['koszyk'][$id_laptopa])) {
        unset($_SESSION['koszyk'][$id_laptopa]);
    }
}

// Obsługuje aktualizację ilości
if (isset($_POST['update'])) {
    $id_laptopa = intval($_POST['id_laptopa']);
    $ilosc = intval($_POST['ilosc']);

    if (isset($_SESSION['koszyk'][$id_laptopa])) {
        if ($ilosc > 0) {
            $_SESSION['koszyk'][$id_laptopa]['ilosc'] = $ilosc;
        } else {
            // Usuń produkt z koszyka, jeśli ilość jest zerowa lub ujemna
            unset($_SESSION['koszyk'][$id_laptopa]);
        }
    }
}

// Przekierowanie do podanie_danych.php po kliknięciu "Zamawiam"
if (isset($_POST['checkout'])) {
    // Sprawdź, czy opcja dostawy została wybrana
    if (isset($_POST['delivery_option'])) {
        $delivery_option = $_POST['delivery_option'];
        $_SESSION['delivery_option'] = $delivery_option;
    } else {
        // Jeśli opcja dostawy nie została wybrana, ustaw domyślną wartość lub obsłuż błąd
        $_SESSION['delivery_option'] = '';
    }

    // Przekierowanie na stronę z danymi osobowymi
    header('Location: http://localhost/DEVI_Sklep/koszyk_zamowienie/podanie_danych.php');
    exit();
}

// Pobierz dane koszyka
if (isset($_GET['id_laptopa']) && isset($_GET['ilosc'])) {
    $id_laptopa = intval($_GET['id_laptopa']);
    $ilosc = intval($_GET['ilosc']);

    // Pobierz dane laptopa z bazy danych
    $stmt = $conn->prepare("SELECT miniatura, nazwa, cena FROM laptopy WHERE id_laptopa = ?");
    $stmt->bind_param('i', $id_laptopa);
    $stmt->execute();
    $result = $stmt->get_result();
    $laptop = $result->fetch_assoc();

    if ($laptop) {
        $miniatura = $laptop['miniatura'];
        $nazwa = $laptop['nazwa'];
        $cena = $laptop['cena'];

        // Sprawdź, czy koszyk jest już zainicjowany
        if (!isset($_SESSION['koszyk'])) {
            $_SESSION['koszyk'] = array();
        }

        // Dodaj laptop do koszyka
        if (isset($_SESSION['koszyk'][$id_laptopa])) {
            $_SESSION['koszyk'][$id_laptopa]['ilosc'] += $ilosc;
        } else {
            $_SESSION['koszyk'][$id_laptopa] = array(
                'miniatura' => $miniatura,
                'nazwa' => $nazwa,
                'cena' => $cena,
                'ilosc' => $ilosc
            );
        }
    }
    $stmt->close();
    header('Location: koszyk.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            width: 45%;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            position: relative; 
        }

        .cart-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .cart-item-details {
            padding: 20px;
            flex-grow: 1;
        }

        .cart-item-details h3 {
            margin-bottom: 10px;
        }

        .cart-item-details p {
            margin-bottom: 5px;
        }

        .remove-item {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            
            position: absolute; /* Umożliwia pozycjonowanie w obrębie rodzica */
            top: 10px; /* Odstęp od góry kontenera */
            right: 10px; /* Odstęp od prawej krawędzi kontenera */
            width: 30px; /* Rozmiar przycisku */
            height: 30px; /* Rozmiar przycisku */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-item:hover {
            background-color: #d32f2f;
        }

        .update-quantity {
            background-color: #555555;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .update-quantity:hover {
            background-color: #45a049;
        }

        .cart-summary, .shipping-options {
            width: 45%;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .checkout-button {
            background-color: #555555;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .checkout-button:hover {
            background-color: #45a049;
        }
        .shipping-options{
            width: 100%;
        }

        .shipping-options h4 {
            margin-bottom: 15px;
           
        }

        .shipping-options ul {
            list-style: none;
            padding: 0;
        }

        .shipping-options li {
            margin-bottom: 10px;
        }

        .shipping-options input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>
    <script>
        function confirmRemove(event) {
            if (!confirm("Czy na pewno chcesz usunąć ten produkt z koszyka?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <!-- NAGŁÓWEK -->
    <?php include '../koszyk_zamowienie/header_k.php'; ?>
   
    <main>
        <div class="container">
            <?php
            if (isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])) {
                $total = 0;
                foreach ($_SESSION['koszyk'] as $id_laptopa => $item) {
                    $total += $item['cena'] * $item['ilosc'];
                    echo '
                        <div class="cart-item">
                            <img src="upolads/' . htmlspecialchars($item['miniatura']) . '" alt="laptop">
                            <div class="cart-item-details">
                                <h3>' . htmlspecialchars($item['nazwa']) . '</h3>
                                <form action="koszyk.php" method="POST" style="display: flex; align-items: center;">
                                    <input type="hidden" name="id_laptopa" value="' . htmlspecialchars($id_laptopa) . '">
                                    <input type="number" name="ilosc" value="' . htmlspecialchars($item['ilosc']) . '" min="1" style="width: 60px; margin-right: 10px;">
                                    <button type="submit" name="update" class="update-quantity">Zaktualizuj ilość</button>
                                </form>
                                <p>' . htmlspecialchars($item['cena']) . ' zł</p>
                                <a href="koszyk.php?remove=' . urlencode($id_laptopa) . '" onclick="confirmRemove(event)">
                                    <button class="remove-item">X</button>
                                </a>
                            </div>
                        </div>
                    ';
                }
                echo '
                    <div class="cart-summary">
                        <h3>Do zapłaty: ' . htmlspecialchars($total) . ' zł</h3>
                        <form action="koszyk.php" method="POST">
                            <div class="shipping-options">
                                <h4>Wybierz opcję dostawy</h4>
                                <ul>
                                    <li>
                                        <input type="radio" name="delivery_option" id="pickup" value="pickup" ' . (isset($_POST['delivery_option']) && $_POST['delivery_option'] == 'pickup' ? 'checked' : '') . '>
                                        <label for="pickup">(ul. ks. J. Popiełuszki 20a/53a 35-328 Rzeszów) - 0 zł</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="delivery_option" id="delivery" value="delivery" ' . (isset($_POST['delivery_option']) && $_POST['delivery_option'] == 'delivery' ? 'checked' : '') . '>
                                        <label for="delivery">Przesyłka kurierska i przelew na nr konta - 20 zł</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="delivery_option" id="cod" value="cod" ' . (isset($_POST['delivery_option']) && $_POST['delivery_option'] == 'cod' ? 'checked' : '') . '>
                                        <label for="cod">Przesyłka kurierska za pobraniem - 25 zł</label>
                                    </li>
                                </ul>
                            </div>
                            <button type="submit" name="checkout" class="checkout-button">Zamawiam</button>
                        </form>
                    </div>
                ';
            } else {
                echo '<p>Twój koszyk jest pusty.</p>';
            }
            ?>
        </div>
    </main>
    <?php include 'footer_k.php'; ?>
</body>
</html>