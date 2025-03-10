<?php
session_start();

// Gebruikerslijst met SHA1-gehashte wachtwoorden
$users = [
    "admin" => sha1("wachtwoord1"),
    "gebruiker1" => sha1("wachtwoord2"),
    "gebruiker2" => sha1("wachtwoord3"),
    "gebruiker3" => sha1("wachtwoord4"),
    "gebruiker4" => sha1("wachtwoord5"),
];

$login_error = "";
$show_login_form = false; // Formulier standaard verborgen

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = sha1($_POST["password"] ?? "");

    if (!isset($users[$username])) {
        $login_error = "Gebruikersnaam bestaat niet.";
        
    } elseif ($users[$username] !== $password) {
        $login_error = "Wachtwoord is onjuist.";
     
    } else {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: home_loggedin.php"); // Verander dit naar de juiste pagina
        exit();
    }
}

// Welke pagina moet worden ingeladen?
//$page = $_GET['page'] ?? 'home';
if(isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'Home';
}

include 'header.php'; // Voeg de header toe


// Beveiliging: alleen toegestane pagina’s laden
$allowed_pages = ['home', 'diensten', 'vacatures', 'over-ons', 'nieuws', 'contact',
                  'bitumen-dak-leggen', 'dakpannen-leggen', 'regenpijp-vervangen',
                  'pannen-schikken', 'dak-reinigen', 'dakgoot-reinigen',
                  'spoed-nood-reparaties', 'dak-inspectie'];

$pagePath = "pages/" . $page . ".php"; // Zet het pad correct

if (in_array($page, $allowed_pages) && file_exists($pagePath)) {
    include $pagePath;
} else {
    include "pages/home.php"; // Zorg ervoor dat home.php wordt geladen als standaard
}

include 'footer.php'; // Voeg de footer toe

// Inlogformulier
if (!$show_login_form) {
    echo '<div id="login-form" style="display: none;"></div>';
} else {
    echo '<div id="login-form" style="display: block;">
            <form action="index.php" method="POST">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" required>
                
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" required>
                
                <input type="submit" value="Inloggen">
            </form>';
    if ($login_error) {
        echo '<p style="color: red;">' . $login_error . '</p>';
    }
    echo '</div>';
}
?>
