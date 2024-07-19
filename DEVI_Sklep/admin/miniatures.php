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
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }

        .announcement {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            max-width: 300px;
            height: 450px;
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
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .modal-content .header .mini-info .info-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
            flex: 1 1 45%;
            margin: 10px;
            margin-right: 500px;
        }

        .modal-content .header .mini-info .info-box p {
            margin: 5px 0;
        }

        .modal-content .header .mini-info .price-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-left: auto;
            text-align: right;
            margin-top: -180px;
        }

        .modal-content .header .mini-info .price-container p {
            margin: 5px 0;
            font-size: 22px;
            font-weight: bold;
        }

        .modal-content .add-to-cart {
            margin-top: -60px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .modal-content .add-to-cart label {
            display: block;
            margin-bottom: 5px;
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
            margin-top: 10px;
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
            text-align: left;
            display: table;
            width: 100%;
        }

        .specification p strong {
            display: table-cell;
            width: 200px;
            padding-right: 10px;
        }
    </style>
</head>
<body>
    <!-- NAGŁÓWEK -->
    <?php include 'header_admin.php'; ?>

    <!-- Modal -->
    <div id="announcementModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <span class="arrow prev">&#10094;</span>
            <img id="modal-image" src="" alt="Zdjęcie produktu">
            <span class="arrow next">&#10095;</span>
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
                <input type="number" id="modal-quantity" min="1" value="1">
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
            <!-- Wyświetlanie ogłoszeń -->
            <?php
            // Odczyt ogłoszeń z pliku JSON
            $announcements = json_decode(file_get_contents('announcements.json'), true);

            // Wyświetlanie każdego ogłoszenia
            foreach ($announcements as $index => $announcement) : ?>
                <div class="announcement" data-index="<?php echo $index; ?>">
                    <img src="<?php echo $announcement['miniatura']; ?>" alt="Miniatura produktu">
                    <div class="summary">
                        <h2><?php echo $announcement['nazwa']; ?></h2>
                        <p><strong>Cena:</strong> <?php echo $announcement['cena']; ?> zł</p>
                        <p><strong>Producent:</strong> <?php echo $announcement['producent']; ?></p>
                        <p><strong>Procesor:</strong> <?php echo $announcement['procesor']; ?></p>
                        <p><strong>Pamięć RAM:</strong> <?php echo $announcement['ram']; ?></p>
                        <p><strong>Grafika:</strong> <?php echo $announcement['grafika']; ?></p>
                        <!-- Przyciski usunięcia zostały usunięte -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- STOPKA -->
    <?php include '../footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("announcementModal");
            const modalImg = document.getElementById("modal-image");
            const modalTitle = document.getElementById("modal-title");
            const modalPrice = document.getElementById("modal-price");
            const modalProcessor = document.getElementById("modal-processor");
            const modalRam = document.getElementById("modal-ram");
            const modalGraphics = document.getElementById("modal-graphics");
            const modalQuantity = document.getElementById("modal-quantity");
            const modalStock = document.getElementById("modal-stock");
            const addToCartBtn = document.getElementById("modal-add-to-cart");
            const closeModal = document.querySelector(".close");
            const modalSpecification = document.getElementById("modal-specification");
            const modalDescription = document.getElementById("modal-description");
            const prevArrow = document.querySelector('.arrow.prev');
            const nextArrow = document.querySelector('.arrow.next');

            let currentIndex = 0;
            let currentAnnouncement = null;
            const announcements = <?php echo json_encode($announcements); ?>;

            const openModal = (index) => {
                currentIndex = index;
                currentAnnouncement = announcements[index];
                modalImg.src = currentAnnouncement['zdjecia'][0];
                modalTitle.textContent = currentAnnouncement['nazwa'];
                modalPrice.textContent = currentAnnouncement['cena'];
                modalProcessor.textContent = currentAnnouncement['procesor'];
                modalRam.textContent = currentAnnouncement['ram'];
                modalGraphics.textContent = currentAnnouncement['grafika'];
                modalStock.textContent = `Dostępność: ${currentAnnouncement['ilosc']} sztuk`;
                modalSpecification.innerHTML = `
                    <h3>Specyfikacja</h3>
                    <p><strong>Producent:</strong> ${currentAnnouncement['producent']}</p>
                    <p><strong>Procesor szczegóły:</strong> ${currentAnnouncement['procesor_sz']}</p>
                    <p><strong>Dysk:</strong> ${currentAnnouncement['dysk']}</p>
                    <p><strong>Układ klawiatury:</strong> ${currentAnnouncement['klawiatura']}</p>
                    <p><strong>Przekątna ekranu:</strong> ${currentAnnouncement['przekatna']}</p>
                    <p><strong>Rozdzielczość:</strong> ${currentAnnouncement['rozdzielczosc']}</p>
                    <p><strong>Typ matrycy:</strong> ${currentAnnouncement['matryca']}</p>
                    <p><strong>System operacyjny:</strong> ${currentAnnouncement['system']}</p>
                    <p><strong>Porty:</strong> ${currentAnnouncement['porty']}</p>
                    <p><strong>Komunikacja:</strong> ${currentAnnouncement['komunikacja']}</p>
                    <p><strong>Multimedia:</strong> ${currentAnnouncement['multimedia']}</p>
                    <p><strong>Stan wizualny:</strong> ${currentAnnouncement['stan']}</p>
                    <p><strong>Średni czas pracy na baterii:</strong> ${currentAnnouncement['czas_pracy']}</p>
                    <p><strong>Zasilacz:</strong> ${currentAnnouncement['zasilacz']}</p>
                `;
                modalDescription.innerHTML = `
                    <h3>Opis</h3>
                    <p>${currentAnnouncement['opis']}</p>
                `;
                modal.style.display = "block";
            };

            const closeModalFunction = () => {
                modal.style.display = "none";
            };

            const showImage = (index) => {
                if (index >= 0 && index < currentAnnouncement['zdjecia'].length) {
                    modalImg.src = currentAnnouncement['zdjecia'][index];
                }
            };

            prevArrow.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + currentAnnouncement['zdjecia'].length) % currentAnnouncement['zdjecia'].length;
                showImage(currentIndex);
            });

            nextArrow.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % currentAnnouncement['zdjecia'].length;
                showImage(currentIndex);
            });

            document.querySelectorAll('.announcement').forEach(announcement => {
                announcement.addEventListener('click', () => {
                    const index = announcement.getAttribute('data-index');
                    openModal(index);
                });
            });

            closeModal.addEventListener('click', closeModalFunction);

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModalFunction();
                }
            });
        });
    </script>
</body>
</html>
