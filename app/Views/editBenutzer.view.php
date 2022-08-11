<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/editBenutzer.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Benutzer bearbeiten</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="part1" onclick="home()">
            <img src="assets/icon.png" alt="">
            <h1>Fotostudio</h1>
        </div>
        <div class="part2">
            <a class="active" href="">Home</a>
            <?php
            /* Wenn Benutzer noch nicht eingeloggt ist */
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo "<button onclick='goToLogin()'>Einloggen  <i class='fas fa-sign-in-alt'></i></button>";
            }else{
                if($_SESSION['role'] == 1){
                    echo "<a href='benutzerverwaltung'>Benutzer verwalten</a>";
                }
                if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                    echo "<button onclick='addImage()'>Bild hochladen <i class='fas fa-plus-circle'></i></button>";
                    echo "<button onclick='goToLogOut()'>Ausloggen  <i class='fas fa-sign-out-alt'></i></button>";
                }
            }
            ?>
        </div>
    </nav>

    <form action="editBenutzer?id=<?= $getBenutzer[0][0] ?>" method="POST">
        <h2>Benutzer bearbeiten</h2>
        <label for="benutzername">Benutzername:</label><br>
        <input type="text" id="benutzername" name="benutzername" value="<?= $getBenutzer[0][1] ?>" placeholder="Benutzernamen eingeben"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= $getBenutzer[0][2] ?>" placeholder="Email Adresse eingeben"><br>
        <label for="passwort">Passwort:</label><br>
        <input type="password" id="passwort" name="passwort" placeholder="Passwort eingeben"><br>
        <input type="submit" value="Benutzer ändern"><br>
    </form>

    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationEditUser.js"></script>
</body>

</html>