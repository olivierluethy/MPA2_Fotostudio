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
		}
		/* Wenn Benutzer eingeloggt ist - entweder Rolle "Owner" oder "VIP" hat */
		else if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true && ($_SESSION['role'] == 1 || $_SESSION['role'] == 2)){
			$picAll = $Fotostudio -> allPictures();
        	$picAll = $picAll -> fetchAll();
		}
		require 'app/Views/home.view.php';
	}

	/* Alle Benutzer anzeigen - nur mit "Owner" Rolle möglich */
	public function benutzerverwaltung(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($_SESSION['role'] == 1){
			$benutzer = $Fotostudio -> getOwner();
        	$benutzer = $benutzer -> fetchAll();

			require 'app/Views/benutzerverwaltung.view.php';
		} else if($_SESSION['role'] == 2){
			header("location: home");
		}
		else {
			header("location: login");
		}
	}

	/* Bild hochladen - nur mit "Owner" oder "VIP" Rolle möglich */
	public function bild_hinzufuegen(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
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

            		$Fotostudio->bild_hinzufuegen($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties['mime'], $imgData, $_SESSION['id']);

					header("location: home");
				}
			}
		}
	}

	public function benutzer_hinzufuegen(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];

			$hashed_password = password_hash($_POST['passwort'], PASSWORD_DEFAULT);

            $Fotostudio->benutzer_hinzufuegen($benutzername, $email, $hashed_password);

            header('Location: benutzerverwaltung');
        }
	}

	public function deleteBenutzer(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$id = $_GET['id'];

		$Fotostudio->deleteBenutzer($id);
        
        header('Location: benutzerverwaltung');	
	}

	public function editBenutzer(){
		// Initialize the session
        session_start();

		$id = $_GET['id'];

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
			$passwort = $_POST['passwort'];

			$getBenutzer = $Fotostudio -> getBenutzer($id);
        	$getBenutzer = $getBenutzer -> fetchAll();
            
			if(password_verify($passwort, $getBenutzer[0][3])) {
				$Fotostudio->editBenutzer($benutzername, $email, $id);

            	header('Location: benutzerverwaltung');	
			}else{
				echo "<script>alert('Falsches Passwort!')</script>";
			}
        }else{
			$getBenutzer = $Fotostudio -> getBenutzer($id);
        	$getBenutzer = $getBenutzer -> fetchAll();
        }
		require 'app/Views/editBenutzer.view.php';
	}

	public function editBild(){
		// Initialize the session
        session_start();

		$id = $_GET['id'];

		$Fotostudio = new Fotostudio();
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
            
					$Fotostudio->editBild($titel, $beschreibung, $datum, $ort, $oeffentlich, $imageProperties['mime'], $imgData, $id);

            		header('Location: home');
				}
			}
        }else{
			$getImage = $Fotostudio -> getImage($id);
        	$getImage = $getImage -> fetchAll();

			require 'app/Views/editBild.view.php';
        }
	}

	public function deleteBild(){
		// Initialize the session
        session_start();

		$Fotostudio = new Fotostudio();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$id = $_GET['id'];

		$Fotostudio->deleteBild($id);
        
        header('Location: home');	
	}
}