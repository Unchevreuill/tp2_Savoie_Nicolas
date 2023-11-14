<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données d'adresse depuis le formulaire d'adresse
    $streets = isset($_POST["street"]) ? $_POST["street"] : [];
    $streetNumbers = isset($_POST["street_nb"]) ? $_POST["street_nb"] : [];
    $types = isset($_POST["type"]) ? $_POST["type"] : [];
    $cities = isset($_POST["city"]) ? $_POST["city"] : [];

    // Inclure le fichier de configuration de la base de données
    include_once("db_config.php");

    // Préparer la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO adresse (street, street_nb, type, city) VALUES (?, ?, ?, ?)");

    // Liaison des paramètres
    $stmt->bind_param("siss", $street, $street_nb, $type, $city);

    // Boucle pour insérer chaque adresse
    for ($i = 0; $i < count($streets); $i++) {
        $street = $streets[$i];
        $street_nb = $streetNumbers[$i];
        $type = $types[$i];
        $city = $cities[$i];

        // Exécution de la requête
        $stmt->execute();
    }

    // Fermer la connexion et le statement
    $stmt->close();
    $conn->close();

    // Rediriger vers la page de vérification
    header("Location: verification.php");
    exit();
}
?>

