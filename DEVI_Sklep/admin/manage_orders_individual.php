<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
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
        .order-info, .customer-info, .additional-info{
            padding: 10px;
            border-bottom: 1px solid #ccc;
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
    </style>
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header_admin.php';?>
    <main>
    <div class="login-container">
    <h1>Panel Administratora  - Zarządzaj zamówieniem</h1>
    <button><a href="admin_page.php">Panel Administratora</a></button>
    <button><a href="manage_orders.php">Lista zamówień</a></button>
    <!-- LOGIKA -->
    <?php
        require('../baza/config.php');
        // wyswietlenie danych z bazy
        if(isset($_GET['id']) && is_numeric($_GET['id']))
        {
            $id=$_GET['id'];
            $query="SELECT 
                GROUP_CONCAT(k.imie,' ',k.nazwisko) as klient,
                k.email,
                k.telefon,
                z.data_zamowienia,
                z.dodatkowe_informacje,
                z.cena_calkowita,
                z.status,
                l.miniatura,
                GROUP_CONCAT(CONCAT(
                    l.nazwa,l.procesor,l.ram,l.dysk,l.system, ' : ', lz.ilosc, ' szt.'
                ) SEPARATOR '<br>') as laptopy
                from zamowienia z
                JOIN klienci k on k.id_klienta=z.id_klienta 
                JOIN lap_zamowienia lz on z.id_zamowienia=lz.id_zamowienia
                JOIN laptopy l on lz.id_laptopa=l.id_laptopa
                WHERE z.id_zamowienia=$id;
            ";
            $result=mysqli_query($conn,$query);
            
            if($result)
            {
                $row=mysqli_fetch_assoc($result);
                $order_status = $row['status'];
                function renderOrderButton($status) {
                    switch($status) {
                        case 'Nowy':
                            echo "<button><a href='manage_orders_script.php?id={$row['id_zamowienia']}?info=zatwierdz'>Zatwierdź zamówienie</button>";
                            echo '<button>Odrzuć zamówienie</button>';
                            break;
                        case 'W trakcie':
                            echo '<button>Odrzuć zamówienie</button>';
                            break;
                        case 'Zakończony':
                            echo '<button>Usuń zamówienie</button>';
                            break;
                        default:
                            echo '<button>Nieznany status</button>';
                    }
                }
    ?>
        <div class="container">
            <div><h3>ZDJECIE</h3></div>
            <div>
                <span><?php echo $row['laptopy']?></span>
                <span><?php echo $row['cena_calkowita']?></span>
            </div>
        </div>
        <div class="container">
            <div>
                <div class="customer-info">
                    <?php echo $row['klient']?>
                    <br>
                    <?php echo $row['email']?>    
                    <br>
                    <?php echo $row['telefon']?>
                    <br>
                    <?php echo $row['data_zamowienia']?>
                    <br>
                </div>
                <div class="additional-info">
                    <?php echo $row['dodatkowe_informacje']?>
                </div>
            </div>
            <div>
                <h3>Status zamówienia: </h3>
                <?php echo $row['status']?>
                <br>
                <?php renderOrderButton($order_status); ?>
            </div>
        </div>
        </div>
    </div>
    <?php
    
            }
        }    
    ?>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
