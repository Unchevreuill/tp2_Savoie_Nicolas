<?php
session_start();

// Vérifier si le nombre d'adresses est défini dans la session
if (!isset($_SESSION["addressCount"])) {
    // Rediriger vers la page d'accueil si le nombre d'adresses n'est pas défini
    header("Location: index.php");
    exit();
}

// Internal import
include_once("db_config.php");

// Récupération des variables de session
$addressCount = $_SESSION["addressCount"];

// Afficher l'adresse pour vérification
echo "<h2>Récapitulatif des adresses</h2>";
for ($i = 0; $i < $addressCount; $i++) {
    $street = $_SESSION["street"][$i];
    $street_nb = $_SESSION["street_nb"][$i];
    $type = $_SESSION["type"][$i];
    $city = $_SESSION["city"][$i];

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
