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
    <?php include 'header_kon.php';?>
    
    <main>
        <div class="wiersz_kontakt">
            <div class="kolumna_kontakt" id="kontakt">
                <h2>Kontakt</h2>
                <?php
                // Połączenie z bazą danych
                include '../baza/config.php';
                
                // Pobranie danych z bazy danych
                $sql = "SELECT informacja_opis, nazwa_firmy, miasto, kod_pocztowy, ulica, numer_telefonu, kod_nip, dni_otwarcia, godziny_otwarcia, email FROM informacje WHERE id_info = 1"; // Możesz dostosować warunek WHERE do swoich potrzeb
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    // Wyświetlenie danych z bazy danych
                    while($row = $result->fetch_assoc()) {
                        echo  "<br><strong>".$row['nazwa_firmy']."</strong>" . "</p>";
                        echo  $row['ulica'] . "</p>";
                        echo  $row['kod_pocztowy'] . " ";
                        echo  $row['miasto'] . "</p><br>";
                        echo  "<p><strong>E-mail:</strong> ".$row['email']."</p>";
                        echo "<p><strong>Numer telefonu:</strong> " . $row['numer_telefonu'] . "</p>";
                        echo "<p><strong>NIP:</strong> " . $row['kod_nip'] . "</p><br>";
                        echo "<p><strong>Godziny otwarcia:</strong></p>";
                        echo  $row['dni_otwarcia'] . "</p>";
                        echo  $row['godziny_otwarcia'] . "</p>";
                    }
                } else {
                    echo "<p>Brak danych do wyświetlenia.</p>";
                }

                // Zamknięcie połączenia z bazą danych
                ?>
            </div>
            <div class="kolumna_kontakt" id="mapa">
                <h2>Nasza lokalizacja</h2>
                <div style="max-width:100%;overflow:hidden;color:red;width:500px;height:500px;">
                    <div id="my-map-canvas" style="height:100%; width:100%;max-width:100%;">
                        <iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=DEVI+SYSTEM+Księdza+Jerzego+Popiełuszki+20A/53A,+35-328+Rzeszów&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- STOPKA -->
    <?php include 'footer_kon.php';?>

    <!-- Zamykanie połączenia z bazą danych -->
    <?php $mysqli->close(); ?>
</body>
</html>