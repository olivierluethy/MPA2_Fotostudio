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
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Benutzerverwaltung</title>
</head>

<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="part1" onclick="home()">
            <img src="assets/icon.png" alt="">
            <h1>Fotostudio</h1>
        </div>
        <div class="part2">
            <a href="home">Home</a>
            <?php
            /* Wenn Benutzer noch nicht eingeloggt ist */
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo "<button onclick='goToLogin()'>Einloggen  <i class='fas fa-sign-in-alt'></i></button>";
            }else{
                if($_SESSION['role'] == 1){
                    echo "<a class='active' href='benutzerverwaltung'>Benutzer verwalten</a>";
                }
                if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
                    echo "<button>Bild hochladen <i class='fas fa-plus-circle'></i></button>";
                    echo "<button onclick='goToLogOut()'>Ausloggen  <i class='fas fa-sign-out-alt'></i></button>";
                }
            }
            ?>
        </div>
    </nav>
    <main>
        <?php
        if($benutzerCounter > 0){
            echo "<h1 style='color: white;'>Benutzerverwaltung</h1>
            <div style='overflow-x: auto;'>
                <table>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Savings</th>
                        <th>Bearbeiten</th>
                        <th>Löschen</th>
                    </tr>";
                    foreach ($benutzer as $benutzer2){
                        echo "<tr>
                        <td>" . $benutzer2['benutzerId'] . "</td>
                        <td>" . $benutzer2['username'] . "</td>
                        <td>" . $benutzer2['email'] . "</td>
                        <td>" . $benutzer2['role'] . "</td>
                        </tr>";
                    }
                echo "</table>
            </div>";
        }else {
            echo "<h1 class='noData'>Noch keine Benutzer vorhanden</h1>";
        }
        ?>
    </main>

    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>

    <script src="public/js/main.js"></script>
</body>

</html>