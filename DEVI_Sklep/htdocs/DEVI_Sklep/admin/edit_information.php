<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Edycja informacji</title>
    <link rel="stylesheet"  media="all" href="../css/style.css" type="text/css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <style>
        .edtit-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* width: 30%; */
            /* position: relative; */
            /* left: 43%; */
            /* transform: translate(-50%, -50%); */
            text-align: center;
            margin: 100px;
        }
    </style> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 10;
	        padding: 0;
        }
        .edit-container {
            width: 100%;
            margin: 10 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
	        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	        align-self: center;
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
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header_admin.php';?>
    <main>
        <div class="edtit-container">
            <h1>Panel Administratora  - Edycja informacji</h1>
             <!-- FORMULARZ -->
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="description">informacje:</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <div>
                    <label for="name">Nazwa:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="processor">Miasto:</label>
                    <input type="text" id="processor" name="processor" required>
                </div>
                <div>
                    <label for="processor_size">Kod Pocztowy:</label>
                    <input type="text" id="processor_size" name="processor_size" required>
                </div>
                <div>
                    <label for="ram">Ulica:</label>
                    <input type="text" id="ram" name="ram" required>
                </div>
                <div>
                    <label for="graphics">Numer telefonu:</label>
                    <input type="text" id="graphics" name="graphics" required>
                </div>
                <div>
                    <label for="disk">Kod NIP:</label>
                    <input type="text" id="disk" name="disk" required>
                </div>
                <div>
                    <label for="keyboard">Dni Otwarcia:</label>
                    <input type="text" id="keyboard" name="keyboard" required>
                </div>
                <div>
                    <label for="screen_size">Godziny Otwarcia:</label>
                    <input type="text" id="screen_size" name="screen_size" required>
                </div>
                <div>
                    <label for="resolution">Email:</label>
                    <input type="text" id="resolution" name="resolution" required>
                </div>
            </form>
            <button class="button" type="submit">Zapisz zmiany</button>
            <button><a href="admin_page.php">Panel Administratora</a></button>

        </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
