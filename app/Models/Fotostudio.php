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
        $statement = $this->db->prepare('SELECT images.imageId, images.titel, images.beschreibung, images.datum, images.ort, images.imageType, images.imageData, benutzer.username FROM images
		INNER JOIN benutzer ON benutzer.benutzerId = images.fk_benutzerId WHERE oeffentlich = 1');
		$statement->execute();
        return $statement;
    }

	/* Alle Bilder anzeigen - wenn eingeloggt ist*/
	public function allPictures(){
		$statement = $this->db->prepare('SELECT images.imageId, images.titel, images.beschreibung, images.datum, images.ort, images.imageType, images.imageData, benutzer.username FROM images
		INNER JOIN benutzer ON benutzer.benutzerId = images.fk_benutzerId');
		$statement->execute();
        return $statement;
	}

	/* Alle Benutzer anzeigen - nur mit "Owner" Rolle möglich */
	public function getOwner(){
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

	public function benutzer_hinzufuegen($benutzername, $email, $hashed_password){
		$statement = $this->db->prepare("INSERT INTO `benutzer` (username, email, password, role) VALUES (:username, :email, :password, 2)");
		$statement->bindParam(':username', $benutzername, PDO::PARAM_STR);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
		$statement->execute();
	}

	public function deleteBenutzer($id){
		$statement = $this->db->prepare('DELETE FROM `benutzer` WHERE benutzerId = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
	}

	public function getBenutzer($id){
		$statement = $this->db->prepare('SELECT * FROM `benutzer` WHERE benutzerId = :id');
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
		return $statement;
	}

	public function editBenutzer($benutzername, $email, $id){
		$benutzername = htmlspecialchars($_POST['benutzername']);
		$email = htmlspecialchars($_POST['email']);

		$statement = $this->db->prepare('UPDATE benutzer SET username = :username, email = :email WHERE benutzerId = :id');
		$statement->bindParam(':username', $benutzername);
		$statement->bindParam(':email', $email);
		$statement->bindParam(':id', $id);
		$statement->execute();
	}

	public function editBild($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties, $imgData, $id){
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

	public function getImage($id){
		$statement = $this->db->prepare('SELECT * FROM `images` WHERE imageId = :id');
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
		return $statement;
	}

	public function deleteBild($id){
		$statement = $this->db->prepare('DELETE FROM `images` WHERE imageId = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
	}
}