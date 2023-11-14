<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom1_tp2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>
