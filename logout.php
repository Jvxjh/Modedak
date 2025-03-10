<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php"); // Zorgt ervoor dat je naar de niet-ingelogde versie teruggaat
exit();
?>
