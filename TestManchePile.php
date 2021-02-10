<?php
require_once "Carte.class.php";
require_once "Pile.class.php";
require_once "Manche.class.php";
/*
function decodeBooleen(bool $valCodee):string{
    if ($valCodee == TRUE) {
        $sortie = "Vrai"."\n";
    }
    else{
        $sortie = "Faux"."\n";
    }

    return $sortie;
}
/*
$manche = new Manche();
var_dump($manche->getTalon());
var_dump($manche->getTable());
echo $manche;
echo $manche->getNthPileTable(1)->getCard(3);
echo $manche->getNthPileTable(1)->getSliceCard(7,3);
echo"\n\n\n";
$manche->getNthPileTable(1)->popCard();
echo $manche;
//var_dump($manche);

//var_dump($manche->getTalon());
//var_dump($manche->getTable());
//echo $manche;
/*
var_dump($manche->getNthPileTable());
echo "\n\n\n";
*/
//var_dump($manche->getNthPileTable(1));
//echo $manche->getNthPileTable(1)->getSliceCard(0,0)."\n";
//echo $manche->getNthPileTable(1)->getSliceCard(0,1)."\n";
//echo $manche->getNthPileTable(1)->getSliceCard(0,2)."\n";
//echo $manche->getNthPileTable(1)->getSliceCard(0,3)."\n";

$maListe = array(1);
array_splice($maListe,count($maListe)-1,1);