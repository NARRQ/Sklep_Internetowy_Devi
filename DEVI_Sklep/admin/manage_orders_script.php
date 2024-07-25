<?php
require('../baza/config.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $query = "";

    // Pobieranie e-maila klienta
    $email_query = "SELECT k.email from zamowienia z JOIN klienci k on k.id_klienta=z.id_klienta WHERE z.id_zamowienia=$id";
    $result = mysqli_query($conn, $email_query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
    } else {
        echo "Nie znaleziono zamówienia o podanym ID.";
        exit;
    }

    switch ($action) {
        case 'zatwierdz':
            $query = "UPDATE zamowienia SET status='W trakcie' WHERE id_zamowienia=$id";
            $subject = "Twoje zamówienie zostało zatwierdzone";
            // $message = "Drogi Kliencie,\n\nTwoje zamówienie nr $id zostało zatwierdzone i jest w trakcie realizacji.\nDEVI Piotr Dąbrowski
            //     \ntel. 669958485
            //     \nhttp://devisystem.pl/
            //     \nfb. https://www.facebook.com/devisystem/";
            $message = '
            <!DOCTYPE html>
                <html lang="pl">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Twoje zamówienie zostało zatwierdzone</title>
                </head>
                <body>
                    <h1>Dzień dobry!</h1>
                    <p>
                        Drogi Kliencie,
                        \n\nTwoje zamówienie nr $id zostało zatwierdzone i jest w trakcie realizacji.    
                    </p>
                    <hr>
                    <p>
                        \nDEVI Piotr Dąbrowski
                        \ntel. 669958485
                        \nhttp://devisystem.pl/
                        \nfb. https://www.facebook.com/devisystem/
                    </p>
                </body>
                </html>
            ';
            break;
        case 'odrzuc':
            $query = "UPDATE zamowienia SET status='Zakończony' WHERE id_zamowienia=$id";
            $subject = "Twoje zamówienie zostało odrzucone";
            $message = '
            <!DOCTYPE html>
                <html lang="pl">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Twoje zamówienie zostało odrzucone</title>
                </head>
                <body>
                    <h1>Dzień dobry!</h1>
                    <p>
                        Drogi Kliencie,
                        \n\nDrogi Kliencie,\n\nTwoje zamówienie nr $id zostało odrzucone.    
                    </p>
                    <hr>
                    <p>
                        \nDEVI Piotr Dąbrowski
                        \ntel. 669958485
                        \nhttp://devisystem.pl/
                        \nfb. https://www.facebook.com/devisystem/
                    </p>
                </body>
                </html>
            ';
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

        // Wysyłanie maila do klienta
        $headers = "From: DEVI <admin@gmail.com>".PHP_EOL.
                   "Reply-To: DEVI <admin@gmail.com>".PHP_EOL.
                   "Content-type: text/plain; charset=utf-8";

        if (mail($email, $subject, $message, $headers)) {
            echo '<div class="message"><p>E-mail został wysłany na adres: ' . $email . '</p></div>';
        } else {
            echo '<div class="message"><p>Nie udało się wysłać wiadomości.</p></div>';
        }
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
    <title>Document</title>
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
