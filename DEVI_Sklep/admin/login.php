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
    <?php include '../header.php';?>
    <main>
        <div id="login">
            <h1>
                LOGOWANIE
            </h1>
            <form action="login-script.php" method="post">
                Login<input type="text" name='login'><br>
                Haslo<input type="password" name='password'><br>
                <input type="submit" value="Zaloguj">
            </form>
            
        </div>
    </main>
    <!-- STOPKA -->
    <?php include '../footer.php';?>
</body>
</html>
