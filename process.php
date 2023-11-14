<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données d'adresse depuis le formulaire
    $streets = isset($_POST["street"]) ? $_POST["street"] : [];
    $streetNumbers = isset($_POST["street_nb"]) ? $_POST["street_nb"] : [];
    $types = isset($_POST["type"]) ? $_POST["type"] : [];
    $cities = isset($_POST["city"]) ? $_POST["city"] : [];

    // Stocker les valeurs dans la session
    $_SESSION["street"] = $streets;
    $_SESSION["street_nb"] = $streetNumbers;
    $_SESSION["type"] = $types;
    $_SESSION["city"] = $cities;

    // Rediriger vers la page de vérification
    header("Location: verification.php");
    exit();
} else {
    // Rediriger vers la page d'accueil si la méthode n'est pas POST
    header("Location: index.php");
    exit();
}
?>
