<?php
session_start();

// Vérif pour voir si mes donner sont dans ma variable de sessions
if (!isset($_SESSION["addressCount"])) {
    // si vide, redirection a index.php
    header("Location: index.php");
    exit();
}

// internal import
include_once("db_config.php");

// recuperation de mes variables de sessions
$addressCount = $_SESSION["addressCount"];

// Afficher ladresse pour verif
echo "<h2>Récapitulatif des adresses</h2>";
for ($i = 0; $i < $addressCount; $i++) {
    $street = $_POST["street"][$i];
    $street_nb = $_POST["street_nb"][$i];
    $type = $_POST["type"][$i];
    $city = $_POST["city"][$i];

    echo "<p>Adresse ", $i + 1, ":</p>";
    echo "<p>Street: ", $street, "</p>";
    echo "<p>Street Number: ", $street_nb, "</p>";
    echo "<p>Type: ", $type, "</p>";
    echo "<p>City: ", $city, "</p>";

    // Insérer les données dans la base de données
    $stmt = $conn->prepare("INSERT INTO adresse (street, street_nb, type, city) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $street, $street_nb, $type, $city);
    $stmt->execute();
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Vérification</title>
</head>
<body>
    <div class="container">
        <p>Les données ont été enregistrées avec succès dans la base de données.</p>
        <a href="index.php">Retour à la page d'accueil</a>
    </div>
</body>
</html>
