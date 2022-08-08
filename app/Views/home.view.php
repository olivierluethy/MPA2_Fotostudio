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

    <script src="public/js/app.js"></script>
</body>

</html>