<?php 



$login_error = "";
$show_login_form = false; // Formulier standaard verborgen

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT wachtwoord FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("Location: home_loggedin.php");
            exit();
        } else {
            $login_error = "Wachtwoord is onjuist.";
        }
    } else {
        $login_error = "Gebruikersnaam bestaat niet.";
    }
    $stmt->close();
}

$page = $_GET['page'] ?? 'home';

include 'header.php';

$allowed_pages = ['home', 'diensten', 'vacatures', 'over-ons', 'nieuws', 'contact',
                  'bitumen-dak-leggen', 'dakpannen-leggen', 'regenpijp-vervangen',
                  'pannen-schikken', 'dak-reinigen', 'dakgoot-reinigen',
                  'spoed-nood-reparaties', 'dak-inspectie'];

$pagePath = "pages/" . $page . ".php";

if (in_array($page, $allowed_pages) && file_exists($pagePath)) {
    include $pagePath;
} else {
    include "pages/index.php";
}

include 'footer.php';

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
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page); ?></title>
    <link rel="stylesheet" href="/algemeen.css">
</head>