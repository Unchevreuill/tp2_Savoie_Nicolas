<?php
session_start();

// Vérifier si le nombre d'adresses est défini dans la session
if (!isset($_SESSION["addressCount"])) {
    // Rediriger vers la page d'accueil si le nombre d'adresses n'est pas défini
    header("Location: index.php");
    exit();
}

// Récupérer le nombre d'adresses depuis la session
$addressCount = $_SESSION["addressCount"];

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
        <form action="process.php" method="post">
            <?php
            // Afficher les champs d'adresse en fonction du nombre d'adresses
            for ($i = 0; $i < $addressCount; $i++) {
                $street = isset($_SESSION["street"][$i]) ? $_SESSION["street"][$i] : '';
                $street_nb = isset($_SESSION["street_nb"][$i]) ? $_SESSION["street_nb"][$i] : '';
                $type = isset($_SESSION["type"][$i]) ? $_SESSION["type"][$i] : '';
                $city = isset($_SESSION["city"][$i]) ? $_SESSION["city"][$i] : '';

                echo "<h3>Adresse ", $i + 1, "</h3>";
                echo "<label for='street$i'>Street:</label>";
                echo "<input type='text' id='street$i' name='street[]' maxlength='50' value='$street' required>";

                echo "<label for='street_nb$i'>Street Number:</label>";
                echo "<input type='number' id='street_nb$i' name='street_nb[]' value='$street_nb' required>";

                echo "<label for='type$i'>Type:</label>";
                echo "<select id='type$i' name='type[]' required>";
                echo "<option value='livraison' " . ($type === 'livraison' ? 'selected' : '') . ">Livraison</option>";
                echo "<option value='facturation' " . ($type === 'facturation' ? 'selected' : '') . ">Facturation</option>";
                echo "<option value='autre' " . ($type === 'autre' ? 'selected' : '') . ">Autre</option>";
                echo "</select>";

                echo "<label for='city$i'>City:</label>";
                echo "<input type='text' id='city$i' name='city[]' value='$city' required>";
            }
            ?>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>
