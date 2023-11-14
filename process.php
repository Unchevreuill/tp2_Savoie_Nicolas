<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recuperer le nb d'adresse
    $addressCount = $_POST["addressCount"];

   //enregistrer le nb dans une variable session pour lutiliser plus tard
    session_start();
    $_SESSION["addressCount"] = $addressCount;

    // redirection vers mon formulaire pour les adresses
    header("Location: address_form.php");
    exit();
}
?>
