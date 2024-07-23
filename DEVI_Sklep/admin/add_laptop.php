<?php
require('../baza/config.php');

// Inicjalizacja zmiennej na komunikat
$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ustawianie zmiennych z danych formularza
    $nazwa = mysqli_real_escape_string($conn, $_POST['name']);
    $producent = mysqli_real_escape_string($conn, $_POST['manufacturer']);
    $procesor = mysqli_real_escape_string($conn, $_POST['processor']);
    $ram = mysqli_real_escape_string($conn, $_POST['ram']);
    $dysk = mysqli_real_escape_string($conn, $_POST['disk']);
    $procesor_sz = mysqli_real_escape_string($conn, $_POST['processor_size']);
    $grafika = mysqli_real_escape_string($conn, $_POST['graphics']);
    $klawiatura = mysqli_real_escape_string($conn, $_POST['keyboard']);
    $przekatna = mysqli_real_escape_string($conn, $_POST['screen_size']);
    $rozdzielczosc = mysqli_real_escape_string($conn, $_POST['resolution']);
    $matryca = mysqli_real_escape_string($conn, $_POST['matrix']);
    $system = mysqli_real_escape_string($conn, $_POST['system']);
    $porty = mysqli_real_escape_string($conn, $_POST['ports']);
    $komunikacja = mysqli_real_escape_string($conn, $_POST['communication']);
    $multimedia = mysqli_real_escape_string($conn, $_POST['multimedia']);
    $stan = mysqli_real_escape_string($conn, $_POST['condition']);
    $czas_pracy = mysqli_real_escape_string($conn, $_POST['working_hours']);
    $zasilacz = mysqli_real_escape_string($conn, $_POST['power_supply']);
    $opis = mysqli_real_escape_string($conn, $_POST['description']);
    $cena = mysqli_real_escape_string($conn, $_POST['price']);
    $ilosc = mysqli_real_escape_string($conn, $_POST['quantity']);
    //brak dodawania zdjęć
    //NIE DZIAŁA :(

    // Przygotowanie zapytania SQL
    $query = "INSERT INTO laptopy (
                nazwa, producent, procesor, ram, dysk, procesor_sz, grafika, klawiatura,
                przekatna, rozdzielczosc, matryca, system, porty, komunikacja, multimedia, stan,
                czas_pracy, zasilacz, opis, cena, ilosc
              ) VALUES (
                '$nazwa', '$producent', '$procesor', '$ram', '$dysk', '$procesor_sz', '$grafika', '$klawiatura',
                '$przekatna', '$rozdzielczosc', '$matryca', '$system', '$porty', '$komunikacja', '$multimedia', '$stan',
                '$czas_pracy', '$zasilacz', '$opis', '$cena', '$ilosc'
              )";

    // Wykonanie zapytania SQL
    if (mysqli_query($conn, $query)) {
        $message = "Dodano nowe ogłoszenie: " . htmlspecialchars($nazwa);
    } else {
        $message = "Błąd dodawania ogłoszenia: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Dodaj ogłoszenie</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 10;
	        padding: 0;
        }
        main {
            padding: 100px;
        }
        .edit-container {
            width: 100%;
            margin: 10 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
	        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	        align-self: center;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        button {
            background-color: #555555;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 10px;
            display: inline-block;
        }
        button a {
            color: #fff;
            text-decoration: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form textarea {
            resize: vertical;
            height: 100px;
        }
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .image-preview-container img {
            max-width: 100px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <script>
        // Function to handle file input change and preview images
        function previewImages(input, previewContainer) {
            var previewDiv = document.getElementById(previewContainer);
            previewDiv.innerHTML = ''; // Clear previous previews

            if (input.files) {
                var filesAmount = input.files.length;
                for (var i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'uploaded-image';
                        previewDiv.appendChild(img);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        // Function to handle main image preview
        function previewMainImage(input) {
            var mainImagePreview = document.getElementById('main-image-preview');
            mainImagePreview.innerHTML = ''; // Clear previous preview

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.src = event.target.result;
                    img.className = 'uploaded-image';
                    mainImagePreview.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body>
    <!-- NAGŁÓWEK -->
    <?php include 'header_admin.php'; ?>
    <main>
        <div class="edit-container">
            <h1>Panel Administratora - Dodaj ogłoszenie</h1>
            <button><a href="admin_page.php">Panel Administratora</a></button>
            <!-- Wyświetlanie komunikatu o dodaniu ogłoszenia -->
            <?php if (!empty($message)) : ?>
                <div class="message">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <!-- FORMULARZ -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="main_image">Miniatura:</label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" onchange="previewMainImage(this);" required>
                    <div id="main-image-preview" class="image-preview-container">
                        <!-- Placeholder for main image preview -->
                    </div>
                </div>
                <div>
                    <label for="images">Dodaj zdjęcia:</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple onchange="previewImages(this, 'additional-images-preview');" required>
                    <div id="additional-images-preview" class="image-preview-container">
                        <!-- Placeholder for additional images preview -->
                    </div>
                </div>
                <div>
                    <label for="manufacturer">Producent:</label>
                    <input type="text" id="manufacturer" name="manufacturer" required>
                </div>
                <div>
                    <label for="name">Nazwa:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="processor">Procesor:</label>
                    <input type="text" id="processor" name="processor" required>
                </div>
                <div>
                    <label for="processor_size">Procesor szczegóły:</label>
                    <input type="text" id="processor_size" name="processor_size" required>
                </div>
                <div>
                    <label for="ram">Pamięć RAM:</label>
                    <input type="text" id="ram" name="ram" required>
                </div>
                <div>
                    <label for="graphics">Karta graficzna:</label>
                    <input type="text" id="graphics" name="graphics" required>
                </div>
                <div>
                    <label for="disk">Dysk:</label>
                    <input type="text" id="disk" name="disk" required>
                </div>
                <div>
                    <label for="keyboard">Układ klawiatury:</label>
                    <input type="text" id="keyboard" name="keyboard" required>
                </div>
                <div>
                    <label for="screen_size">Przekątna ekranu:</label>
                    <input type="text" id="screen_size" name="screen_size" required>
                </div>
                <div>
                    <label for="resolution">Rozdzielczość:</label>
                    <input type="text" id="resolution" name="resolution" required>
                </div>
                <div>
                    <label for="matrix">Typ matrycy:</label>
                    <input type="text" id="matrix" name="matrix" required>
                </div>
                <div>
                    <label for="system">System operacyjny:</label>
                    <input type="text" id="system" name="system" required>
                </div>
                <div>
                    <label for="ports">Porty:</label>
                    <input type="text" id="ports" name="ports" required>
                </div>
                <div>
                    <label for="communication">Komunikacja:</label>
                    <input type="text" id="communication" name="communication" required>
                </div>
                <div>
                    <label for="multimedia">Multimedia:</label>
                    <input type="text" id="multimedia" name="multimedia" required>
                </div>
                <div>
                    <label for="condition">Stan wizualny:</label>
                    <input type="text" id="condition" name="condition" required>
                </div>
                <div>
                    <label for="working_hours">Średni czas pracy na baterii:</label>
                    <input type="text" id="working_hours" name="working_hours" required>
                </div>
                <div>
                    <label for="power_supply">Zasilacz:</label>
                    <input type="text" id="power_supply" name="power_supply" required>
                </div>
                <div>
                    <label for="price">Cena:</label>
                    <input type="number" id="price" name="price" min="0" step="0.01" required>
                </div>
                <div>
                    <label for="quantity">Ilość na stanie:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
                <div>
                    <label for="description">Opis:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <button type="submit">Dodaj ogłoszenie</button>
            </form>
        </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php'; ?>
</body>
</html>