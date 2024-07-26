<?php
require('../baza/config.php');

// Pobierz unikalnych producentów z bazy danych
$result = mysqli_query($conn, "SELECT DISTINCT producent FROM laptopy");
$producentOptions = "<option value=''>Wszystkie</option>"; // Domyślna opcja

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $producentOptions .= '<option value="' . htmlspecialchars($row['producent']) . '">' . htmlspecialchars($row['producent']) . '</option>';
    }
} else {
    echo "Błąd zapytania: " . mysqli_error($conn);
}

// Wyświetl opcje producentów w formularzu
echo $producentOptions;

// Pobierz wartości filtrów z GET
$brand = isset($_GET['brand']) ? trim($_GET['brand']) : '';
$screenSizeFrom = isset($_GET['screenSizeFrom']) ? intval($_GET['screenSizeFrom']) : 0;
$screenSizeTo = isset($_GET['screenSizeTo']) ? intval($_GET['screenSizeTo']) : PHP_INT_MAX;
$priceFrom = isset($_GET['priceFrom']) ? floatval($_GET['priceFrom']) : 0;
$priceTo = isset($_GET['priceTo']) ? floatval($_GET['priceTo']) : PHP_FLOAT_MAX;

// Przygotuj zapytanie SQL z filtrami
$query = "SELECT l.id_laptopa, l.nazwa, l.cena, l.producent, l.procesor, l.ram, l.grafika, l.procesor_sz, l.dysk, l.klawiatura, l.przekatna, l.rozdzielczosc, l.matryca, l.system, l.porty, l.komunikacja, l.multimedia, l.stan, l.czas_pracy, l.zasilacz, l.opis, l.ilosc, l.miniatura, GROUP_CONCAT(z.sciezka) AS zdjecia
          FROM laptopy l
          LEFT JOIN zdjecia z ON l.id_laptopa = z.id_laptopa
          WHERE l.czy_na_stronie=1";

$params = [];
$types = '';

if (!empty($brand)) {
    $query .= " AND l.producent LIKE ?";
    $params[] = "%$brand%";
    $types .= 's';
}
if ($screenSizeFrom > 0) {
    $query .= " AND l.przekatna >= ?";
    $params[] = $screenSizeFrom;
    $types .= 'i';
}
if ($screenSizeTo < PHP_INT_MAX) {
    $query .= " AND l.przekatna <= ?";
    $params[] = $screenSizeTo;
    $types .= 'i';
}
if ($priceFrom > 0) {
    $query .= " AND l.cena >= ?";
    $params[] = $priceFrom;
    $types .= 'd';
}
if ($priceTo < PHP_FLOAT_MAX) {
    $query .= " AND l.cena <= ?";
    $params[] = $priceTo;
    $types .= 'd';
}

$query .= " GROUP BY l.id_laptopa";

// Przygotowanie zapytania
$stmt = $conn->prepare($query);
if ($stmt === false) {
    error_log("Błąd przygotowania zapytania: " . $conn->error);
    exit("Wystąpił błąd. Proszę spróbować ponownie później.");
}

// Powiąż parametry z zapytaniem
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

// Wykonanie zapytania
if (!$stmt->execute()) {
    error_log("Błąd wykonania zapytania: " . $stmt->error);
    exit("Wystąpił błąd. Proszę spróbować ponownie później.");
}

$announcements = $stmt->get_result();

if ($announcements->num_rows > 0) {
    while ($announcement = $announcements->fetch_assoc()) {
        $zdjecia = explode(',', $announcement['zdjecia']);
        ?>
        <div class="announcement" 
            data-index="<?php echo htmlspecialchars($announcement['id_laptopa']); ?>"
            data-miniatura="<?php echo htmlspecialchars($announcement['miniatura']); ?>"
            data-nazwa="<?php echo htmlspecialchars($announcement['nazwa']); ?>"
            data-cena="<?php echo htmlspecialchars($announcement['cena']); ?>"
            data-producent="<?php echo htmlspecialchars($announcement['producent']); ?>"
            data-procesor="<?php echo htmlspecialchars($announcement['procesor']); ?>"
            data-ram="<?php echo htmlspecialchars($announcement['ram']); ?>"
            data-grafika="<?php echo htmlspecialchars($announcement['grafika']); ?>"
            data-procesorsz="<?php echo htmlspecialchars($announcement['procesor_sz']); ?>"
            data-dysk="<?php echo htmlspecialchars($announcement['dysk']); ?>"
            data-klawiatura="<?php echo htmlspecialchars($announcement['klawiatura']); ?>"
            data-przekatna="<?php echo htmlspecialchars($announcement['przekatna']); ?>"
            data-rozdzielczosc="<?php echo htmlspecialchars($announcement['rozdzielczosc']); ?>"
            data-matryca="<?php echo htmlspecialchars($announcement['matryca']); ?>"
            data-system="<?php echo htmlspecialchars($announcement['system']); ?>"
            data-porty="<?php echo htmlspecialchars($announcement['porty']); ?>"
            data-komunikacja="<?php echo htmlspecialchars($announcement['komunikacja']); ?>"
            data-multimedia="<?php echo htmlspecialchars($announcement['multimedia']); ?>"
            data-stan="<?php echo htmlspecialchars($announcement['stan']); ?>"
            data-czaspracy="<?php echo htmlspecialchars($announcement['czas_pracy']); ?>"
            data-zasilacz="<?php echo htmlspecialchars($announcement['zasilacz']); ?>"
            data-opis="<?php echo htmlspecialchars($announcement['opis']); ?>"
            data-ilosc="<?php echo htmlspecialchars($announcement['ilosc']); ?>"
            data-zdjecia="<?php echo htmlspecialchars(implode(',', $zdjecia)); ?>">
            <img src="<?php echo htmlspecialchars($announcement['miniatura']); ?>" alt="<?php echo htmlspecialchars($announcement['nazwa']); ?>">
            <div class="summary">
                <h2><?php echo htmlspecialchars($announcement['nazwa']); ?></h2>
                <p><strong>Cena:</strong> <?php echo htmlspecialchars($announcement['cena']); ?> zł</p>
                <p><strong>Producent:</strong> <?php echo htmlspecialchars($announcement['producent']); ?></p>
                <p><strong>Procesor:</strong> <?php echo htmlspecialchars($announcement['procesor']); ?></p>
                <p><strong>Pamięć RAM:</strong> <?php echo htmlspecialchars($announcement['ram']); ?></p>
                <p><strong>Grafika:</strong> <?php echo htmlspecialchars($announcement['grafika']); ?></p>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>Brak ogłoszeń do wyświetlenia.</p>";
}
?>
