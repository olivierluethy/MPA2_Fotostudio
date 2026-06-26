-- Schema für die Fotostudio-App.
-- Wird beim ERSTEN Start des MySQL-Containers automatisch ausgeführt
-- (docker-entrypoint-initdb.d). Die eigentlichen Mock-Daten werden danach
-- vom Web-Container über docker/seed.php eingefügt (inkl. echter Bilder).

CREATE DATABASE IF NOT EXISTS fotostudio;
USE fotostudio;

--
-- Tabelle 'benutzer'
--
CREATE TABLE IF NOT EXISTS benutzer (
  benutzerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  email VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role TINYINT(2), /* Normaler Benutzer: 0, Owner: 1, VIP: 2 */
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Tabelle 'images'
--
CREATE TABLE IF NOT EXISTS images (
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
);
