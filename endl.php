<?php
// Récupérer le mot depuis l'URL
$motfin = isset($_GET['mot']) ? $_GET['mot'] : '';
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cultu'Race</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <section>
        <div class="background-start d-flex flex-justify-content-center flex-align-items-center flex-column ">

            <img class="logo dp mbot-60" src="images/logo.png" alt="">

            <div class="d-flex flex-justify-content-center flex-align-items-center flex-column mtop-20 mbot-40">
            <p class="lose">YOU Lose !</p>
            <p class="objectif">Le mot était : <?php echo $motfin; ?> </p>
            </div>

            <!-- fil d'ariane -->

            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><span aria-current="page"></span></li>
                </ul>
              </nav>

            <button class="btn"> <a href="index.php"> Restart <a></a></button>

        </div>
        </section>
    </body>
</html>
