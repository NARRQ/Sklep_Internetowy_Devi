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
            <div class="kolumna_kontakt kontakt" id="kontakt">
                <h2>Kontakt</h2>
                <p>Tu będzie wyświetlany tekst kontaktowy.</p>
                <?php
                // Tutaj możesz dodać kod PHP do pobrania i wyświetlenia tekstu kontaktowego z bazy danych
                ?>
            </div>
            <div class="kolumna_kontakt mapa" id="mapa">
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
</body>
</html>