<?php
class Bilder
{
    public $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

	/* Öffentliche Bilder anzeigen - wenn nicht eingeloggt */
    public function oeffentlicheBilder(){
        $statement = $this->db->prepare('SELECT images.imageId, images.titel, images.beschreibung, images.datum, images.ort, images.imageType, images.imageData, benutzer.username FROM images
		INNER JOIN benutzer ON benutzer.benutzerId = images.fk_benutzerId WHERE oeffentlich = 1');
		$statement->execute();
        return $statement;
    }

	/* Alle Bilder anzeigen - wenn eingeloggt ist*/
	public function alleBilder(){
		$statement = $this->db->prepare('SELECT images.imageId, images.titel, images.beschreibung, images.datum, images.ort, images.imageType, images.imageData, images.fk_benutzerId, benutzer.username FROM images
		INNER JOIN benutzer ON benutzer.benutzerId = images.fk_benutzerId');
		$statement->execute();
        return $statement;
	}

	/* Bild hochladen - wenn man eingeloggt ist */
	public function bild_hinzufuegen($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties, $imgData, $id){
		$titel = htmlspecialchars($_POST['titel']);
		$beschreibung = htmlspecialchars($_POST['beschreibung']);
		$datum = htmlspecialchars($_POST['datum']);
		$ort = htmlspecialchars($_POST['ort']);

		$statement = $this->db->prepare("INSERT INTO `images` (titel, beschreibung, datum, ort, oeffentlich, imageType, imageData, fk_benutzerId) VALUES (:titel, :beschreibung, :datum, :ort, :oeffentlich, :imageType, :imageData, :id)");
		$statement->bindParam(':titel', $titel, PDO::PARAM_STR);
		$statement->bindParam(':beschreibung', $beschreibung, PDO::PARAM_STR);
		$statement->bindParam(':datum', $datum, PDO::PARAM_STR);
		$statement->bindParam(':ort', $ort, PDO::PARAM_STR);
		$statement->bindParam(':oeffentlich', $oeffentlich, PDO::PARAM_STR);
		$statement->bindParam(':imageType', $imageProperties, PDO::PARAM_STR);
		$statement->bindParam(':imageData', $imgData, PDO::PARAM_LOB);
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
	}

	/* Um das Bild zu bearbeiten */
	public function bild_bearbeiten($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties, $imgData, $id){
		$titel = htmlspecialchars($_POST['titel']);
		$beschreibung = htmlspecialchars($_POST['beschreibung']);
		$datum = htmlspecialchars($_POST['datum']);
		$ort = htmlspecialchars($_POST['ort']);

		$statement = $this->db->prepare('UPDATE images SET titel = :titel, beschreibung = :beschreibung, datum = :datum, ort = :ort, oeffentlich = :oeffentlich, imageType = :imageType, imageData = :imageData WHERE imageId = :id');
		$statement->bindParam(':titel', $titel, PDO::PARAM_STR);
		$statement->bindParam(':beschreibung', $beschreibung, PDO::PARAM_STR);
		$statement->bindParam(':datum', $datum, PDO::PARAM_STR);
		$statement->bindParam(':ort', $ort, PDO::PARAM_STR);
		$statement->bindParam(':oeffentlich', $oeffentlich, PDO::PARAM_STR);
		$statement->bindParam(':imageType', $imageProperties, PDO::PARAM_STR);
		$statement->bindParam(':imageData', $imgData, PDO::PARAM_LOB);
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
	}

	/* Informationen über das Bild erhalten */
	public function bild_information($id){
		$statement = $this->db->prepare('SELECT * FROM `images` WHERE imageId = :id');
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
		return $statement;
	}

	/* Das Bild löschen */
	public function bilder_loeschen($id){
		$statement = $this->db->prepare('DELETE FROM `images` WHERE imageId = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
	}
}