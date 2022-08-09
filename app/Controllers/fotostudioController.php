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
		}else if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true && ($_SESSION['role'] == 1 || $_SESSION['role'] == 2)){
			$picAll = $Fotostudio -> allPictures();
        	$picAll = $picAll -> fetchAll();
		}
		require 'app/Views/home.view.php';
	}

	public function benutzerverwaltung(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($_SESSION['role'] == 1){
			$benutzer = $Fotostudio -> getBenutzer();
        	$benutzer = $benutzer -> fetchAll();

			require 'app/Views/benutzerverwaltung.view.php';
		} else if($_SESSION['role'] == 2){
			header("location: home");
		}
		else {
			header("location: login");
		}
	}
}