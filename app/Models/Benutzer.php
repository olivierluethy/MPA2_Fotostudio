<?php
class Benutzer
{
    public $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

	/* Alle Benutzer anzeigen - nur mit "Owner" Rolle möglich */
	public function getOwner(){
		$statement = $this->db->prepare('SELECT benutzerId, username, email, role FROM benutzer');
		$statement->execute();
        return $statement;
	}

	/* Benutzer hinzufügen - VIP */
	public function benutzer_hinzufuegen($benutzername, $email, $hashed_password){
		$isValid = true;
		$beschreibung = htmlspecialchars($_POST['beschreibung']);
		$email = htmlspecialchars($_POST['email']);
		$datum = htmlspecialchars($_POST['datum']);

		/* Check if email is valid */
		if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
			$isValid = false;
		}

		if($isValid){
			$statement = $this->db->prepare("INSERT INTO `benutzer` (username, email, password, role) VALUES (:username, :email, :password, 2)");
			$statement->bindParam(':username', $benutzername, PDO::PARAM_STR);
			$statement->bindParam(':email', $email, PDO::PARAM_STR);
			$statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
			$statement->execute();
		}
	}

	/* Benutzer löschen */
	public function benutzer_loeschen($id){
		$statement = $this->db->prepare('DELETE FROM `benutzer` WHERE benutzerId = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
	}

	/* Informationen über den VIP-Benutzer */
	public function getBenutzer($id){
		$statement = $this->db->prepare('SELECT * FROM `benutzer` WHERE benutzerId = :id');
		$statement->bindParam(':id', $id, PDO::PARAM_STR);
		$statement->execute();
		return $statement;
	}

	/* Benutzer bearbeiten */
	public function benutzer_bearbeiten($benutzername, $email, $id){
		$isValid = true;
		$benutzername = htmlspecialchars($_POST['benutzername']);
		$email = htmlspecialchars($_POST['email']);

		/* Check if email is valid */
		if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
			$isValid = false;
		}

		if($isValid){
			$statement = $this->db->prepare('UPDATE benutzer SET username = :username, email = :email WHERE benutzerId = :id');
			$statement->bindParam(':username', $benutzername);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':id', $id);
			$statement->execute();
		}
	}
}