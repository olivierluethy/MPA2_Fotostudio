<?php

class FotostudioController
{
	public function index()
	{	
		// Initialize the session
        session_start();

        $Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Nicht angemeldet - öffentliche Bilder anzeigen */
		/* Wenn Benutzer noch nicht eingeloggt ist */
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			$picOpen = $Fotostudio -> picturesOpen();
        	$picOpen = $picOpen -> fetchAll();
		}else if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true && $_SESSION['role']){
			$picAll = $Fotostudio -> allPictures();
        	$picAll = $picAll -> fetchAll();
		}
		require 'app/Views/home.view.php';
	}
}

