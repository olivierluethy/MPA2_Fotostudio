<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/main.css">
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
            <a href="">Home</a>
            <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo "<button onclick='goToLogin()'>Einloggen  <i class='fas fa-sign-in-alt'></i></button>";
            }else{
                echo "<a href=''>Benutzer verwalten</a>";
                echo "<button>Bild hochladen <i class='fas fa-plus-circle'></i></button>";
                echo "<button onclick='goToLogOut()'>Ausloggen  <i class='fas fa-sign-out-alt'></i></button>";
            }
            ?>
        </div>
    </nav>

    <main>
        <!-- Bilder -->
        <div class="frame">
            <img src="https://images.pexels.com/photos/414102/pexels-photo-414102.jpeg?cs=srgb&dl=pexels-pixabay-414102.jpg&fm=jpg"
                alt="Mona Lisa" />
            <div class="infobox">
                <p>Titel:</p>
                <p>{Titel}</p>
                <p>Beschreibung:</p>
                <p>{Beschreibung}</p>
                <p>Datum:</p>
                <p>{Datum}</p>
                <p>Ort:</p>
                <p>{Ort}</p>
            </div>
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
            <div class="infobox">
                <p>Titel:</p>
                <p>{Titel}</p>
                <p>Beschreibung:</p>
                <p>{Beschreibung}</p>
                <p>Datum:</p>
                <p>{Datum}</p>
                <p>Ort:</p>
                <p>{Ort}</p>
            </div>
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
            <div class="infobox">
                <p>Titel:</p>
                <p>{Titel}</p>
                <p>Beschreibung:</p>
                <p>{Beschreibung}</p>
                <p>Datum:</p>
                <p>{Datum}</p>
                <p>Ort:</p>
                <p>{Ort}</p>
            </div>
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
            <div class="infobox">
                <p>Titel:</p>
                <p>{Titel}</p>
                <p>Beschreibung:</p>
                <p>{Beschreibung}</p>
                <p>Datum:</p>
                <p>{Datum}</p>
                <p>Ort:</p>
                <p>{Ort}</p>
            </div>
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
            <div class="infobox">
                <p>Titel:</p>
                <p>{Titel}</p>
                <p>Beschreibung:</p>
                <p>{Beschreibung}</p>
                <p>Datum:</p>
                <p>{Datum}</p>
                <p>Ort:</p>
                <p>{Ort}</p>
            </div>
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
        </div>
        <div class="frame">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/71829/mona-lisa.jpg" alt="Mona Lisa" />
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>

    <script src="public/js/main.js"></script>
</body>

</html>