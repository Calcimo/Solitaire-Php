<?php
require_once "Carte.class.php";
require_once "Pile.class.php";
require_once "Voisin.class.php";

function decodeBooleen(bool $valCodee):string{
    if ($valCodee == TRUE) {
        $sortie = "Vrai"."\n";
    }
    else{
        $sortie = "Faux"."\n";
    }
    
    return $sortie;
}

$asPique = new Carte("As","Pique",1);
$deuxCoeur = new Carte("2","Coeur",2);
$roiTrefle = new Carte("13","Trefle",13);

$faci = new Voisin("Facile");

echo $faci->getDiff()."\n";

echo "Tests avec facile\n\n";
echo decodeBooleen($faci->isVoisin($asPique,$deuxCoeur));
echo decodeBooleen($faci->isVoisin($deuxCoeur,$asPique));
echo decodeBooleen($faci->isVoisin($roiTrefle,$asPique));
echo decodeBooleen($faci->isVoisin($asPique,$roiTrefle));
echo "Faux -> ".decodeBooleen($faci->isVoisin($deuxCoeur,$roiTrefle));
echo "Faux -> ".decodeBooleen($faci->isVoisin($roiTrefle,$deuxCoeur));
echo decodeBooleen($faci->isVoisin($asPique,$asPique));

$moy = new Voisin("Moyen");

echo "\n\nTests avec moyen\n\n";
echo decodeBooleen($moy->isVoisin($asPique,$deuxCoeur));
echo decodeBooleen($moy->isVoisin($deuxCoeur,$asPique));
echo decodeBooleen($moy->isVoisin($roiTrefle,$asPique));
echo decodeBooleen($moy->isVoisin($asPique,$roiTrefle));
echo "Faux -> ".decodeBooleen($moy->isVoisin($deuxCoeur,$roiTrefle));
echo "Faux -> ".decodeBooleen($moy->isVoisin($roiTrefle,$deuxCoeur));
echo decodeBooleen($moy->isVoisin($asPique,$asPique));
