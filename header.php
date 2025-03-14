<?php
include 'db.php';

$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

$timeout_duration = 1800;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page ?? 'Dakmode'); ?></title>
    <link rel="stylesheet" href="/algemeen.css">
</head>
<body>

<header>
    <a href="index.php" class="logo">
        <img src="images/logo.webp" alt="Dakmode logo">
        <h1>Dakmode</h1>
    </a>

    <nav>
        <ul>
            <?php if ($logged_in) : ?>
                <li><a href="index.php?page=home_loggedin">Home</a></li>
                <li><a href="index.php?page=facturen_loggedin">Facturen</a></li>
                <li><a href="index.php?page=reviews_loggedin">Reviews</a></li>
                <li><a href="index.php?page=mijn_profiel_loggedin">Mijn Profiel</a></li>
                <li>
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
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</body>
</html>

