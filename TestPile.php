<?php
require_once "Carte.class.php";
require_once "Pile.class.php";
require_once "Manche.class.php";



//$maPile = new Pile(False);
/*var_dump($maPile);

echo $maPile->showLast();
echo "\n";

echo $maPile->getSliceCard(0,0)."\n\n";
echo $maPile->getSliceCard(0,1)."\n\n";
echo $maPile->getSliceCard(0,2)."\n\n";
echo $maPile->getSliceCard(0,3)."\n\n";


$asPique = new Carte("As","Pique",1);
echo $asPique;
*/

$maPile = new Pile(False);
var_dump($maPile);
//echo $maPile->getCard(0)->getSlice(1);

$search_array = array(1,4);
if (array_key_exists(2, $search_array)) {
    echo "L'élément 'premier' existe dans le tableau";
}


/*
$AsPique = new Carte("As","Pique",1);
$DeuxPique = new Carte("2","Pique",2);
$RoiPique = new Carte("Roi","Pique",13);
$ReineCoeur = new Carte("Dame","Coeur",12);

$maPile->addCard($AsPique);
$maPile->addCard($DeuxPique);
$maPile->addCard($RoiPique);
$maPile->addCard($ReineCoeur);

var_dump($maPile);
*/
/*
echo $maPile->getCard(0)->getSlice(0)."\n\n";
echo $maPile->getCard(0)->getSlice(1)."\n\n";
echo $maPile->getCard(0)->getSlice(2)."\n\n";
echo $maPile->getCard(0)->getSlice(3)."\n\n";

echo"-------------------\n";
echo $maPile->getCard(0)->getValeur();

echo"-------------------\n";
echo $AsPique."\n";
*/

echo $maPile->getSliceCardCache(0,0,2)."\n\n";
echo $maPile->getSliceCardCache(0,1,2)."\n\n";
echo $maPile->getSliceCardCache(0,2,2)."\n\n";
echo $maPile->getSliceCardCache(0,3,2)."\n\n";