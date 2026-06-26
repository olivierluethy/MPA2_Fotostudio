<?php

function connectDatabase() {
    try {
        /* Host/Zugangsdaten via Umgebungsvariablen (für Docker), mit den
           bisherigen Standardwerten als Fallback, damit sich ausserhalb
           von Docker nichts ändert. */
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $name = getenv('DB_NAME') ?: 'fotostudio';
        $user = getenv('DB_USERNAME') ?: 'root';
        $pass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
        /* charset=utf8mb4 stellt sicher, dass Umlaute korrekt gespeichert und
           gelesen werden (sonst latin1-Verbindung -> mögliche Mojibake). */
        return new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    } catch (PDOException $e) {
        die('Keine Verbindung zur Datenbank möglich: ' . $e->getMessage());
    }
}