<?php
require_once "Carte.class.php";
require_once "Pile.class.php";
require_once "Voisin.class.php";
require_once "Manche.class.php";

$diff = "";
while ($diff != "Facile" and $diff != "Normal" and $diff != "Difficile"){
	$diff = readline("Veuillez choisir votre difficulté (Facile, Normal ou Difficile) : ");
	$diff = ucfirst(strtolower($diff));
}
$skin = 2;
if ($diff == "Difficile"){
    $skin = readline("Veuillez choisir votre apparence de dos de carte (0, 1, 2 ou 3) : ");
}
$nb = 0;
while ($nb <= 0){
	$nb = readline("Combien de manches voulez-vous jouer ? :");
}
$scoretot = 0;
$fichiersauv = fopen('score.txt', 'a');

for ($i = 0; $i < $nb; $i++){
    $manche = new Manche($diff,$skin);
    echo $manche;
    $manche->jouerManche();
	$comtime = $manche->getCommenceTime();
	$lescor = $manche->getScore();
	fputs($fichiersauv, "Votre bonus de cartes restantes : $lescor[1] points\n");
	fputs($fichiersauv, "Votre bonus de temps : $lescor[2] points\n");
	fputs($fichiersauv, "Votre score du $comtime : $lescor[3] points\n");
	$scoretot += $lescor[3];
}
	fputs($fichiersauv, "\n");
	fputs($fichiersauv, "Le score total de vos manches est de $scoretot points.\n");
	fputs($fichiersauv, "\n");
	fputs($fichiersauv, "\n");
fclose($fichiersauv);
