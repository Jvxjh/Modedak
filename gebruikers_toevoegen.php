<?php
include 'db.php';

$gebruikers = [
    "admin" => "wachtwoord1",
    "gebruiker1" => "wachtwoord2",
    "gebruiker2" => "wachtwoord3",
    "gebruiker3" => "wachtwoord4",
    "gebruiker4" => "wachtwoord5"
];

foreach ($gebruikers as $username => $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
}
echo "Gebruikers toegevoegd!";
?>
