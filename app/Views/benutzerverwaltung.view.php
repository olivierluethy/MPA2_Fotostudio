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

<?php $pageTitle = 'Benutzerverwaltung'; $activeNav = 'benutzerverwaltung'; include('app/Views/partials/head.view.php'); ?>
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
                    <input type="text" id="benutzername" name="benutzername" placeholder="Benutzername eingeben"><br><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" placeholder="Email eingeben"><br><br>
                    <label for="passwort">Passwort:</label><br>
                    <input type="password" id="passwort" name="passwort" placeholder="Passwort eingeben"><br><br>
                    <label for="passwort_bestaetigen">Passwort bestätigen:</label><br>
                    <input type="password" id="passwort_bestaetigen" name="passwort_bestaetigen" placeholder="Passwort noch einmal eingeben"><br><br>
                    <input type="submit" value="Benutzer hinzufügen">
                </form>
            </div>
        </div>
    </div>

    <?php include('app/Views/bild_hinzufuegen.view.php'); ?>
    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBenutzerHinzufuegen.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>