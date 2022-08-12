<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/editBenutzer.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Bild bearbeiten</title>
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

    <form action="editBild?id=<?= $getImage[0][0] ?>" method="POST" enctype="multipart/form-data">
        <h2>Bild bearbeiten</h2>
        <label for="titel">Titel:</label><br>
        <input type="text" id="titel" name="titel" value="<?= $getImage[0][1] ?>" placeholder="Titel eingeben"><br>
        <label for="beschreibung">Beschreibung:</label><br>
        <input type="beschreibung" id="beschreibung" name="beschreibung" value="<?= $getImage[0][2] ?>" placeholder="Beschreibung eingeben"><br>
        <label for="datum">Datum:</label><br>
        <input type="date" id="datum" name="datum" value="<?= $getImage[0][3] ?>" placeholder="Datum eingeben"><br>
        <label for="ort">Ort:</label><br>
        <input type="text" id="ort" name="ort" value="<?= $getImage[0][4] ?>" placeholder="Ort eingeben"><br>
        <label for="oeffentlich">Öffentlich:</label><br>
        <?php
        if($getImage[0][5] == 1){
            echo "<input type='checkbox' id='oeffentlich' name='oeffentlich' value='Yes' checked placeholder='Öffentlich eingeben'><br>";
        }else {
            echo "<input type='checkbox' id='oeffentlich' name='oeffentlich' value='Yes' placeholder='Öffentlich eingeben'><br>";
        }
        ?>
        <label for="file">Bild auswählen:</label><br>
        <input type="file" id="myFile" name="filename"><br><br>
        <input type="submit" value="Bild ändern"><br>
    </form>

    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationEditImage.js"></script>
</body>

</html>