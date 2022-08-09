<?php
class Fotostudio
{
    public $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

	/* Alle öffentliche Bilder anzeigen - wenn nicht eingeloggt */
    public function picturesOpen(){
        $statement = $this->db->prepare('SELECT * FROM images WHERE oeffentlich = 0');
		$statement->execute();
        return $statement;
    }

	public function allPictures(){
		$statement = $this->db->prepare('SELECT * FROM images');
		$statement->execute();
        return $statement;
	}
}