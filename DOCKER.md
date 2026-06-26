# Fotostudio in Docker ausführen (Ubuntu)

Die komplette Web-App läuft mit **einem Befehl** in Docker – inklusive
MySQL-Datenbank, vielen Mock-Daten und phpMyAdmin.

## Voraussetzungen

- Docker + Docker Compose Plugin (Ubuntu):
  ```bash
  sudo apt update && sudo apt install -y docker.io docker-compose-v2
  sudo usermod -aG docker $USER   # danach einmal aus-/einloggen
  ```

## Starten

Im Projektordner:

```bash
docker compose up --build
```

Beim ersten Start wird das Image gebaut, die Datenbank initialisiert und die
Mock-Daten (8 Benutzer + 24 Bilder) automatisch eingefügt.

Im Hintergrund laufen lassen: `docker compose up --build -d`

## Erreichbar unter

| Dienst        | URL / Adresse                | Zugang                                  |
|---------------|------------------------------|-----------------------------------------|
| **Web-App**   | http://localhost:8800        | siehe Login-Daten unten                 |
| **phpMyAdmin**| http://localhost:8801        | Server `db`, Benutzer `root`, Passwort leer (Auto-Login) |
| **MySQL**     | `localhost:3400`             | Benutzer `root`, ohne Passwort (für externe Tools) |

> Die Ports 8800 / 8801 / 3400 wurden gewählt, weil 8080/8081/3307 auf diesem
> Rechner bereits belegt waren. Bei Bedarf in `docker-compose.yml` anpassen.

## Login-Daten (Mock-Benutzer)

Alle Benutzer haben dasselbe Passwort: **`fotostudio`**
(Anmeldung erfolgt über die **E-Mail-Adresse**.)

| Rolle             | E-Mail                   |
|-------------------|--------------------------|
| Owner (verwaltet) | `admin@fotostudio.test`  |
| VIP               | `anna@fotostudio.test`   |
| VIP               | `beni@fotostudio.test`   |
| VIP               | `clara@fotostudio.test`  |
| VIP               | `test@fotostudio.test`   |
| Benutzer          | `david@fotostudio.test`  |
| Benutzer          | `elena@fotostudio.test`  |
| Benutzer          | `felix@fotostudio.test`  |

- **Nicht angemeldet:** nur die öffentlichen Bilder sind sichtbar.
- **Owner:** sieht alle Bilder, kann Bilder & Benutzer verwalten.
- **VIP:** sieht alle Bilder, kann eigene Bilder hochladen/bearbeiten.

## Nützliche Befehle

```bash
docker compose logs -f web      # Logs der Web-App ansehen
docker compose down             # Container stoppen (Daten bleiben erhalten)
docker compose down -v          # Container + Datenbank-Volume löschen (Reset)
```

Nach `down -v` werden beim nächsten `up` die Mock-Daten frisch neu erzeugt.

## Was wurde am Code geändert?

Das Design und die Funktionalität bleiben **unverändert**. Für den Betrieb in
Containern unter Linux waren nur drei minimale, abwärtskompatible Anpassungen
nötig:

1. `core/database.php` & `app/Views/login/config.php`: Der Datenbank-Host ist
   jetzt über die Umgebungsvariable `DB_HOST` einstellbar – **mit den bisherigen
   Werten als Standard**, ausserhalb von Docker ändert sich also nichts.
2. `app/Controllers/LoginController.php`: Ein Windows-Pfad mit Backslashes
   (`\Views\login\config.php`) wurde auf Schrägstriche umgestellt, da Linux
   sonst die Login-Konfiguration nicht laden kann.

Alle Docker-spezifischen Dateien liegen im Ordner `docker/` bzw. in
`docker-compose.yml` und `.dockerignore`.
