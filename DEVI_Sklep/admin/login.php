<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel logowania</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Link do FontAwesome dla ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- NAGLOWEK -->
    <?php include 'header_admin.php';?>
    <main>
        <div id="login" class="login-container">
            <form action="login-script.php" method="post">
            <!-- <h1>
                LOGOWANIE
            </h1>
                Login<input type="text" name='login'><br>
                Haslo<input type="password" name='haslo'><br>
                <input type="submit" value="Zaloguj">
            -->
                <!-- group: Logowanie content -->
                <h1>Panel administratora - Logowanie</h1>
                <!-- Pola do wpisania -->
                <div>
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div>
                    <label for="password">Hasło:</label>
                    <input type="password" id="haslo" name="haslo" required>
                </div>
                <!-- przycisk zaloguj -->
                <input class="button" type="submit" value="Zaloguj">
            </form> 
        </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
