<?php
/**
 * Mock-Daten-Seeder für die Fotostudio-App.
 *
 * Wird vom Web-Container beim Start aufgerufen (siehe entrypoint.sh).
 * Legt eine Reihe von Benutzern und echten Beispielbildern an.
 *
 * Idempotent: Wenn bereits Bilder vorhanden sind, wird nichts gemacht.
 *
 * Alle Benutzer haben das Passwort:  fotostudio
 * Login erfolgt über die E-Mail-Adresse.
 */

$host = getenv('DB_HOST') ?: '127.0.0.1';
$name = getenv('DB_NAME') ?: 'fotostudio';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (Throwable $e) {
    fwrite(STDERR, "[seed] Keine DB-Verbindung: " . $e->getMessage() . "\n");
    exit(1);
}

/* Datenbank + Schema sicherstellen (falls init.sql nicht lief). */
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4");
$pdo->exec("USE `$name`");
$pdo->exec("CREATE TABLE IF NOT EXISTS benutzer (
    benutzerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role TINYINT(2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
$pdo->exec("CREATE TABLE IF NOT EXISTS images (
    imageId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titel VARCHAR(100) NOT NULL,
    beschreibung VARCHAR(255) NOT NULL,
    datum DATE NOT NULL,
    ort VARCHAR(50) NOT NULL,
    oeffentlich TINYINT(1) NOT NULL,
    imageType varchar(255) NOT NULL,
    imageData longblob NOT NULL,
    fk_benutzerId INT NOT NULL,
    FOREIGN KEY (fk_benutzerId) REFERENCES benutzer(benutzerId)
)");

/* Idempotenz: schon Bilder vorhanden? Dann nichts tun. */
$imageCount = (int) $pdo->query("SELECT COUNT(*) FROM images")->fetchColumn();
if ($imageCount > 0) {
    echo "[seed] Bereits $imageCount Bilder vorhanden – kein erneutes Seeding.\n";
    exit(0);
}

$passwordHash = password_hash('fotostudio', PASSWORD_DEFAULT);

/* --- Benutzer ------------------------------------------------------------
   role: 0 = normaler Benutzer, 1 = Owner, 2 = VIP                          */
$benutzer = [
    ['Kauz Admin',      'admin@fotostudio.test',  1],
    ['Anna Fotografie', 'anna@fotostudio.test',   2],
    ['Beni Bilder',     'beni@fotostudio.test',   2],
    ['Clara Kamera',    'clara@fotostudio.test',  2],
    ['TestFaktor',      'test@fotostudio.test',   2],
    ['David Studio',    'david@fotostudio.test',  0],
    ['Elena Linse',     'elena@fotostudio.test',  0],
    ['Felix Foto',      'felix@fotostudio.test',  0],
];

$benutzerIds = [];
$insBenutzer = $pdo->prepare(
    "INSERT INTO benutzer (username, email, password, role)
     VALUES (:username, :email, :password, :role)"
);
foreach ($benutzer as $b) {
    /* Falls der Benutzer schon existiert (Teil-Seed), vorhandene Id nutzen. */
    $exists = $pdo->prepare("SELECT benutzerId FROM benutzer WHERE email = ?");
    $exists->execute([$b[1]]);
    $id = $exists->fetchColumn();
    if ($id === false) {
        $insBenutzer->execute([
            ':username' => $b[0],
            ':email'    => $b[1],
            ':password' => $passwordHash,
            ':role'     => $b[2],
        ]);
        $id = (int) $pdo->lastInsertId();
    }
    $benutzerIds[] = (int) $id;
}
echo "[seed] " . count($benutzerIds) . " Benutzer bereit.\n";

/* Bilder werden Eigentümern/VIPs (role 1 oder 2) zugeordnet. */
$uploaderIds = [];
$roleStmt = $pdo->prepare("SELECT benutzerId FROM benutzer WHERE role IN (1,2)");
$roleStmt->execute();
$uploaderIds = $roleStmt->fetchAll(PDO::FETCH_COLUMN);
if (!$uploaderIds) { $uploaderIds = $benutzerIds; }

/* --- Bilddaten (Mock-Motive) -------------------------------------------- */
$motive = [
    ['Sonnenuntergang am See',  'Warmes Abendlicht über dem Wasser.',          'Zürichsee'],
    ['Bergpanorama',            'Schroffe Gipfel im Morgennebel.',             'Zermatt'],
    ['Altstadtgasse',           'Kopfsteinpflaster und alte Fassaden.',        'Bern'],
    ['Herbstwald',              'Buntes Laub im Gegenlicht.',                  'Emmental'],
    ['Stadt bei Nacht',         'Lichter und Reflexionen nach Regen.',         'Genf'],
    ['Blütenmakro',             'Eine Wildblume aus nächster Nähe.',           'Tessin'],
    ['Wasserfall',              'Langzeitbelichtung des Bergbachs.',           'Lauterbrunnen'],
    ['Portrait im Studio',      'Sanftes Setup mit weichem Licht.',            'Studio Luzern'],
    ['Winterlandschaft',        'Verschneite Tannen in der Stille.',           'Davos'],
    ['Strandlinie',             'Lange Wellen am frühen Morgen.',              'Ascona'],
    ['Architektur abstrakt',    'Spiel aus Linien und Schatten.',             'Basel'],
    ['Nebelmeer',               'Über den Wolken auf dem Gipfel.',             'Rigi'],
    ['Weinberg',                'Reben im sanften Hügelland.',                 'Lavaux'],
    ['Streetfotografie',        'Ein Moment im Vorbeigehen.',                  'Lausanne'],
    ['Sternenhimmel',           'Milchstrasse über dem Tal.',                  'Engadin'],
    ['Brücke im Nebel',         'Stahlkonstruktion im Dunst.',                 'Schaffhausen'],
    ['Tierportrait',            'Ein neugieriger Blick.',                      'Zoo Zürich'],
    ['Reflexionen',             'Spiegelung im ruhigen Wasser.',               'Vierwaldstättersee'],
    ['Minimalismus',            'Reduziert auf das Wesentliche.',              'Studio Luzern'],
    ['Sonnenaufgang',          'Erste Strahlen über dem Horizont.',           'Säntis'],
    ['Marktstand',              'Farben und Früchte am Morgen.',               'Lugano'],
    ['Lichterkette',            'Bokeh in der Abenddämmerung.',                'Winterthur'],
    ['Alte Tür',                'Verwittertes Holz mit Patina.',               'Gruyères'],
    ['Feldweg',                 'Linien, die in die Ferne führen.',            'Aargau'],
];

/**
 * Erzeugt ein einfaches, aber ansprechendes Verlaufsbild (JPEG) als Binärstring.
 */
function makeImage(int $seed, string $titel): string
{
    $w = 800; $h = 600;
    $img = imagecreatetruecolor($w, $h);

    /* Deterministische Farben aus dem Seed ableiten. */
    $r1 = (37 * $seed + 30) % 200 + 30;
    $g1 = (59 * $seed + 80) % 200 + 30;
    $b1 = (83 * $seed + 130) % 200 + 30;
    $r2 = (200 - $r1 + $seed * 11) % 256;
    $g2 = (200 - $g1 + $seed * 17) % 256;
    $b2 = (200 - $b1 + $seed * 23) % 256;

    /* Vertikaler Farbverlauf. */
    for ($y = 0; $y < $h; $y++) {
        $t = $y / $h;
        $r = (int) ($r1 + ($r2 - $r1) * $t);
        $g = (int) ($g1 + ($g2 - $g1) * $t);
        $b = (int) ($b1 + ($b2 - $b1) * $t);
        $col = imagecolorallocate($img, $r, $g, $b);
        imagefilledrectangle($img, 0, $y, $w, $y, $col);
    }

    /* Ein paar transparente Kreise für etwas Tiefe. */
    for ($i = 0; $i < 6; $i++) {
        $cx = (($seed * 53 + $i * 97) % $w);
        $cy = (($seed * 29 + $i * 61) % $h);
        $d  = 80 + (($seed + $i * 40) % 220);
        $cc = imagecolorallocatealpha(
            $img,
            ($r2 + $i * 25) % 256,
            ($g2 + $i * 15) % 256,
            ($b2 + $i * 35) % 256,
            85
        );
        imagefilledellipse($img, $cx, $cy, $d, $d, $cc);
    }

    /* Halbtransparenter Balken + Titeltext unten. */
    $bar = imagecolorallocatealpha($img, 0, 0, 0, 70);
    imagefilledrectangle($img, 0, $h - 70, $w, $h, $bar);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagestring($img, 5, 24, $h - 48, $titel, $white);
    imagestring($img, 3, 24, 24, "Fotostudio  ·  Mock #" . $seed, $white);

    ob_start();
    imagejpeg($img, null, 82);
    $data = ob_get_clean();
    imagedestroy($img);
    return $data;
}

$insImage = $pdo->prepare(
    "INSERT INTO images (titel, beschreibung, datum, ort, oeffentlich, imageType, imageData, fk_benutzerId)
     VALUES (:titel, :beschreibung, :datum, :ort, :oeffentlich, :imageType, :imageData, :id)"
);

$created = 0;
foreach ($motive as $i => $m) {
    $imgData = makeImage($i + 1, $m[0]);

    /* Datum über die letzten ~2 Jahre verteilen (deterministisch). */
    $daysAgo = ($i * 31 + 5) % 730;
    $datum = date('Y-m-d', strtotime("-{$daysAgo} days", strtotime('2026-06-01')));

    /* ca. 70% öffentlich, der Rest privat. */
    $oeffentlich = ($i % 10 < 7) ? 1 : 0;

    $uploader = $uploaderIds[$i % count($uploaderIds)];

    $insImage->execute([
        ':titel'        => $m[0],
        ':beschreibung' => $m[1],
        ':datum'        => $datum,
        ':ort'          => $m[2],
        ':oeffentlich'  => $oeffentlich,
        ':imageType'    => 'image/jpeg',
        ':imageData'    => $imgData,
        ':id'           => $uploader,
    ]);
    $created++;
}

echo "[seed] $created Bilder erstellt. Seeding abgeschlossen.\n";
echo "[seed] Login z.B.: admin@fotostudio.test / fotostudio (Owner)\n";
