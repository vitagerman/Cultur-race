<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = htmlspecialchars($_POST['pseudo']); // sécurisation de la saisie utilisateur
    echo "Bienvenue, " . $pseudo . " !";  // Affiche le pseudo saisi
}
?>
