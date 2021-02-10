<?php
require_once "Carte.class.php";
require_once "Pile.class.php";

function decodeBooleen(bool $valCodee):string{
    if ($valCodee == TRUE) {
        $sortie = "Vrai"."\n";
    }
    else{
        $sortie = "Faux"."\n";
    }
    
    return $sortie;
}


$AsPique = new Carte("As","Pique",1);
var_dump($AsPique);
$DeuxPique = new Carte("2","Pique",2);
var_dump($DeuxPique);
$RoiPique = new Carte("Roi","Pique",13);
echo $RoiPique."\n";
$ReineCoeur = new Carte("Dame","Coeur",12);
echo $ReineCoeur."\n";

echo decodeBooleen($DeuxPique->isVoisin($AsPique));
echo decodeBooleen($AsPique->isVoisin($DeuxPique));
echo decodeBooleen($RoiPique->isVoisin($DeuxPique));
echo decodeBooleen($DeuxPique->isVoisin($RoiPique));
echo decodeBooleen($AsPique->isVoisin($RoiPique));
echo decodeBooleen($RoiPique->isVoisin($AsPique));
/*
$jeuDeCarte = new Pile();
echo $jeuDeCarte;
*/
echo $DeuxPique;

echo $AsPique->getSlice(0)."\n";
echo $AsPique->getSlice(1)."\n";
echo $AsPique->getSlice(2)."\n";
echo $AsPique->getSlice(3)."\n";

echo "\n\n\n";

var_dump($AsPique);

$maListe = array();
$maListe[] = $AsPique;
$maListe[] = $DeuxPique;
$maListe[] = $RoiPique;
$maListe[] = $ReineCoeur;

$maGrosseListe = array();
$maGrosseListe[] = $maListe;

var_dump($maListe);
var_dump($maGrosseListe);

//echo $maGrosseListe[0];

echo $AsPique->getSliceCache(0)."\n";
echo $AsPique->getSliceCache(1)."\n";
echo $AsPique->getSliceCache(2)."\n";
echo $AsPique->getSliceCache(3)."\n";
echo "\n";
echo $AsPique->getSliceCache(0,1)."\n";
echo $AsPique->getSliceCache(1,1)."\n";
echo $AsPique->getSliceCache(2,1)."\n";
echo $AsPique->getSliceCache(3,1)."\n";
echo "\n";
echo $AsPique->getSliceCache(0,2)."\n";
echo $AsPique->getSliceCache(1,2)."\n";
echo $AsPique->getSliceCache(2,2)."\n";
echo $AsPique->getSliceCache(3,2)."\n";
echo "\n";
echo $AsPique->getSliceCache(0,3)."\n";
echo $AsPique->getSliceCache(1,3)."\n";
echo $AsPique->getSliceCache(2,3)."\n";
echo $AsPique->getSliceCache(3,3)."\n";




