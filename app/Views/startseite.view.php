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
    <link rel="stylesheet" href="public/css/startseite.css">
    <link rel="stylesheet" href="public/css/responsiveNav.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Startseite</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="part1" onclick="startseite()">
            <img src="assets/icon.png" alt="">
            <h1>Fotostudio</h1>
        </div>
        <div class="part2">
            <a class="active" href="">Startseite</a>
            <?php
            /* Wenn Benutzer noch nicht eingeloggt ist */
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo "<button class='loginBtn' onclick='zuLogin()'>Einloggen  <i class='fas fa-sign-in-alt'></i></button>";
            }else{
                if($_SESSION['role'] == 1){
                    echo "<a href='benutzerverwaltung'>Benutzer verwalten</a>";
                }
                if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                    echo "<button class='uploadBtn' onclick='bild_hinzufuegen()'>Bild hochladen <i class='fas fa-plus-circle'></i></button>";
                    echo "<button class='logoutBtn' onclick='zuLogout()'>Ausloggen  <i class='fas fa-sign-out-alt'></i></button>";
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
                echo "<h1 class='oeffentlicheBilder'>Öffentliche Bilder</h1>";
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
                echo "<h1 class='noData'>Keine öffentliche Bilder vorhanden</h1>";
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
                                </tr>";
                                /* Falls der Benutzer ein Owner ist */
                                if($_SESSION['role'] == 1){
                                    echo "
                                    <tr>
                                        <td><button onclick='bild_bearbeiten(" . $picAll2['imageId'] . ")' title='Bild bearbeiten' class='edit'><i class='fas fa-edit'></i> Bearbeiten</button></td>
                                        <td><button onclick='bild_loeschen(" . $picAll2['imageId'] . ")' title='Bild löschen' class='delete'><i class='fas fa-trash'></i> Löschen</button></td>
                                    </tr>";
                                }
                                /* Falls der Benutzer ein VIP ist */
                                else if($_SESSION['role'] == 2 && $picAll2['fk_benutzerId'] == $_SESSION['id']){
                                    echo "
                                    <tr>
                                        <td><button onclick='bild_bearbeiten(" . $picAll2['imageId'] . ")' title='Bild bearbeiten' class='edit'><i class='fas fa-edit'></i> Bearbeiten</button></td>
                                        <td><button onclick='bild_loeschen(" . $picAll2['imageId'] . ")' title='Bild löschen' class='delete'><i class='fas fa-trash'></i> Löschen</button></td>
                                    </tr>";   
                                }
                            echo "</table>
                        </div>
                    </div>";
                }
            }else {
                echo "<h1 class='noData'>Keine öffentliche oder private Bilder vorhanden</h1>";
            }
        }
        ?>
    </main>

    <?php include('app/Views/bild_hinzufuegen.view.php'); ?>
    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>