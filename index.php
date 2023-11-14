<?php
session_start();

// Inclure le fichier de configuration de la base de données
include_once("db_config.php");

// Initialiser le nombre d'adresses à 0 par défaut
$addressCount = 0;

// Vérifier si le formulaire initial est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nombre d'adresses saisi par l'utilisateur
    $addressCount = isset($_POST["addressCount"]) ? (int)$_POST["addressCount"] : 0;

    // Valider que le nombre d'adresses est un entier positif
    if ($addressCount <= 0 || !is_int($addressCount)) {
        $error = "Veuillez saisir un nombre d'adresses valide.";
    } else {
        // Stocker le nombre d'adresses dans la session
        $_SESSION["addressCount"] = $addressCount;

        // Rediriger vers le formulaire d'adresse
        header("Location: address_form.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Formulaire d'adresse</title>
</head>
<body>
    <div class="container">
        <h2>Formulaire d'adresse</h2>
        
        <?php
        // Afficher des erreurs éventuelles
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        
        <form action="index.php" method="post">
            <label for="addressCount">Nombre d'adresses :</label>
            <input type="number" id="addressCount" name="addressCount" min="1" value="<?php echo $addressCount; ?>" required>
            <button type="submit">Continuer</button>
        </form>
    </div>
</body>
</html>
