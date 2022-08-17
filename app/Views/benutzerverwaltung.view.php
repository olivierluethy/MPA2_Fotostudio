<?php
if((isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) && $_SESSION['role'] == 1){
    $benutzerCounter = 0;

    foreach($benutzer as $benutzer2){
        $benutzerCounter++;
    }
}else {
    header('Location: http://localhost/MPA_Fotostudio/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/benutzerverwaltung.css">
    <link rel="stylesheet" href="public/css/responsiveNav.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Benutzerverwaltung</title>
</head>

<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="part1" onclick="startseite()">
            <img src="assets/icon.png" alt="">
            <h1>Fotostudio</h1>
        </div>
        <div class="part2">
            <a href="startseite">Startseite</a>
            <?php
            /* Wenn Benutzer noch nicht eingeloggt ist */
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo "<button onclick='zuLogin()'>Einloggen  <i class='fas fa-sign-in-alt'></i></button>";
            }else{
                if($_SESSION['role'] == 1){
                    echo "<a class='active' href='benutzerverwaltung'>Benutzer verwalten</a>";
                }
                if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                    echo "<button onclick='bild_hinzufuegen()'>Bild hochladen <i class='fas fa-plus-circle'></i></button>";
                    echo "<button onclick='zuLogout()'>Ausloggen  <i class='fas fa-sign-out-alt'></i></button>";
                }
            }
            ?>
        </div>
    </nav>
    <main>
        <?php
        if($benutzerCounter > 0){
            echo "
            <div style='overflow-x:auto;'>
                <table>
                    <tr style='border:none;'>
                        <th><h1 style='color: white;'>Benutzerverwaltung</h1></th>
                        <th><button onclick='benutzer_hinzufuegen()'>Benutzer hinzufügen <i class='fas fa-plus'></i></button></th>
                    </tr>
                </table>
            
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Benutzername</th>
                        <th>Email</th>
                        <th>Rolle</th>
                        <th>Bearbeiten</th>
                        <th>Löschen</th>
                    </tr>";
                    foreach ($benutzer as $benutzer2){
                        echo "<tr>";
                        if($benutzer2['role'] == 1){
                            echo "
                            <td style='background-color: green;'>" . $benutzer2['benutzerId'] . "</td>
                            <td style='background-color: green;'>" . $benutzer2['username'] . "</td>
                            <td style='background-color: green;'>" . $benutzer2['email'] . "</td>
                            <td style='background-color: green;'>Owner</td>
                            <td style='background-color: green;'><a onclick='benutzer_bearbeiten(" . $benutzer2['benutzerId'] . ")'><button class='edit'><i class='fas fa-edit'></i> Bearbeiten</button></a></td>
                            <td style='background-color: green;'>Nicht möglich!</td>";

                        }else {
                            echo "
                            <td>" . $benutzer2['benutzerId'] . "</td>
                            <td>" . $benutzer2['username'] . "</td>
                            <td>" . $benutzer2['email'] . "</td>
                            <td>VIP</td>
                            <td><a onclick='benutzer_bearbeiten(" . $benutzer2['benutzerId'] . ")'><button class='edit'><i class='fas fa-edit'></i> Bearbeiten</button></a></td>
                            <td><a onclick='benutzer_loeschen(" . $benutzer2['benutzerId'] . ")'><button class='delete'><i class='fas fa-trash'></i> Löschen</button></a></td>";
                        }
                        echo "</tr>";
                    }
                echo "</table></div>";
        }else {
            echo "<h1 class='noData'>Noch keine Benutzer vorhanden</h1>";
        }
        ?>
    </main>

    <!-- Modal um Benutzer hinzuzufügen -->
    <div id="benutzer_hinzufuegen" class="benutzer_hinzufuegens">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="closeUser">&times;</span>
                <h2>Benutzer hinzufügen</h2>
            </div><br>
            <div class="modal-body">
                <form id="formbenutzer_hinzufuegen" action="benutzer_hinzufuegen" method="POST">
                    <label for="benutzername">Benutzername:</label><br>
                    <input type="text" id="benutzername" name="benutzername"><br><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email"><br><br>
                    <label for="passwort">Passwort:</label><br>
                    <input type="password" id="passwort" name="passwort"><br><br>
                    <label for="passwort_bestaetigen">Passwort bestätigen:</label><br>
                    <input type="password" id="passwort_bestaetigen" name="passwort_bestaetigen"><br><br>
                    <input type="submit" value="Benutzer hinzufügen">
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="bild_hinzufuegens" class="bild_hinzufuegens">
        <div class="modal-content">
            <div class="modal-header">
                <span class="closeImages">&times;</span>
                <h2>Bild hochladen</h2>
            </div><br>
            <div class="modal-body">
                <form id="formbild_hinzufuegen" action="bild_hinzufuegen" method="POST" enctype="multipart/form-data">
                    <label for="titel">Titel:</label><br>
                    <input type="text" id="titel" name="titel"><br><br>
                    <label for="beschreibung">Beschreibung:</label><br>
                    <textarea name="beschreibung" id="beschreibung" cols="30" rows="10"></textarea><br><br>
                    <label for="datum">Datum:</label><br>
                    <input type="date" id="datum" name="datum"><br><br>
                    <label for="ort">Ort:</label><br>
                    <input type="text" id="ort" name="ort"><br><br>
                    <label for="oeffentlich">Öffentlich:</label><br>
                    <input type="checkbox" id="oeffentlich" value="Yes" name="oeffentlich"><br><br>
                    <label for="file">Bild auswählen:</label><br>
                    <input type="file" id="myFile" name="filename"><br><br>
                    <input type="submit" value="Bild hochladen">
                </form>
            </div>
        </div>
    </div>

    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBenutzerHinzufuegen.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>