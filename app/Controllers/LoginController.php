<?php

class LoginController{
    public function login(){
        // Output buffering, damit nach der Ausgabe der View weiterhin
        // Redirect-Header (header("location: ...")) gesendet werden können.
        ob_start();

        // Initialize the session
        session_start();
        
        // Check if the user is already logged in, if yes then redirect him to index page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: startseite");
            exit;
        }
        $pdo = connectDatabase();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        require 'app/Views/login/login.view.php';
        
        // Include config file
        // https://www.php.net/manual/de/function.require-once.php
        define('__ROOT__', dirname(dirname(__FILE__)));
        require_once(__ROOT__.'/Views/login/config.php');

        // Define variables and initialize with empty values
        $email = $password = "";
        $email_err = $password_err = "";

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if email is empty
            if (empty(trim($_POST["emailuser"]))) {
                $email_err = "Please enter email.";
            } else {
                $email = trim($_POST["emailuser"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate credentials
            if (empty($email_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT benutzerId, email, password, role FROM benutzer WHERE email = :email";
                
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    
                    // Set parameters
                    $email = trim($_POST["emailuser"]);
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if username exists, if yes then verify password
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $id = $row["benutzerId"];
                                $email = $row["email"];
                                $role = $row["role"];
                                $hashed_password = $row["password"];
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct. Die Session ist bereits
                                    // aktiv (siehe session_start() oben), daher hier
                                    // kein erneuter Aufruf nötig.

                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["email"] = $email;
                                    $_SESSION["role"] = $role;

                                    // Redirect user to index page
                                    header("location: startseite");
                                    exit;
                                } else {
                                    $_SESSION["emailDirection"] = $_POST['emailuser'];

                                    // Display an error message if password is not valid
                                    echo 
                                    "<div class='loginPasswordIsWrong'>
                                        <h2>Passwort ungültig</h2>
                                    </div>";
                                }
                            }
                        } else {
                            echo 
                            "<div class='loginPasswordIsWrong'>
                                <h2>Email Adresse wurde nicht gefunden</h2>
                            </div>";
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    unset($stmt);
                }
            }
        }
    }

    /* Damit sich der eingeloggte Benutzer wieder ausloggen kann */
    public function logout(){
        // Initialize the session
        session_start();

        $pdo = connectDatabase();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        require 'app/Views/login/logout.view.php';
    }
}