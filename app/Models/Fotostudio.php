<?php
class Fotostudio
{
    public $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

	/* Öffentliche Bilder anzeigen - wenn nicht eingeloggt */
    public function picturesOpen(){
        $statement = $this->db->prepare('SELECT * FROM images WHERE oeffentlich = 0');
		$statement->execute();
        return $statement;
    }

	/* Alle Bilder anzeigen - wenn eingeloggt ist*/
	public function allPictures(){
		$statement = $this->db->prepare('SELECT * FROM images');
		$statement->execute();
        return $statement;
	}

	/* Alle Benutzer anzeigen - nur mit "Owner" Rolle möglich */
	public function getBenutzer(){
		$statement = $this->db->prepare('SELECT benutzerId, username, email, role FROM benutzer');
		$statement->execute();
        return $statement;
	}

	/* Bild hochladen - wenn man eingeloggt ist */
	public function bild_hinzufuegen($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties, $imgData, $id){
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
}