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
            <div id="sign" onclick="location.href='index.php'">Menu Główne</div>
            <div id="sign" onclick="location.href='article_edit-list.php'">Edytuj artykuły</div>
</div>

    <?php
        require('logged-as.php');
    ?>
    <div id="login1">

        <h2>Artykuł</h2>
        <form action="article_save.php" method="post">
            Tytuł:<input type="text" name="title"><br>
            <textarea name="content" id="" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" value="Zapisz">
        </form>
        
        </div>
        <?php
        if(isset($_GET['info'])){
            if($_GET['info']=="empty") echo "Nie wprowadzono danych";
            if($_GET['info']=="article_ok") echo "Dodano pomyślnie";
            if($_GET['info']=="article_error") echo "Błąd dodania";
        }
    ?>
</body>
</html>

        