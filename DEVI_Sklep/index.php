<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamiczna Strona PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="main-page">
        <nav class="navbar">
            <div class="navbar-item"><a href="#">Laptopy</a></div>
            <div class="navbar-item"><a href="#">Informacje</a></div>
            <div class="navbar-item"><a href="#">Kontakt</a></div>
            <div class="navbar-item koszyk">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 14H4a.5.5 0 0 1-.491-.408L1.01 2H.5a.5.5 0 0 1-.5-.5zM3.415 6l1.481 7h7.21l1.481-7H3.415zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    Koszyk
                </a>
            </div>
        </nav>
        
        <section class="content">
            <h1>Witaj na stronie!</h1>
            <p>
                <?php
                // Przykładowe korzystanie z PHP do dynamicznego generowania treści
                $username = "John"; // Przykładowe imię użytkownika
                echo "Witaj, " . htmlspecialchars($username, ENT_QUOTES) . "! Dziś jest " . date("d.m.Y") . ".";
                ?>
            </p>
        </section>
        
        <footer class="footer">
            <p>Sprzedaż laptopów</p>
            <p><a href="https://www.devisystemsklep.pl">https://www.devisystemsklep.pl</a></p>
            <p><a href="#">Strona główna</a></p>
        </footer>
    </div>
</body>
</html>
