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
            grid-gap: 10px; /* Odstęp między ogłoszeniami */
            grid-template-columns: repeat(3, 1fr); /* 3 kolumny */
            grid-template-rows: repeat(2, auto); /* 2 wiersze, automatyczna wysokość */
           
        }

        .announcement {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px; 
            margin: 10px; 
            max-width: 300px; 
            
        }

        .announcement:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .announcement img {
            width: 80%;
            height: auto;
            display: block;
            border-radius: 8px 8px 0 0;
        }

        .announcement .summary {
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
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
            text-align: center;
            box-sizing: border-box;
        }

        .modal-content img {
            width: 100%;
            height: 500px; /* Stała wysokość */
            object-fit: contain; /* Dopasowanie obrazu */
            display: block;
            margin: 0 auto;
        }

        .modal .arrow {
            font-size: 40px;
            cursor: pointer;
            color: #333;
            position: absolute;
            top: 30%;
            transform: translateY(-50%);
            user-select: none;
        }

        .modal .prev {
            left: 10px; /* Przesunięcie w lewo od krawędzi */
        }

        .modal .next {
            right: 10px; /* Przesunięcie w prawo od krawędzi */
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

        .details {
            text-align: center;
            margin-top: 20px;
        }

        .details h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .details .specification,
        .details .description {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }

        .details .specification h3,
        .details .description h3 {
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
            width: 200px; /* Szerokość kolumny z etykietą */
            padding-right: 10px; /* Odstęp między kolumnami */
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
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
            <div class="details" id="modal-details">
                <!-- Szczegóły i opis -->
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
                        <button class="delete-btn" data-index="<?php echo $index; ?>">Usuń</button>
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
            const modalDetails = document.getElementById("modal-details");
            const closeModal = document.querySelector(".close");
            let currentIndex = 0;
            let currentAnnouncement = null;
            const announcements = <?php echo json_encode($announcements); ?>;

            const openModal = (index) => {
                currentIndex = index;
                currentAnnouncement = announcements[index];
                modalImg.src = currentAnnouncement['zdjecia'][0];
                modalDetails.innerHTML = `
                    <h2>${currentAnnouncement['nazwa']}</h2>
                    <div class="specification">
                        <h3>Specyfikacja</h3>
                        <p><strong>Producent:</strong> ${currentAnnouncement['producent']}</p>
                        <p><strong>Cena:</strong> ${currentAnnouncement['cena']} zł</p>
                        <p><strong>Procesor:</strong> ${currentAnnouncement['procesor']}</p>
                        <p><strong>Pamięć RAM:</strong> ${currentAnnouncement['ram']}</p>
                        <p><strong>Grafika:</strong> ${currentAnnouncement['grafika']}</p>
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
                    </div>
                    <div class="description">
                        <h3>Opis</h3>
                        <p>${currentAnnouncement['opis']}</p>
                    </div>
                `;
                modal.style.display = "block";
            };

            document.querySelectorAll('.announcement').forEach(announcement => {
                announcement.addEventListener('click', (e) => {
                    if (e.target.classList.contains('delete-btn')) {
                        const index = e.target.getAttribute('data-index');
                        if (confirm('Czy na pewno chcesz usunąć to ogłoszenie?')) {
                            // Usuwanie ogłoszenia
                            fetch('delete_announcement.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    index: index
                                })
                            }).then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      document.querySelector(`.announcement[data-index='${index}']`).remove();
                                      alert('Ogłoszenie zostało usunięte.');
                                  } else {
                                      alert('Wystąpił błąd podczas usuwania ogłoszenia.');
                                  }
                              });
                        }
                    } else {
                        const index = announcement.getAttribute('data-index');
                        openModal(index);
                    }
                });
            });

            closeModal.addEventListener('click', () => {
                modal.style.display = "none";
            });

            const showImage = (index) => {
                if (index >= 0 && index < currentAnnouncement['zdjecia'].length) {
                    modalImg.src = currentAnnouncement['zdjecia'][index];
                }
            };

            document.querySelector('.next').addEventListener('click', () => {
                if (currentIndex + 1 < currentAnnouncement['zdjecia'].length) {
                    currentIndex++;
                    showImage(currentIndex);
                }
            });

            document.querySelector('.prev').addEventListener('click', () => {
                if (currentIndex - 1 >= 0) {
                    currentIndex--;
                    showImage(currentIndex);
                }
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
