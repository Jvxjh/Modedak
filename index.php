<?php
session_start();
include 'db.php';

$login_error = "";
$show_login_form = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT wachtwoord FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;
            $_SESSION['LAST_ACTIVITY'] = time();
            $redirect_page = $_SESSION['redirect_page'] ?? 'index.php?page=home_loggedin';
            unset($_SESSION['redirect_page']);
            header("Location: $redirect_page");
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

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['redirect_page'] = "index.php?page=$page";
}

include 'header.php';

$allowed_pages = ['home', 'diensten', 'vacatures', 'over-ons', 'nieuws', 'contact', 
    'bitumen-dak-leggen', 'dakpannen-leggen', 'regenpijp-vervangen', 'pannen-schikken', 
    'dak-reinigen', 'dakgoot-reinigen', 'spoed-nood-reparaties', 'dak-inspectie', 
    'home_loggedin', 'facturen_loggedin', 'reviews_loggedin', 'mijn_profiel_loggedin'];

$pagePath = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? "logged_in_pages/$page.php" : "pages/$page.php";

if (in_array($page, $allowed_pages) && file_exists($pagePath)) {
    include $pagePath;
} else {
    include isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? "logged_in_pages/home_loggedin.php" : "pages/home.php";
}

include 'footer.php';
?>

<div id="login-form" style="display: none;">
    <form action="index.php" method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" id="password" required>
        
        <input type="submit" value="Inloggen">
    </form>
    <?php if (!empty($login_error)) { echo '<p style="color: red;">' . htmlspecialchars($login_error) . '</p>'; } ?>
</div>

<script>
function toggleLoginForm() {
    var form = document.getElementById('login-form');
    form.style.display = form.style.display === 'block' ? 'none' : 'block';
}
</script>

