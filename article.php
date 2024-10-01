<?php
require_once 'config.php'; // Charger la configuration
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

// Fonction pour récupérer les informations de l'article depuis la base de données
function getArticleByMot($mot)
{
    global $db;
    $result = sql_select('Article', '*', "mot = '" . trim($mot) . "'");
    return $result;
}

function getDefByMot($motfin)
{
    global $db;
    $result = sql_select('Article', 'def', "mot = '" . trim($motfin) . "'");
    // Retourne la première définition trouvée, ou une chaîne vide si aucune définition n'est trouvée
    return $result ? $result[0]['def'] : '';
}

$mot = isset($_GET['mot']) ? $_GET['mot'] : '';
$motFin = 'paradoxe du grand-père';

// Vérifiez si le formulaire a été soumis

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si le mot est égal à motFin
    if ($mot === $motFin) {
        header('Location: end.php?mot=' . urlencode($motFin));
        exit; // Redirige vers end.php si les mots correspondent
    } else {
        header('Location: endl.php?mot=' . urlencode($motFin));
        exit; // Redirige vers endl.php si les mots ne correspondent pas
    }
    exit; // Terminez le script après la redirection pour éviter tout traitement supplémentaire
}




// Vérifiez si le mot est "paradoxe du grand-père" et si le bouton est vrai


// Fonction pour rendre certains mots dans les paragraphes cliquables
// Fonction pour rendre certains mots dans les paragraphes cliquables
function rendreMotsCliquables($texte, $motsClicables)
{
    foreach ($motsClicables as $mot) {
        // Échappe le mot pour éviter les problèmes d'injection HTML
        $motEscaped = htmlspecialchars($mot);
        // Crée le lien avec un paramètre GET
        $url = 'article.php?mot=' . urlencode($motEscaped);
        // Utiliser une expression régulière pour remplacer le mot avec une balise <a>
        $pattern = '/\b' . preg_quote($motEscaped, '/') . '\b(?!.*\b' . preg_quote($motEscaped, '/') . '\b)/';
        $texte = preg_replace($pattern, '<a href="' . $url . '" class="clickable-word" data-word="' . htmlspecialchars($mot) . '">' . $motEscaped . '</a>', $texte);
    }
    return $texte;
}


// Liste de mots cliquables
$motsClicables = [
    'Disney+',
    'disney+',
    'Cinema',
    'cinema',
    'karma',
    'Karma',
    'Inde',
    'inde',
    'tuktuk',
    'Tuktuk',
    'tuk-tuks',
    'voiture',
    'Voiture',
    'fordisme',
    'Fordisme',
    'toyotisme',
    'Toyotisme',
    'japon',
    'Japon',
    'pays',
    'Pays',
    'yakuza',
    'Yakuza',
    'sakazuki',
    'Sakazuki',
    'Égypte ',
    'egypte',
    'l’Égypte',
    'Egypte',
    'maât',
    'Maât',
    'paradoxe du grand-père',
    'Paradoxe du grand-père',
    'voyage',
    'Voyage',
    'Khonsou',
    'Khonsou',
    'divinité égyptienne',
    'divinités égyptiennes'

];

// Récupérer le mot depuis l'URL (paramètre GET)

// Si un mot est fourni, récupérer l'article correspondant
if ($mot) {
    $article = getArticleByMot($mot);
    if ($article) {

        // Rendre certains mots cliquables dans les paragraphes
        $article[0]['paragraphe1'] = rendreMotsCliquables($article[0]['paragraphe1'], $motsClicables);
        $article[0]['paragraphe2'] = rendreMotsCliquables($article[0]['paragraphe2'], $motsClicables);
        $article[0]['paragraphe3'] = rendreMotsCliquables($article[0]['paragraphe3'], $motsClicables);
        $article[0]['paragraphe4'] = rendreMotsCliquables($article[0]['paragraphe4'], $motsClicables);
        $article[0]['paragraphe5'] = rendreMotsCliquables($article[0]['paragraphe5'], $motsClicables);
        $article[0]['paragraphe6'] = rendreMotsCliquables($article[0]['paragraphe6'], $motsClicables);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article: <?php echo htmlspecialchars($mot); ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <nav class="d-flex flex-justify-content-between">
            <div>
                <img class="logo-header mleft-20" src="images/logo.png" alt="logo Cultu'Race" />
            </div>
            <div class="d-flex flex-align-items-center target">
                MOT CIBLÉ : <span class="definition" ><?php echo htmlspecialchars(getDefByMot($motFin)); ?></span> 
            </div>
            <div class="d-flex flex-align-items-center mright-20">
                <form method="POST">
                    <button class="btn-check" type="submit" name="bouton" value="true">Valider</button>
                </form>
            </div>
        </nav>
    </header>
    <main class="container" style="margin-top: 100px">
        <?php if ($article): ?>
            <h1 id="article-title"><?php echo htmlspecialchars($article[0]['mot']); ?></h1>
            <article class="content">
            <?php if (!empty($article[0]['picture'])): ?>
                    <img id="article-image" src="<?php echo htmlspecialchars($article[0]['picture']); ?>" alt="Image de l'article">
                <?php else: ?>
                    <p>Aucune image disponible</p>
                <?php endif; ?>
                <p id="paragraph1"><?php echo !empty($article[0]['paragraphe1']) ? $article[0]['paragraphe1'] : ''; ?></p>
                <br />
                <p id="paragraph2"><?php echo !empty($article[0]['paragraphe2']) ? $article[0]['paragraphe2'] : ''; ?></p>
                <br />
                <p id="paragraph3"><?php echo !empty($article[0]['paragraphe3']) ? $article[0]['paragraphe3'] : ''; ?></p>
                <br />
                <p id="paragraph4"><?php echo !empty($article[0]['paragraphe4']) ? $article[0]['paragraphe4'] : ''; ?></p>
                <br />
                <p id="paragraph5"><?php echo !empty($article[0]['paragraphe5']) ? $article[0]['paragraphe5'] : ''; ?></p>
                <br />
                <p id="paragraph6"><?php echo !empty($article[0]['paragraphe6']) ? $article[0]['paragraphe6'] : ''; ?></p>
            </article>
        <?php else: ?>
            <p>Aucun article trouvé pour le mot '<?php echo htmlspecialchars($mot); ?>'.</p>
        <?php endif; ?>
    </main>
</body>

</html>