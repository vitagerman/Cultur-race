<?php
// Connexion à la base de données
include 'functions/query/connect.php'; // Assurez-vous que le chemin est correct
require_once 'config.php'; // Charger la configuration
sql_connect(); // Appeler la fonction de connexion

// Vérifier si le mot a été envoyé par la requête AJAX
if (isset($_POST['mot'])) {
    $mot = $_POST['mot'];

    // Préparer la requête SQL pour récupérer l'article correspondant au mot
    $stmt = $DB->prepare("SELECT * FROM Article WHERE mot = :mot"); // Utiliser :mot pour éviter l'injection SQL
    $stmt->execute(['mot' => $mot]);

    // Récupérer l'article
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        // Créer le HTML à renvoyer
        echo '<h2>' . htmlspecialchars($article['mot']) . '</h2>';
        echo '<p>' . htmlspecialchars($article['paragraphe1']) . '</p>';
        echo '<p>' . htmlspecialchars($article['paragraphe2']) . '</p>';
        echo '<p>' . htmlspecialchars($article['paragraphe3']) . '</p>';
        echo '<p>' . htmlspecialchars($article['paragraphe4']) . '</p>';
        echo '<p>' . htmlspecialchars($article['paragraphe5']) . '</p>';
        echo '<p>' . htmlspecialchars($article['paragraphe6']) . '</p>';

        if ($article['picture']) {
            echo '<img src="' . htmlspecialchars($article['picture']) . '" alt="Image de l\'article">';
        }
    } else {
        echo 'Aucun article trouvé.';
    }
}
?>
