<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Login</title>
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
        </div>
    </nav>

    <div class="login">
        <div class="form">
            <form id="login" class="login-form" action="login" method="POST">
                <span class="material-icons"><i class='fas fa-lock'></i></span>
                <?php
                if(isset($_SESSION["emailDirection"])){
                    echo "<input id='email' name='emailuser' value=" . $_SESSION["emailDirection"] . " type='email' placeholder='Enter Email' required
                    pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' required />";
                }else{
                    echo "<input id='email' name='emailuser' type='email' placeholder='Enter Email' required
                    pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' required />";
                }
                if(isset($_SESSION["passwordDirection"])){
                    echo "<input id='password' name='password' value=" . $_SESSION["passwordDirection"] . " type='password' placeholder='Enter Password' required />";
                }else {
                    echo "<input id='password' name='password' type='password' placeholder='Enter Password' required />";
                }
                ?>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <h1>Fotostudio</h1>
        <p id="year"></p>
    </footer>
    
    <script src="public/js/login.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>