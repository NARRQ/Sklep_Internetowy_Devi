<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Laptopy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Nasze laptopy</h1>
    <ul>
    <?php
    $sql = "SELECT * FROM Laptopy";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["producent"] . " " . $row["nazwa"] . " - " . $row["cena"] . " PLN</li>";
        }
    } else {
        echo "Brak laptopów";
    }
    $conn->close();
    ?>
    </ul>
    <a href="index.php">Powrót do strony głównej</a>
</body>
</html>
