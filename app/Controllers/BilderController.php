<?php

class BilderController
{
    /* Öffentliche- | Private- und Öffentliche- Bilder auf Hauptseite anzeigen */
	public function index()
	{	
		// Initialize the session
        session_start();

        $Bilder = new Bilder();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Nicht angemeldet - öffentliche Bilder anzeigen */
		/* Wenn Benutzer noch nicht eingeloggt ist */
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			$picOpen = $Bilder -> oeffentlicheBilder();
        	$picOpen = $picOpen -> fetchAll();
		}
		/* Wenn Benutzer eingeloggt ist - entweder Rolle "Owner" oder "VIP" hat */
		else if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true && ($_SESSION['role'] == 1 || $_SESSION['role'] == 2)){
			$picAll = $Bilder -> alleBilder();
        	$picAll = $picAll -> fetchAll();
		}
		require 'app/Views/startseite.view.php';
	}

	/* Bild hochladen - nur mit "Owner" oder "VIP" Rolle möglich */
	public function bild_hinzufuegen(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$Bilder = new Bilder();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* For Image Upload */
            if(count($_FILES) > 0) {
                if(is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    $imgData = file_get_contents($_FILES['filename']['tmp_name']);
                    $imageProperties = getimageSize($_FILES['filename']['tmp_name']);

					$titel = $_POST['titel'];
					$beschreibung = $_POST['beschreibung'];
					$datum = $_POST['datum'];
					$ort = $_POST['ort'];
					$oeffentlich = $_POST['oeffentlich'];
					if ($oeffentlich == 'Yes') {
						$oeffentlich = 1;
					}else {
						$oeffentlich = 0;
					}

            		$Bilder->bild_hinzufuegen($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties['mime'], $imgData, $_SESSION['id']);

					header("location: startseite");
				}
			}
		}
	}

    /* Bild bearbeiten - für "Owner" möglich, aber auch für "VIP" wenn es sein eigenes Bild ist möglich */
	public function bild_bearbeiten(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$id = $_GET['id'];

		$Bilder = new Bilder();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/* For Image Upload */
            if(count($_FILES) > 0) {
                if(is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    $imgData = file_get_contents($_FILES['filename']['tmp_name']);
                    $imageProperties = getimageSize($_FILES['filename']['tmp_name']);

					$titel = $_POST['titel'];
					$beschreibung = $_POST['beschreibung'];
					$datum = $_POST['datum'];
					$ort = $_POST['ort'];
					$oeffentlich = $_POST['oeffentlich'];

					if ($oeffentlich == 'Yes') {
						$oeffentlich = 1;
					}else {
						$oeffentlich = 0;
					}
            
					$Bilder->bild_bearbeiten($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties['mime'], $imgData, $id);

            		header('Location: startseite');
				}
			}
        }else{
			$getImage = $Bilder -> bild_information($id);
        	$getImage = $getImage -> fetchAll();

			require 'app/Views/bild_bearbeiten.view.php';
        }
	}

    /* Bild löschen - für "Owner" möglich, aber auch für "VIP" wenn es sein eigenes Bild ist möglich */
	public function bild_loeschen(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$Bilder = new Bilder();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$id = $_GET['id'];

		$Bilder->bilder_loeschen($id);
        
        header('Location: startseite');	
	}
}