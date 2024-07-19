<?php
// Sprawdzenie, czy żądanie jest metodą POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Odczytanie indeksu ogłoszenia z danych POST
    $index = isset($_POST['index']) ? intval($_POST['index']) : null;

    if ($index === null) {
        // Jeśli brak indeksu, zwróć błąd
        echo json_encode(['success' => false, 'message' => 'Brak indeksu']);
        exit;
    }

    // Ścieżka do pliku JSON
    $filePath = 'announcements.json';

    // Odczytanie ogłoszeń z pliku JSON
    $announcements = json_decode(file_get_contents($filePath), true);

    // Sprawdzenie, czy ogłoszenie istnieje
    if (isset($announcements[$index])) {
        // Usunięcie ogłoszenia z tablicy
        unset($announcements[$index]);
        // Reindexowanie tablicy
        $announcements = array_values($announcements);
        // Zapisanie zaktualizowanej tablicy do pliku JSON
        file_put_contents($filePath, json_encode($announcements, JSON_PRETTY_PRINT));
        // Zwrócenie sukcesu
        echo json_encode(['success' => true]);
    } else {
        // Jeśli ogłoszenie nie istnieje, zwróć błąd
        echo json_encode(['success' => false, 'message' => 'Ogłoszenie nie znalezione']);
    }
} else {
    // Jeśli żądanie nie jest metodą POST, zwróć błąd
    echo json_encode(['success' => false, 'message' => 'Niepoprawny typ żądania']);
}
?>
