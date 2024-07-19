<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="menu">
            <div id="sign" onclick="location.href='index.php'">Menu Główne</a></div>
</div>

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
    
    <?php
        if(isset($_GET['info'])){
            if($_GET['info']=="empty") echo "Nie wprowadzono danych";
            if($_GET['info']=="login_ok") echo "Zalogowano pomyślnie";
            if($_GET['info']=="login_error") echo "Błąd logowania";
        }
    ?>
</body>
</html>