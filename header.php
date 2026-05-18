
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page); ?></title>
    <link rel="stylesheet" href="/algemeen.css">
</head>
<header>

    <a href="index.php" class="logo">
        <img src="images/logo.webp" alt="Dakmode logo">
        <h1>Dakmode</h1>
    </a>

    <nav>
        <ul>
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
        </ul>
    </nav>

</header>
