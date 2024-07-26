<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Zarządzaj ogłoszeniami</title>
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Link do FontAwesome dla ikon -->
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
        .login-container {
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
            margin: 10px;
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
        .laptop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0 auto;
        }
        .laptop {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            width: 200px;
        }
        .laptop img {
            max-width: 100%;
            height: auto;
        }
        .laptop button {
            margin-top: 5px;
            padding: 5px 10px;
        }
    </style>
    <script>
        function confirmDelete(url) {
            if (confirm("Czy na pewno chcesz usunąć to ogłoszenie?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include '../header_admin.php';?>
    <main>
    <div class="login-container">
        <h1>Panel Administratora  - Zarządzaj ogłoszeniami</h1>
        <button><a href="../admin_page.php">Panel Administratora</a></button>
        <!-- LOGIKA POLACZENIA -->
        <?php
            require('../../baza/config.php');
            // wyswietlenie danych z bazy
            $query = "SELECT id_laptopa,nazwa,miniatura FROM laptopy WHERE `czy_na_stronie`=1";
            
            $result = mysqli_query($conn,$query);
            ?>
        <div class="laptop-container">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='laptop'>";
                    echo "<img src='" . $row["miniatura"] . "' alt='" . $row["nazwa"] . "'>";
                    echo "<h3>" . $row["nazwa"] . "</h3>";
                    echo "<button onclick=\"location.href='manage_announcements_edit.php?id=" . $row["id_laptopa"] . "'\">Edytuj</button>";
                    echo "<button onclick=\"confirmDelete(location.href='manage_announcements_delete.php?id=" . $row["id_laptopa"] . "')\">Usuń</button>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>
    </main>
    <!-- STOPKA -->
    <?php include '../../footer.php';?>
</body>
</html>
