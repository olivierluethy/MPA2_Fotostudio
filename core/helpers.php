<?php
/**
 * Nutze diese Funktion um einfach eine Ausgabe
 * mit htmlspecialchars() zu erstellen.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

/**
 * Nutze diese Funktion um auf einen POST-Wert
 * zuzugreifen.
 */
function post(string $key, $default = '')
{
    return $_POST[$key] ?? $default;
}

/**
 * Formatiert ein ISO-Datum (Y-m-d) einheitlich im de-CH-Stil.
 *  - kompakt:  TT.MM.JJJJ      (z.B. 22.11.2025) für Tabellen/Listen
 *  - lang:     22. November 2025 für die Museums-Schilder
 * Nicht parsebare/leere Werte werden unverändert zurückgegeben.
 */
function formatDatum(?string $iso, bool $long = false): string
{
    if (!$iso) {
        return '';
    }
    try {
        $d = new DateTime($iso);
    } catch (Exception $e) {
        return $iso;
    }
    if ($long) {
        $monate = [1 => 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
                   'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
        return (int)$d->format('j') . '. ' . $monate[(int)$d->format('n')] . ' ' . $d->format('Y');
    }
    return $d->format('d.m.Y');
}

/**
 * Stellt eine Verbindung zur Datenbank her und gibt die
 * Datenbankverbindung als PDO zurück.
 */
$dbInstance = null;

function db(): PDO
{
    global $dbInstance;

    if ($dbInstance) {
        return $dbInstance;
    }

    try {
        $dbInstance = new PDO('mysql:host=127.0.0.1;fotostudio=' . $db['name'], $db['username'], $db['password'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ]);
    } catch (PDOException $e) {
        die('Keine Verbindung zur Datenbank möglich: ' . $e->getMessage());
    }
}