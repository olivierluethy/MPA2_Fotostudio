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
INSERT INTO `benutzer` (`benutzerId`, `username`, `email`, `password`, `role`, `created_at`) VALUES
/* Owner */
(1, 'LE FOU', 'olivier@kauz.ch', '$2y$10$y0xUU6lSEjcHPsx51kXfReInLBFC/6YgrXtjJM.mqLfykeR9eALJq', 1, '2022-08-05 13:54:26'),
/* VIP */
(2, 'TestFaktor', 'test@test.ch', '$2y$10$H6NDgXrwP82NF99WPDDwJeMy1FZTnsIVYcMc.dCKSSTFoILukq.Am', 2, '2022-08-05 13:55:59'),
/* Normaler Benutzer */
(3, 'Unendlich', 'spas@spas.ch', '$2y$10$H6NDgXrwP82NF99WPDDwJeMy1FZTnsIVYcMc.dCKSSTFoILukq.Am', '', '2022-08-05 13:55:59');