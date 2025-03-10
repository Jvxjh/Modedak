<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Voeg hier de inhoud van de pagina toe
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="/algemeen.css">
</head>
<body>
    <header>
        <!-- Voeg hier de header-inhoud toe -->
    </header>
    <main>
        <h1>Welkom, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <!-- Voeg hier de profielinhoud toe -->
    </main>
    <footer>
        <!-- Voeg hier de footer-inhoud toe -->
    </footer>
</body>
</html>