<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $picOpenCounter = 0;

    foreach ($picOpen as $picOpen2){
        $picOpenCounter++;
    }
}else if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
    $picAllCounter = 0;

    foreach ($picAll as $picAll2){
        $picAllCounter++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Allgemeines CSS -->
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <!-- Für nur diese Seite -->
    <link rel="stylesheet" href="public/css/home.css">
    <!-- Für Footer -->
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Fotostudio</title>
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

    <main>
        <!-- Bilder -->
        <?php
        /* Falls man nicht eingeloggt ist, werden nur öffentliche Bilder angezeigt */
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            if($picOpenCounter > 0){
                echo "<h1 style='color: white; margin-bottom: 1rem;'>Öffentliche Bilder</h1>";
                foreach ($picOpen as $picOpen2){
                    echo "
                    <div class='frame'>
                        <img src='data:" . $picOpen2['imageType'] . ";base64, ".base64_encode($picOpen2['imageData']). "'/>
                        <div class='infobox'>
                            <table style='width:100%'>
                                <tr>
                                    <td><h3>Titel:</h3></td>
                                    <td><h3>" . $picOpen2['titel'] . "</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Beschreibung:</h3></td>
                                    <td><h3>" . $picOpen2['beschreibung'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Datum:</h3></td>
                                <td><h3>" . $picOpen2['datum'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Ort:</h3></td>
                                <td><h3>" . $picOpen2['ort'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Veröffentlicht von:</h3></td>
                                <td><h3>" . $picOpen2['username'] . "</h3></td>
                                </tr>
                            </table>
                        </div>
                    </div>";
                }
            }else {
                echo "<h1 class='noData'>Keine öffentlichen Bilder vorhanden</h1>";
            }
        }
        /* Falls man eingeloggt ist, werden alle Bilder angezeigt */
        else if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
            if($picAllCounter > 0){
                foreach ($picAll as $picAll2){
                    echo "
                    <div class='frame'>
                        <img src='data:" . $picAll2['imageType'] . ";base64, ".base64_encode($picAll2['imageData']). "'/>
                        <div class='infobox'>
                            <table style='width:100%'>
                                <tr>
                                    <td><h3>Titel:</h3></td>
                                    <td><h3>" . $picAll2['titel'] . "</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Beschreibung:</h3></td>
                                    <td><h3>" . $picAll2['beschreibung'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Datum:</h3></td>
                                <td><h3>" . $picAll2['datum'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Ort:</h3></td>
                                <td><h3>" . $picAll2['ort'] . "</h3></td>
                                </tr>
                                <tr>
                                <td><h3>Veröffentlicht von:</h3></td>
                                <td><h3>" . $picAll2['username'] . "</h3></td>
                                </tr>
                            </table>
                        </div>
                    </div>";
                }
            }else {
                echo "<h1 class='noData'>Keine öffentliche oder private Bilder vorhanden</h1>";
            }
        }
        ?>
    </main>

    <!-- Modal -->
    <div id="addImages" class="addImages">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="closeImages">&times;</span>
                <h2>Bild hochladen</h2>
            </div><br>
            <div class="modal-body">
                <form action="bild_hinzufuegen" method="POST" enctype="multipart/form-data">
                    <label for="fname">Titel:</label><br>
                    <input type="text" id="fname" name="titel"><br><br>
                    <label for="lname">Beschreibung:</label><br>
                    <textarea name="beschreibung" id="" cols="30" rows="10"></textarea><br><br>
                    <label for="lname">Datum:</label><br>
                    <input type="date" id="lname" name="datum"><br><br>
                    <label for="lname">Ort:</label><br>
                    <input type="text" id="lname" name="ort"><br><br>
                    <label for="lname">Öffentlich:</label><br>
                    <input type="checkbox" id="lname" value="Yes" name="oeffentlich"><br><br>
                    <label for="file">Bild auswählen:</label><br>
                    <input type="file" id="myFile" name="filename"><br><br>
                    <input type="submit" value="Bild hochladen">
                </form>
            </div>
        </div>

    </div>
    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>

    <script src="public/js/main.js"></script>
</body>

</html>