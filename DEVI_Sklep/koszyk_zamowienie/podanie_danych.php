<?php
session_start();
include '../baza/config.php';

// Check if the cart session is set and not empty
if (!isset($_SESSION['koszyk']) || empty($_SESSION['koszyk'])) {
    header('Location: koszyk.php');
    exit();
}

// Function to calculate the total cart sum including delivery cost
function oblicz_sume_koszyka($koszyk, $deliveryOption) {
    $suma = 0;
    foreach ($koszyk as $produkt) {
        $suma += $produkt['cena'] * $produkt['ilosc'];
    }
    
    // Check if delivery option is set and add its cost
    if ($deliveryOption) {
        foreach ($_SESSION['delivery_options'] as $option) {
            if ($option['id_dostawy'] === $deliveryOption) { // Note the comparison here
                $suma += $option['cena_dostawy'];
                break;
            }
        }
    }
    
    return $suma;
}

$selectedOptionId = isset($_SESSION['delivery_option']) ? intval($_SESSION['delivery_option']) : 0;
$suma_koszyka = oblicz_sume_koszyka($_SESSION['koszyk'], $selectedOptionId);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $imie = htmlspecialchars($_POST['imie']);
    $nazwisko = htmlspecialchars($_POST['nazwisko']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $dodatkowe_informacje = htmlspecialchars($_POST['dodatkowe_informacje']);

    $errors = [];
    if (empty($imie)) $errors[] = 'Imię jest wymagane.';
    if (empty($nazwisko)) $errors[] = 'Nazwisko jest wymagane.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adres e-mail jest niepoprawny.';
    if (empty($telefon)) $errors[] = 'Telefon jest wymagany.';

    if (empty($errors)) {
        // Insert client data into the klienci table
        $sql_klienci = "INSERT INTO klienci (imie, nazwisko, email, telefon) VALUES (?, ?, ?, ?)";
        $stmt_klienci = $conn->prepare($sql_klienci);
        $stmt_klienci->bind_param("ssss", $imie, $nazwisko, $email, $telefon);

        if ($stmt_klienci->execute()) {
            $id_klienta = $stmt_klienci->insert_id;

            // Insert the order into the zamowienia table
            $status = 'Nowe'; // Assuming 'Nowe' as a default status
            $data_zamowienia = date('Y-m-d H:i:s'); // Current date and time
            $id_dostawy = isset($_SESSION['delivery_option']) ? intval($_SESSION['delivery_option']) : 0;

            // Debugowanie
            echo 'Wybrana opcja dostawy (ID): ' . $id_dostawy;

            $sql_zamowienia = "INSERT INTO zamowienia (status, id_klienta, data_zamowienia, dodatkowe_informacje, cena_calkowita, id_dostawy) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_zamowienia = $conn->prepare($sql_zamowienia);
            $stmt_zamowienia->bind_param("sissdi", $status, $id_klienta, $data_zamowienia, $dodatkowe_informacje, $suma_koszyka, $id_dostawy);

            if ($stmt_zamowienia->execute()) {
                $id_zamowienia = $stmt_zamowienia->insert_id;

                // Insert order details into the lap_zamowienia table
                $sql_lap_zamowienia = "INSERT INTO lap_zamowienia (id_zamowienia, id_laptopa, ilosc, cena_razem) VALUES (?, ?, ?, ?)";
                $stmt_lap_zamowienia = $conn->prepare($sql_lap_zamowienia);

                foreach ($_SESSION['koszyk'] as $id_laptopa => $produkt) {
                    $ilosc = $produkt['ilosc'];
                    $cena_razem = $produkt['cena'] * $ilosc;

                    $stmt_lap_zamowienia->bind_param("iiid", $id_zamowienia, $id_laptopa, $ilosc, $cena_razem);
                    $stmt_lap_zamowienia->execute();
                }

                // Clear the cart session
                unset($_SESSION['koszyk']);
                header('Location: podsumowanie.php');
                exit();
            } else {
                $errors[] = 'Błąd przy zapisie zamówienia do bazy.';
            }
        } else {
            $errors[] = 'Błąd przy zapisie danych klienta do bazy.';
        }
    }
}



// Get the saved delivery options from the session
$deliveryOptions = isset($_SESSION['delivery_options']) ? $_SESSION['delivery_options'] : array();
$selectedOption = isset($_SESSION['delivery_option']) ? $_SESSION['delivery_option'] : 0;

// Find the description for the selected delivery option
$delivery_option_message = 'Nie wybrano opcji dostawy';
foreach ($deliveryOptions as $option) {
    if ($option['id_dostawy'] == $selectedOption) {
        $delivery_option_message = $option['nazwa'] . ' - ' . $option['cena_dostawy'] . ' zł';
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podaj dane</title>
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
            justify-content: space-between;
            align-items: flex-start;
            margin: 20px auto;
            padding: 20px 60px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            position: relative;
        }

        .form-section {
            width: 60%;
        }

        .summary-section {
            width: 55%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 70%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .form-group .error {
            color: #f44336;
            font-size: 14px;
        }

        .submit-button {
            background-color: #555555;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            max-width: 150px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        .summary {
            background-color: #f9f9f9;
            padding: 10px;
            width: 100%;
            padding-top: 10px;
            margin-right: 300px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 30px;
        }

        .summary h2 {
            margin-top: 0;
        }

        .summary ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .summary ul li {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            align-items: center; /* Wyrównanie elementów pionowo */
        }

        .cart-item {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .cart-item img {
            width: 100px; /* Szerokość miniatury */
            height: 100px; /* Wysokość miniatury */
            object-fit: cover; /* Dopasowanie obrazu do wymiarów */
            margin-right: 15px; /* Odstęp między miniaturą a szczegółami */
        }

        .cart-item-details {
            display: flex;
            flex-direction: column; /* Ustaw szczegóły w kolumnie */
        }

        .cart-item-details h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }

        .cart-item-details p {
            margin: 0;
            font-size: 14px;
        }

        .total {
            font-weight: bold;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <!-- NAGŁÓWEK -->
    <?php include '../koszyk_zamowienie/header_k.php'; ?>

    <main>
        <div class="container">
            <!-- Formularz -->
            <div class="form-section">
                <?php
                if (!empty($errors)) {
                    echo '<div class="errors">';
                    foreach ($errors as $error) {
                        echo '<p class="error">' . htmlspecialchars($error) . '</p>';
                    }
                    echo '</div>';
                }
                ?>

                <form action="podanie_danych.php" method="POST">
                    <div class="form-group">
                        <label for="imie">Imię:</label>
                        <input type="text" id="imie" name="imie" value="<?php echo isset($_POST['imie']) ? htmlspecialchars($_POST['imie']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nazwisko">Nazwisko:</label>
                        <input type="text" id="nazwisko" name="nazwisko" value="<?php echo isset($_POST['nazwisko']) ? htmlspecialchars($_POST['nazwisko']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Adres e-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefon">Telefon:</label>
                        <input type="text" id="telefon" name="telefon" value="<?php echo isset($_POST['telefon']) ? htmlspecialchars($_POST['telefon']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="dodatkowe_informacje">Dodatkowe informacje:</label>
                        <textarea id="dodatkowe_informacje" name="dodatkowe_informacje"><?php echo isset($_POST['dodatkowe_informacje']) ? htmlspecialchars($_POST['dodatkowe_informacje']) : ''; ?></textarea>
                    </div>
                    <button type="submit" name="submit" class="submit-button">Zatwierdź</button>
                </form>
            </div>

            <!-- Podsumowanie koszyka -->
            <div class="summary-section">
                <div class="summary">
                    <h2>Podsumowanie Koszyka</h2>
                    <ul>
                        <?php foreach ($_SESSION['koszyk'] as $id_laptopa => $produkt): ?>
                            <li>
                                <div class="cart-item">
                                    <img src="../upolads/<?php echo htmlspecialchars($produkt['miniatura']); ?>" alt="laptop">
                                    <div class="cart-item-details">
                                        <h3><?php echo htmlspecialchars($produkt['nazwa']); ?></h3>
                                        <p>Ilość: <?php echo htmlspecialchars($produkt['ilosc']); ?></p>
                                        <p>Cena: <?php echo htmlspecialchars($produkt['cena']); ?> zł</p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="total">
                        Suma: <?php echo number_format($suma_koszyka, 2, ',', ''); ?> PLN
                    </div>
                    <div class="delivery-option">
                        <h4>Wybrana opcja dostawy:</h4>
                        <p><?php echo htmlspecialchars($delivery_option_message); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../koszyk_zamowienie/footer_k.php'; ?>
</body>
</html>
