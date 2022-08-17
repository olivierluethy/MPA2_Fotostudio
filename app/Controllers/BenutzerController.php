<?php

class BenutzerController
{
	/* Alle Benutzer anzeigen - nur mit "Owner" Rolle möglich */
	public function benutzerverwaltung(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$Benutzer = new Benutzer();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($_SESSION['role'] == 1){
			$benutzer = $Benutzer -> getOwner();
        	$benutzer = $benutzer -> fetchAll();

			require 'app/Views/benutzerverwaltung.view.php';
		} else if($_SESSION['role'] == 2){
			header("location: startseite");
		}
		else {
			header("location: login");
		}
	}

	public function benutzer_hinzufuegen(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$Benutzer = new Benutzer();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];

			$hashed_password = password_hash($_POST['passwort'], PASSWORD_DEFAULT);

            $Benutzer->benutzer_hinzufuegen($benutzername, $email, $hashed_password);

            header('Location: benutzerverwaltung');
        }
	}

	public function benutzer_loeschen(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$Benutzer = new Benutzer();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$id = $_GET['id'];

		$Benutzer->benutzer_loeschen($id);
        
        header('Location: benutzerverwaltung');	
	}

	public function benutzer_bearbeiten(){
		// Initialize the session
        session_start();

		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header('Location: login');
		}

		$id = $_GET['id'];

		$Benutzer = new Benutzer();
        $pdo = connectDatabase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
			$passwort = $_POST['passwort'];

			$getBenutzer = $Benutzer -> getBenutzer($id);
        	$getBenutzer = $getBenutzer -> fetchAll();
            
			/* Überprüfen ob das eingegebene Passwort mit dem der Datenbank übereinstimmt */
			if(password_verify($passwort, $getBenutzer[0][3])) {
				$Benutzer->benutzer_bearbeiten($benutzername, $email, $id);

            	header('Location: benutzerverwaltung');	
			}else{
				/* Falls das Passwort falsch ist */
				echo "<script>alert('Falsches Passwort!')</script>";
			}
        }else{
			/* Alle Benutzerdaten des VIPs anzeigen */
			$getBenutzer = $Benutzer -> getBenutzer($id);
        	$getBenutzer = $getBenutzer -> fetchAll();
        }
		require 'app/Views/benutzer_bearbeiten.view.php';
	}
}