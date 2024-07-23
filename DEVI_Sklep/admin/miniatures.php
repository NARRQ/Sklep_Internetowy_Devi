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
        }

        .modal-content .header .mini-info .price-container p {
            margin: 5px 0;
            font-size: 22px;
            font-weight: bold;
        }

        .modal-content .add-to-cart {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 20px;
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
            require('../baza/config.php');

            // Query to get laptop details including the miniatura field
            $query = "
                SELECT l.id_laptopa, l.nazwa, l.cena, l.producent, l.procesor, l.ram, l.grafika, l.procesor_sz, l.dysk, l.klawiatura, l.przekatna, l.rozdzielczosc, l.matryca, l.system, l.porty, l.komunikacja, l.multimedia, l.stan, l.czas_pracy, l.zasilacz, l.opis, l.ilosc, l.miniatura, GROUP_CONCAT(z.sciezka) AS zdjecia
                FROM laptopy l
                LEFT JOIN zdjecia z ON l.id_laptopa = z.id_laptopa
                GROUP BY l.id_laptopa
            ";

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
                echo "<p>Brak ogłoszeń do wyświetlenia.</p>";
            }
            ?>
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
            const modalStock = document.getElementById("modal-stock");
            const addToCartBtn = document.getElementById("modal-add-to-cart");
            const closeModal = document.querySelector(".close");
            const modalSpecification = document.getElementById("modal-specification");
            const modalDescription = document.getElementById("modal-description");
            const prevArrow = document.querySelector('.arrow.prev');
            const nextArrow = document.querySelector('.arrow.next');

            let currentIndex = 0;
            let currentAnnouncement = null;

            const openModal = (announcement) => {
                modalImg.src = announcement.dataset.miniatura;
                modalTitle.textContent = announcement.dataset.nazwa;
                modalPrice.textContent = `${announcement.dataset.cena} zł`;
                modalProcessor.textContent = announcement.dataset.procesor;
                modalRam.textContent = announcement.dataset.ram;
                modalGraphics.textContent = announcement.dataset.grafika;
                modalStock.textContent = `Dostępność: ${announcement.dataset.ilosc} sztuk`;

                modalSpecification.innerHTML = `
                    <h3>Specyfikacja</h3>
                    <p><strong>Producent:</strong> ${announcement.dataset.producent}</p>
                    <p><strong>Procesor szczegóły:</strong> ${announcement.dataset.procesorsz}</p>
                    <p><strong>Dysk:</strong> ${announcement.dataset.dysk}</p>
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
        });
    </script>
</body>
</html>
