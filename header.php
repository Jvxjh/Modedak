<?php


// Controleer of de gebruiker is ingelogd
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Sessie timeout instellen (bijv. 30 minuten)
$timeout_duration = 1800;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// Variabele om te bepalen of het inlogformulier moet worden weergegeven
$show_login_form = isset($_POST['username']) && isset($login_error);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page; ?></title>
    <link rel="stylesheet" href="/algemeen.css">
</head>
<header>

    <a href="home.php" class="logo">
        <img src="images/logo.webp" alt="Dakmode logo">
        <h1>Dakmode</h1>
    </a>

    <nav>
        <ul>
            <?php if ($logged_in) : ?>
                <li><a href="home_loggedin.php">Home</a></li>
                <li><a href="facturen_loggedin.php">Facturen</a></li>
                <li><a href="reviews_loggedin.php">Reviews</a></li>
                <li><a href="mijn_profiel_loggedin.php">Mijn Profiel</a></li>
                <li>
                    <!-- Uitlogformulier -->
                    <form action="logout.php" method="POST">
                        <button type="submit" class="logout-btn">Uitloggen</button>
                    </form>
                </li>
            <?php else : ?>
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#">Diensten</a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?page=bitumen-dak-leggen">Bitumen dak leggen</a></li>
                        <li><a href="index.php?page=dakpannen-leggen">Dakpannen Leggen</a></li>
                        <li><a href="index.php?page=regenpijp-vervangen">Regenpijp vervangen</a></li>
                        <li><a href="index.php?page=pannen-schikken">Pannen schikken</a></li>
                        <li><a href="index.php?page=dak-reinigen">Dak reinigen</a></li>
                        <li><a href="index.php?page=dakgoot-reinigen">Dakgoot reinigen</a></li>
                        <li><a href="index.php?page=spoed-nood-reparaties">Spoed reparaties</a></li>
                        <li><a href="index.php?page=dak-inspectie">Dak inspectie</a></li>
                    </ul>
                </li>
                <li><a href="index.php?page=vacatures">Vacatures</a></li>
                <li><a href="index.php?page=over-ons">Over ons</a></li>
                <li><a href="index.php?page=nieuws">Nieuws</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
                <li>
                    <button class="login-btn" onclick="toggleLoginForm()">Inloggen</button>
                    <div id="login-form" class="login-form" style="display: <?php echo ($show_login_form) ? 'block' : 'none'; ?>;">
                        <form action="index.php" method="POST">
                            <label for="username">Gebruikersnaam:</label>
                            <input type="text" name="username" id="username" required>
                            <label for="password">Wachtwoord:</label>
                            <input type="password" name="password" id="password" required>
                            <input type="submit" value="Inloggen">
                        </form>
                        <?php if (isset($login_error)): ?>
                            <p style="color: red;"><?php echo $login_error; ?></p>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

</header>
