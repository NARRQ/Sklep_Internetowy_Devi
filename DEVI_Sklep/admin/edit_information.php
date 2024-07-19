<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Edycja informacji</title>
    <link rel="stylesheet" media="all" href="../css/style.css" type="text/css">
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
    <!-- LOGIKA POLACZENIA -->
    <?php
        require('../baza/config.php');
        //update rekordu
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $informacja_opis = htmlentities($_POST['description']);
            $nazwa_firmy = htmlentities($_POST['name']);
            $miasto = htmlentities($_POST['city']);
            $kod_pocztowy = htmlentities($_POST['post_code']);
            $ulica = htmlentities($_POST['street']);
            $numer_telefonu = htmlentities($_POST['phone']);
            $kod_nip = htmlentities($_POST['NIP']);
            $dni_otwarcia = htmlentities($_POST['open_days']);
            $godziny_otwarcia = htmlentities($_POST['open_hours']);
            $email = htmlentities($_POST['email']);
            
            $informacja_opis = mysqli_real_escape_string($conn, $informacja_opis);
            $nazwa_firmy = mysqli_real_escape_string($conn, $nazwa_firmy);
            $miasto = mysqli_real_escape_string($conn, $miasto);
            $kod_pocztowy = mysqli_real_escape_string($conn, $kod_pocztowy);
            $ulica = mysqli_real_escape_string($conn, $ulica);
            $numer_telefonu = mysqli_real_escape_string($conn, $numer_telefonu);
            $kod_nip = mysqli_real_escape_string($conn, $kod_nip);
            $dni_otwarcia = mysqli_real_escape_string($conn, $dni_otwarcia);
            $godziny_otwarcia = mysqli_real_escape_string($conn, $godziny_otwarcia);
            $email = mysqli_real_escape_string($conn, $email);
        
            $query = "UPDATE informacje SET 
                        informacja_opis='$informacja_opis', 
                        nazwa_firmy='$nazwa_firmy', 
                        miasto='$miasto', 
                        kod_pocztowy='$kod_pocztowy', 
                        ulica='$ulica', 
                        numer_telefonu='$numer_telefonu', 
                        kod_nip='$kod_nip', 
                        dni_otwarcia='$dni_otwarcia', 
                        godziny_otwarcia='$godziny_otwarcia', 
                        email='$email' 
                      WHERE id_info=1";
        
            if (mysqli_query($conn, $query)) {
                echo '<div class="message">Informacje zostały zaktualizowane pomyślnie.</div>';
            } else {
                echo '<div class="message">Błąd aktualizacji informacji: ' . mysqli_error($conn) . '</div>';
            }
        }
        //wyswietlenie do edycji
        $query = "SELECT * FROM informacje where id_info=1";
	
        $result = mysqli_query($conn,$query);
        
        if($result){
            $row=mysqli_fetch_assoc($result);
        }
    ?>
        <div class="edit-container">
            <h1>Panel Administratora - Edycja informacji</h1>
            <button><a href="admin_page.php">Panel Administratora</a></button>
             <!-- FORMULARZ -->
             <form name="edit_info" method="post">
                 <div>
                     <label for="name">Nazwa:</label>
                     <input type="text" id="name" name="name" value="<?php echo isset($row['nazwa_firmy']) ? htmlspecialchars($row['nazwa_firmy']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="city">Miasto:</label>
                        <input type="text" id="city" name="city" value="<?php echo isset($row['miasto']) ? htmlspecialchars($row['miasto']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="post_code">Kod Pocztowy:</label>
                        <input type="text" id="post_code" name="post_code" value="<?php echo isset($row['kod_pocztowy']) ? htmlspecialchars($row['kod_pocztowy']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="street">Ulica:</label>
                        <input type="text" id="street" name="street" value="<?php echo isset($row['ulica']) ? htmlspecialchars($row['ulica']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="phone">Numer telefonu:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo isset($row['numer_telefonu']) ? htmlspecialchars($row['numer_telefonu']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="NIP">Kod NIP:</label>
                        <input type="text" id="NIP" name="NIP" value="<?php echo isset($row['kod_nip']) ? htmlspecialchars($row['kod_nip']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="open_days">Dni Otwarcia:</label>
                        <input type="text" id="open_days" name="open_days" value="<?php echo isset($row['dni_otwarcia']) ? htmlspecialchars($row['dni_otwarcia']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="open_hours">Godziny Otwarcia:</label>
                        <input type="text" id="open_hours" name="open_hours" value="<?php echo isset($row['godziny_otwarcia']) ? htmlspecialchars($row['godziny_otwarcia']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="description">Informacje:</label>
                        <textarea name="description" id="description" required><?php echo isset($row['informacja_opis']) ? htmlspecialchars($row['informacja_opis']) : ''; ?></textarea>
                    </div>
                <button type="submit">Zapisz zmiany</button>
            </form>
        </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
