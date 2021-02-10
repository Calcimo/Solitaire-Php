<?php
require_once "Carte.class.php";
require_once "Pile.class.php";
require_once "Manche.class.php";

//$rep = readline("Voici ma question ... : ");
//echo $rep;
$manche = new Manche();
//echo $manche;
/*
for ($i = 0; $i < 10; $i++){

    $manche->jouerTour();
}
*/

//$manche->jouerManche();

$diff = new Manche("Difficile",$skin = 2);
// VOUS POUVEZ MODIFIER LA DIFFICULTE ENTRE 'Facile', 'Moyen' et 'Difficile'
// VOUS POUVEZ EGALEMENT CHANGER LE SKIN 0, 1, 2 ou 3 (le plus stylé c'est le 2)

//echo $diff;
//echo $diff->getDifficulte();
$diff->jouerManche();

//$diff->jouerPartie();
$diff ->jouerManche();