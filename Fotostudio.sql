DROP DATABASE IF EXISTS fotostudio;
CREATE DATABASE fotostudio;
USE fotostudio;

--
-- Tabelle 'Benutzer'
--

CREATE TABLE benutzer (
  benutzerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  email VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role TINYINT(2), /* Normaler Benutzer: 0, Owner: 1, VIP: 2 */
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Tabelle 'Images'
--

CREATE TABLE images (
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

/* Beispiel Daten */
INSERT INTO `benutzer` (`username`, `email`, `password`, `role`, `created_at`) VALUES
/* Owner */
('Kauz Admin', 'kauz@kauz.ch', '$2y$10$obgm5U7eZWbqYcDoC4YcB.EMC1yAuhj8d0jx1MEK/IURpIrIbzED.', 1, '2022-08-05 13:55:59'),
/* VIP */
('TestFaktor', 'test@test.ch', '$2y$10$obgm5U7eZWbqYcDoC4YcB.EMC1yAuhj8d0jx1MEK/IURpIrIbzED.', 2, '2022-08-05 13:55:59');