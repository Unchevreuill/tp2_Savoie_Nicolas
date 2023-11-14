<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données d'adresse depuis le formulaire d'adresse
    $streets = $_POST["street"];
    $streetNumbers = $_POST["street_nb"];
    $types = $_POST["type"];
    $cities = $_POST["city"];

    //internal import
    include_once("db_config.php");

    
    $stmt = $conn->prepare("INSERT INTO adresse (street, street_nb, type, city) VALUES (?, ?, ?, ?)");

    
    $stmt->bind_param("siss", $street, $street_nb, $type, $city);

    // for pour inserer mes adresse
    for ($i = 0; $i < count($streets); $i++) {
        $street = $streets[$i];
        $street_nb = $streetNumbers[$i];
        $type = $types[$i];
        $city = $cities[$i];

        // executer ma requete
        $stmt->execute();
    }

    // Fermer mes connexions
    $stmt->close();
    $conn->close();

    // Redirection vers verification.php
    header("Location: verification.php");
    exit();
}
?>
