<?php
//ctrl saisies form avant import bdd
function ctrlSaisies($saisie){

    // Convertion caractères spéciaux en entités HTML => peu performant
    // Compléter par htmlentities()
    $saisie = htmlspecialchars($saisie);
    // Suppression des espaces (ou d'autres caractères) en début et fin de chaîne
    $saisie = trim($saisie);
    // Suppression des antislashs d'une chaîne
    $saisie = stripslashes($saisie);
    // Conversion des caractères spéciaux en entités HTML
    $saisie = htmlentities($saisie);
    return $saisie;
}