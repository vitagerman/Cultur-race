<?php
include 'insert_data.php';

$mots = [
    "voyage", "divinités égyptiennes", "divinité égyptienne", "Fordisme", "voiture", 
    "Yakuza", "Japon", "Sakazuki", "Egypte", "Khonsou", "Toyotisme", "Pays", 
    "paradoxe du grand-père", "Maât", "tuk-tuks", "Inde", "Karma"
];

// Sélectionner un mot aléatoire pour le mot de fin
$motFin = $mots[array_rand($mots)];

// Sélectionner un mot de départ différent du mot de fin
do {
    $motdebut = $mots[array_rand($mots)];
} while ($motdebut === $motFin); // Répète jusqu'à ce que les mots soient différents


function getDefByMot($motfin)
{
    global $db;
    $result = sql_select('Article', 'def', "mot = '" . trim($motfin) . "'");
    // Retourne la première définition trouvée, ou une chaîne vide si aucune définition n'est trouvée
    return $result ? $result[0]['def'] : '';
}

$defMotFin = getDefByMot($motFin);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section>
      <div
        class="background-start d-flex flex-justify-content-center flex-align-items-center flex-column"
      >
        <img class="logo dp" src="images/logo.png" alt="" />

        <div class="pseudo-entrer mbot-40 d-flex mtop-60">
          <div
            class="d-flex flex-justify-content-center flex-align-items-center"
          >
            <label class="pseudo">Your name:</label>
          </div>
          <div
            class="d-flex flex-justify-content-center flex-align-items-center"
          >
            <input
              type="text"
              id="pseudo"
              name="pseudo"
              placeholder="Enter your name"
            />
          </div>
        </div>

        <div
          class="d-flex flex-justify-content-center flex-align-items-center flex-column mtop-20 mbot-40"
        >
        <p class="objectif">You start with : <?php echo($motdebut); ?></p>
        </div>
        <div class="d-flex flex-justify-content-center flex-align-items-center goal ">
        <p class="objectif">Your goal : <br> <p class="yourGoalDef"><?php echo($defMotFin); ?></p> </p>
        </div>

        <button class="btn" onclick="showPseudoAndRedirect()">Start</button>

        <script>
            function showPseudoAndRedirect() {
                showPseudo(); // Affiche le pseudo saisi
                var pseudo = document.getElementById("pseudo").value;

                if (pseudo) {
                    // Utilisation de la variable PHP $motdebut dans JavaScript
                    var motdebut = "<?php echo $motdebut; ?>";
                    // Redirige vers article.php avec le mot de début en paramètre
                    window.location.href = "article.php?mot=" + encodeURIComponent(motdebut);
                }
            }
        </script>

        <div id="pseudo-display" class="mtop-20" style="display: none">
          <p>Welcome : <span id="display-name"></span></p>
        </div>
      </div>
    </section>

    <script>
      function showPseudo() {
        var pseudo = document.getElementById("pseudo").value;

        if (pseudo) {
          document.getElementById("display-name").textContent = pseudo;

          document.getElementById("pseudo-display").style.display = "block";
        } else {
          alert("Please enter a pseudo");
        }
      }
    </script>
  </body>
</html>
