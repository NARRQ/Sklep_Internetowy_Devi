<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogłoszenia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            gap: 16px;
            margin-top: 20px;
            margin-bottom: 5px; /* Miejsce na stopkę */
        }

        .filters {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            position: sticky;
            top: 20px; /* Ustawienie od górnej krawędzi */
            bottom: 20px; /* Dodaje margines na stopkę */
            max-height: calc(100vh - 40px);
            height: auto;
            overflow-y: auto;
            margin-left:0;
        }

        .filters h3 {
            margin-top: 0;
            font-size: 22px;
            text-align: left;
        }

        .filters label {
            display: block;
            margin-bottom: 10px;
        }

        .filters select,
        .filters input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .announcement-container {
           
            margin-left: 40px; /* Dopasuj szerokość w zależności od szerokości filtrów */
            width: calc(100% - 40px); /* Dopasuj szerokość kontenera ogłoszeń */
            
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 kolumny */
            gap: 16px; /* Odstęp między ogłoszeniami */
        }

        .announcement {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            padding: 10px;
            max-width: 100%;
            height: 450px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .announcement:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .announcement img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 8px 8px 0 0;
        }

        .announcement .summary {
            padding: 20px;
            box-sizing: border-box;
            justify-content: space-between;
            text-align: center;
            flex-grow: 1;
        }

        .announcement .summary p {
            margin: 5px 0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 1000px;
            position: relative;
            box-sizing: border-box;
        }

        .modal-content img {
            width: 100%;
            height: 400px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .modal .arrow {
            font-size: 40px;
            cursor: pointer;
            color: #333;
            position: absolute;
            top: 20%;
            transform: translateY(-50%);
            user-select: none;
        }

        .modal .prev {
            left: 10px;
        }

        .modal .next {
            right: 10px;
        }

        .modal .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal .close:hover,
        .modal .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .modal-content .header h2 {
            margin: 20px 0;
            font-size: 24px;
            text-align: center;
        }

        .modal-content .header .mini-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0;
            
        }

        .modal-content .header .mini-info .info-box {
            flex: 1; /* Sprawia, że info-box zajmuje dostępną przestrzeń */
            margin-right: 400px; /* Dodaje przestrzeń między info-box a ceną */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-top: 50px;
           
            
        }

        .modal-content .header .mini-info .info-box p {
            margin: 5px 0;
        }

        .modal-content .header .mini-info .price-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            text-align: right;
            margin-top: 60px;
            margin-bottom: 1px;
            
        }

        .modal-content .header .mini-info .price-container p {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }

        .modal-content .add-to-cart {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 0;
        }
        .modal-content .add-to-cart p {
              margin-top: 5px; /* Dodaje margines górny do tekstu "Dostępność sztuk" */
}

        .modal-content .add-to-cart label {
            display: block;
            margin-bottom: 1px;
        }

        .modal-content .add-to-cart input {
            width: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .modal-content .add-to-cart button {
            background-color: #ffffff;
            color: #28a745;
            border: 2px solid #28a745;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .modal-content .add-to-cart button:hover {
            background-color: #28a745;
            color: #fff;
        }

        .modal-content .details {
            margin-top: 20px;
        }

        .modal-content .details .specification,
        .modal-content .details .description {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }

        .modal-content .details .specification h3,
        .modal-content .details .description h3 {
            margin-top: 0;
            font-size: 20px;
            text-align: center;
        }

        .specification p {
            margin: 10px 0;
        }

        /* Styl dla sekcji sortowania */
        .sort-section {
            position: absolute; 
            top: 145px; /* Odstęp od górnej krawędzi*/
            right: 20px; 
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 10; 
            width: 160px; /* Szerokość sekcji sortowania */
        }

        .sort-section label {
            font-size: 13px;
            margin-left: 10px;
            text-align: center;
           
            
            
           
        }

        .sort-section select {
            width: 100%;
            padding: 4px;
            border: 1px solid #ddd;
            border-radius: 3px;
            
        }
        



        





    </style>
</head>
<body>
    <!-- NAGŁÓWEK -->
    <?php include 'header_ogloszenia.php'; ?>

    <!-- Modal -->
    <div id="announcementModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <span class="arrow prev">&#10094;</span>
            <img id="modal-image" src="" alt="Zdjęcie produktu">
            <span class="arrow next">&#10095;</span>
            <div class="thumbnail-container">
                <!-- Miniaturki zdjęć -->
                <div id="modal-thumbnails"></div>
            </div>
            <div class="header">
                <h2 id="modal-title"></h2>
                <div class="mini-info">
                    <div class="info-box">
                        <p><strong>Procesor:</strong> <span id="modal-processor"></span></p>
                        <p><strong>Pamięć RAM:</strong> <span id="modal-ram"></span></p>
                        <p><strong>Grafika:</strong> <span id="modal-graphics"></span></p>
                    </div>
                    <div class="price-container">
                        <p><strong>Cena:</strong> <span id="modal-price"></span> zł</p>
                    </div>
                </div>
            </div>
            <div class="add-to-cart">
                <label for="modal-quantity">Ilość:</label>
                <input type="number" id="modal-quantity" min="1" value="1" max="">
                <p id="modal-stock"></p>
                <button id="modal-add-to-cart"><i class="fas fa-shopping-cart"></i> Dodaj do koszyka</button>
            </div>
            <div class="details">
                <div class="specification" id="modal-specification">
                    <h3>Specyfikacja</h3>
                </div>
                <div class="description" id="modal-description">
                    <h3>Opis</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Treść główna -->
    <main>
        <div class="container">
            <!-- Filtry -->
            <div class="filters">
                <h3>Filtruj</h3>
                <label for="brand">Producent:</label>
                <select id="brand" name="brand">
                    <?php include 'filter_announcement.php'; ?>
                </select>

                <label for="screenSizeFrom">Przekątna ekranu od:</label>
                <input type="number" id="screenSizeFrom" name="screenSizeFrom" min="0" placeholder="0">

                <label for="screenSizeTo">Przekątna ekranu do:</label>
                <input type="number" id="screenSizeTo" name="screenSizeTo" min="0" placeholder="100">

                <label for="priceFrom">Cena od (w zł):</label>
                <input type="number" id="priceFrom" name="priceFrom" min="0" placeholder="0">

                <label for="priceTo">Cena do (w zł):</label>
                <input type="number" id="priceTo" name="priceTo" min="0" placeholder="10000">

                <button type="button" id="applyFilters">Zastosuj filtry</button>
            </div>

            <!-- Sekcja sortowania -->
            <div class="sort-section">
                <label for="sort">Sortuj według:</label>
                <select id="sort">
                    <option value="price-asc">Cena rosnąco</option>
                    <option value="price-desc">Cena malejąco</option>
                </select>
            </div>

            <!-- Ogłoszenia -->
            <div id="announcementContainer" class="announcement-container">
                <!-- Wyświetlanie ogłoszeń -->
                <?php
                require('../baza/config.php');

                // Pobierz wartości filtrów i sortowania z GET
                $brand = isset($_GET['brand']) ? mysqli_real_escape_string($conn, $_GET['brand']) : '';
                $screenSizeFrom = isset($_GET['screenSizeFrom']) ? intval($_GET['screenSizeFrom']) : 0;
                $screenSizeTo = isset($_GET['screenSizeTo']) ? intval($_GET['screenSizeTo']) : PHP_INT_MAX;
                $priceFrom = isset($_GET['priceFrom']) ? floatval($_GET['priceFrom']) : 0;
                $priceTo = isset($_GET['priceTo']) ? floatval($_GET['priceTo']) : PHP_FLOAT_MAX;
                $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; // Domyślnie brak sortowania

                // Ustawienie domyślnego porządku sortowania na rosnąco, tylko jeśli sortowanie jest wybrane
                $sortOrder = '';
                if ($sort === 'price-desc') {
                    $sortOrder = 'ORDER BY l.cena DESC';
                } elseif ($sort === 'price-asc') {
                    $sortOrder = 'ORDER BY l.cena ASC';
                }

                // Przygotowanie zapytania SQL z filtrami
                $query = "
                SELECT l.id_laptopa, l.nazwa, l.cena, l.producent, l.procesor, l.ram, l.grafika, l.procesor_sz, l.dysk, l.klawiatura, l.przekatna, l.rozdzielczosc, l.matryca, l.system, l.porty, l.komunikacja, l.multimedia, l.stan, l.czas_pracy, l.zasilacz, l.opis, l.ilosc, l.miniatura, GROUP_CONCAT(z.sciezka) AS zdjecia
                FROM laptopy l
                LEFT JOIN zdjecia z ON l.id_laptopa = z.id_laptopa
                WHERE l.producent LIKE '%$brand%'
                AND l.czy_na_stronie=1
                AND l.przekatna BETWEEN $screenSizeFrom AND $screenSizeTo
                AND l.cena BETWEEN $priceFrom AND $priceTo
                GROUP BY l.id_laptopa
                $sortOrder
                ";

                // Wykonanie zapytania SQL
                $announcements = mysqli_query($conn, $query);

                if ($announcements && mysqli_num_rows($announcements) > 0) {
                    while ($announcement = mysqli_fetch_assoc($announcements)) {
                        $zdjecia = explode(',', $announcement['zdjecia']);
                ?>
                <div class="announcement" 
                    data-index="<?php echo $announcement['id_laptopa']; ?>"
                    data-miniatura="<?php echo $announcement['miniatura']; ?>"
                    data-nazwa="<?php echo $announcement['nazwa']; ?>"
                    data-cena="<?php echo $announcement['cena']; ?>"
                    data-producent="<?php echo $announcement['producent']; ?>"
                    data-procesor="<?php echo $announcement['procesor']; ?>"
                    data-ram="<?php echo $announcement['ram']; ?>"
                    data-grafika="<?php echo $announcement['grafika']; ?>"
                    data-procesorsz="<?php echo $announcement['procesor_sz']; ?>"
                    data-dysk="<?php echo $announcement['dysk']; ?>"
                    data-klawiatura="<?php echo $announcement['klawiatura']; ?>"
                    data-przekatna="<?php echo $announcement['przekatna']; ?>"
                    data-rozdzielczosc="<?php echo $announcement['rozdzielczosc']; ?>"
                    data-matryca="<?php echo $announcement['matryca']; ?>"
                    data-system="<?php echo $announcement['system']; ?>"
                    data-porty="<?php echo $announcement['porty']; ?>"
                    data-komunikacja="<?php echo $announcement['komunikacja']; ?>"
                    data-multimedia="<?php echo $announcement['multimedia']; ?>"
                    data-stan="<?php echo $announcement['stan']; ?>"
                    data-czaspracy="<?php echo $announcement['czas_pracy']; ?>"
                    data-zasilacz="<?php echo $announcement['zasilacz']; ?>"
                    data-opis="<?php echo $announcement['opis']; ?>"
                    data-ilosc="<?php echo $announcement['ilosc']; ?>"
                    data-zdjecia="<?php echo implode(',', $zdjecia); ?>">
                    <img src="<?php echo $announcement['miniatura']; ?>">
                    <div class="summary">
                        <h2><?php echo $announcement['nazwa']; ?></h2>
                        <p><strong>Cena:</strong> <?php echo $announcement['cena']; ?> zł</p>
                        <p><strong>Producent:</strong> <?php echo $announcement['producent']; ?></p>
                        <p><strong>Procesor:</strong> <?php echo $announcement['procesor']; ?></p>
                        <p><strong>Pamięć RAM:</strong> <?php echo $announcement['ram']; ?></p>
                        <p><strong>Grafika:</strong> <?php echo $announcement['grafika']; ?></p>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<p>Brak ogłoszeń spełniających podane kryteria.</p>';
                }

                // Zamknięcie połączenia z bazą danych
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </main>

    <!-- Stopka -->
    <?php include 'footer_ogloszenia.php'; ?>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("announcementModal");
    const modalImg = document.getElementById("modal-image");
    const modalTitle = document.getElementById("modal-title");
    const modalPrice = document.getElementById("modal-price");
    const modalProcessor = document.getElementById("modal-processor");
    const modalRam = document.getElementById("modal-ram");
    const modalGraphics = document.getElementById("modal-graphics");
    const modalStock = document.getElementById("modal-stock");
    const modalQuantity = document.getElementById("modal-quantity");
    const addToCartBtn = document.getElementById("modal-add-to-cart");
    const closeModal = document.querySelector(".close");
    const modalSpecification = document.getElementById("modal-specification");
    const modalDescription = document.getElementById("modal-description");
    const prevArrow = document.querySelector('.arrow.prev');
    const nextArrow = document.querySelector('.arrow.next');

    let currentIndex = 0;
    let currentAnnouncement = null;

    const openModal = (announcement) => {
        const images = announcement.dataset.zdjecia.split(',');
        currentIndex = 0; // Ustawienie początkowego indeksu na pierwszy obraz
        modalImg.src = images[currentIndex];
        modalTitle.textContent = announcement.dataset.nazwa;
        modalPrice.textContent = `${announcement.dataset.cena}`;
        modalProcessor.textContent = announcement.dataset.procesor;
        modalRam.textContent = announcement.dataset.ram;
        modalGraphics.textContent = announcement.dataset.grafika;
        modalStock.textContent = `Dostępność: ${announcement.dataset.ilosc} sztuk`;
        
        // Ustawienie maksymalnej ilości w polu input
        modalQuantity.max = announcement.dataset.ilosc;
        modalQuantity.value = 1; // Resetowanie wartości do 1 przy każdym otwarciu modala

        modalSpecification.innerHTML = `
            <h3>Specyfikacja</h3>
            <p><strong>Nazwa modelu:</strong>${announcement.dataset.nazwa}</p>
            <p><strong>Producent:</strong> ${announcement.dataset.producent}</p>
            <p><strong>Procesor:</strong> ${announcement.dataset.procesor}</p>
            <p><strong>Procesor szczegóły:</strong> ${announcement.dataset.procesorsz}</p>
            <p><strong>Pamięć RAM:</strong>${announcement.dataset.ram}</p>
            <p><strong>Dysk:</strong> ${announcement.dataset.dysk}</p>
            <p><strong>Grafika:</strong>${announcement.dataset.grafika}</p>
            <p><strong>Układ klawiatury:</strong> ${announcement.dataset.klawiatura}</p>
            <p><strong>Przekątna ekranu:</strong> ${announcement.dataset.przekatna}</p>
            <p><strong>Rozdzielczość:</strong> ${announcement.dataset.rozdzielczosc}</p>
            <p><strong>Typ matrycy:</strong> ${announcement.dataset.matryca}</p>
            <p><strong>System operacyjny:</strong> ${announcement.dataset.system}</p>
            <p><strong>Porty:</strong> ${announcement.dataset.porty}</p>
            <p><strong>Komunikacja:</strong> ${announcement.dataset.komunikacja}</p>
            <p><strong>Multimedia:</strong> ${announcement.dataset.multimedia}</p>
            <p><strong>Stan wizualny:</strong> ${announcement.dataset.stan}</p>
            <p><strong>Średni czas pracy na baterii:</strong> ${announcement.dataset.czaspracy}</p>
            <p><strong>Zasilacz:</strong> ${announcement.dataset.zasilacz}</p>
        `;

        modalDescription.innerHTML = `
            <h3>Opis</h3>
            <p>${announcement.dataset.opis}</p>
        `;

        modal.style.display = "block";
    };

    const closeModalFunction = () => {
        modal.style.display = "none";
    };

    const showImage = (index) => {
        const images = currentAnnouncement.dataset.zdjecia.split(',');
        if (index >= 0 && index < images.length) {
            modalImg.src = images[index];
        }
    };

    prevArrow.addEventListener('click', () => {
        const images = currentAnnouncement.dataset.zdjecia.split(',');
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    });

    nextArrow.addEventListener('click', () => {
        const images = currentAnnouncement.dataset.zdjecia.split(',');
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    });

    document.querySelectorAll('.announcement').forEach(announcement => {
        announcement.addEventListener('click', () => {
            currentAnnouncement = announcement;
            openModal(announcement);
        });
    });

    closeModal.addEventListener('click', closeModalFunction);

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModalFunction();
        }
    });

    document.getElementById('applyFilters').addEventListener('click', function() {
        const brand = document.getElementById('brand').value || '';
        const screenSizeFrom = document.getElementById('screenSizeFrom').value || '';
        const screenSizeTo = document.getElementById('screenSizeTo').value || '';
        const priceFrom = document.getElementById('priceFrom').value || '';
        const priceTo = document.getElementById('priceTo').value || '';

        // Initialize an empty array to hold the query parameters
        let queryParams = [];
        // Add parameters to the query string if they are not empty
        if (brand) queryParams.push(`brand=${encodeURIComponent(brand)}`);
                if (screenSizeFrom) queryParams.push(`screenSizeFrom=${encodeURIComponent(screenSizeFrom)}`);
                if (screenSizeTo) queryParams.push(`screenSizeTo=${encodeURIComponent(screenSizeTo)}`);
                if (priceFrom) queryParams.push(`priceFrom=${encodeURIComponent(priceFrom)}`);
                if (priceTo) queryParams.push(`priceTo=${encodeURIComponent(priceTo)}`);
                // Join all parameters with '&' and prepend with '?'
                let queryString = queryParams.length > 0 ? `?${queryParams.join('&')}` : '';

                // Debugging output
                console.log(`Redirecting to: miniatures.php${queryString}`);

                // Redirect with query parameters
                window.location.href = `miniatures.php${queryString}`;  
            });
            // Dodaj walidację w polu ilości
            modalQuantity.addEventListener('input', function() {
            const maxQuantity = parseInt(modalQuantity.max, 10);
            if (parseInt(modalQuantity.value, 10) > maxQuantity) {
                modalQuantity.value = maxQuantity;
            }
        });
    });

    </script>
</body>
</html>