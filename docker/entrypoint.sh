#!/bin/bash
# Startskript des Web-Containers:
#  1. Auf die Datenbank warten
#  2. Mock-Daten einfügen (nur falls noch keine vorhanden -> idempotent)
#  3. Apache starten
set -e

DB_HOST="${DB_HOST:-db}"
DB_USERNAME="${DB_USERNAME:-root}"
DB_PASSWORD="${DB_PASSWORD:-}"

echo "[entrypoint] Warte auf Datenbank '${DB_HOST}' ..."
TRIES=0
until php -r '
    $h=getenv("DB_HOST"); $u=getenv("DB_USERNAME"); $p=getenv("DB_PASSWORD");
    try { new PDO("mysql:host=$h", $u, $p); exit(0); }
    catch (Throwable $e) { exit(1); }
' 2>/dev/null; do
    TRIES=$((TRIES+1))
    if [ "$TRIES" -gt 60 ]; then
        echo "[entrypoint] Datenbank nach 120s nicht erreichbar – starte trotzdem."
        break
    fi
    sleep 2
done
echo "[entrypoint] Datenbank erreichbar."

echo "[entrypoint] Seede Mock-Daten ..."
php /usr/local/bin/seed.php || echo "[entrypoint] Seeding übersprungen/fehlgeschlagen (nicht kritisch)."

echo "[entrypoint] Starte Apache ..."
exec "$@"
