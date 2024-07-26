<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Zarządzaj zamówieniami</title>
    <link rel="stylesheet" href="../css/style.css">
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
            height: 500px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            min-width: 400px;
            border: 1px solid #dddddd;
        }

        table thead tr {
            background-color: #f2f2f2;
            text-align: center;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #009879;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header_admin.php';?>
    <main>
        <!-- LOGIKA POLACZENIA -->
        <?php
            require('../baza/config.php');
            // wyswietlenie danych z bazy
            $query = "SELECT 
                        z.id_zamowienia,
                        z.data_zamowienia,
                        GROUP_CONCAT(CONCAT(l.nazwa, ' : ', lz.ilosc, ' szt.') SEPARATOR '<br>') as laptopy,
                        z.status
                        from zamowienia z
                        JOIN lap_zamowienia lz on z.id_zamowienia=lz.id_zamowienia
                        JOIN laptopy l on lz.id_laptopa=l.id_laptopa
                        GROUP BY z.id_zamowienia, z.data_zamowienia, z.status
                        ORDER BY z.data_zamowienia desc";
	
            $result = mysqli_query($conn,$query);
        ?>
    <div class="login-container">
        <h1>Panel Administratora  - Zarządzaj zamówieniami</h1>
        <button><a href="admin_page.php">Panel Administratora</a></button>
        <!-- TABELA Z ZAMOWIENIAMI -->
        <table>
            <thead>
                <tr>
                    <th>Numer zamowienia</th>
                    <th>Data i Godzina zamowienia</th>
                    <th>Zamówione laptopy</th>
                    <th>Status</th>
                    <th>SZCZEGÓŁY</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>{$row['id_zamowienia']}</td>";
                    echo "<td>{$row['data_zamowienia']}</td>";
                    echo "<td>{$row['laptopy']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td><button><a href='manage_orders_individual.php?id={$row['id_zamowienia']}'>szczegóły</a></button></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>