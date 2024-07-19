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
            REJESTRACJA
        </h1>
        <form action="save_user-script.php" method="post">
            Nazwa <input type="text" name="name"><br>
            Login <input type="text" name="login"><br>
            Hasło <input type="password" name="password"><br>
            <input id="sign" type="submit" value="Zarejestruj">
        </form>
    </div>

    <?php
        if(isset($_GET['info'])){
            if($_GET['info']=="empty") echo "Nie wprowadzono danych";
            if($_GET['info']=="rejestr_ok") echo "Zarejestrowano pomyślnie";
            if($_GET['info']=="rejestr_error") echo "Błąd rejestracji";
            if($_GET['info']=="user_exist") echo "Taki użytkownik już istnieje";
        }
    ?>
</body>
</html>