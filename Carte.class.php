<?php


class Carte{
    private $couleur; //String
    private $valeur; //String 
    private $ordre; //int


    public function __construct(String $valeur = "", String $couleur = "", int $ordre = 0){
        $this->valeur = $valeur;
        $this->couleur = $couleur;
        $this->ordre = $ordre;
    }

    public function getCouleur():String{
        return $this->couleur;
    }

    public function getValeur():String{
        return $this->valeur;
    }

    public function getOrdre():int{
        return $this->ordre;
    }


    public function getSlice(int $coucheCarte = 0):String{

        $reset = "\e[0m";

        //Valeur
        if ($this->getValeur() == "As"){
            $val = "A";}
        elseif ($this->getValeur() == "Roi"){
            $val = "R";}
        elseif ($this->getValeur() == "Dame"){
            $val = "D";}
        elseif ($this->getValeur() == "Valet"){
            $val = "V";}
        elseif ($this->getValeur() == "Joker"){
            $val =  mb_convert_encoding("\x26\x3C", 'UTF-8', 'UTF-16BE');}
        else{
            $val = $this->getValeur();
        }

        //Couleur binaire
        if ($this->getCouleur()=="Pique" or $this->getCouleur()=="Trefle"){
            $coul = "\e[1m"."\e[7m"."\e[40m";
        }
        elseif ($this->getCouleur()=="Carreau" or $this->getCouleur()=="Coeur"){
            $coul = "\e[1m"."\e[7m"."\e[41m";
        }
        else {
            $coul = "\e[1m"."\e[7m"."\e[42m";
        }

        //Couleur
        if ($this->getCouleur()=="Pique"){
            $signe = mb_convert_encoding("\x26\x60", 'UTF-8', 'UTF-16BE');
        }
        elseif ($this->getCouleur()=="Trefle"){
            $signe = mb_convert_encoding("\x26\x63", 'UTF-8', 'UTF-16BE');
        }
        elseif ($this->getCouleur()=="Coeur"){
            $signe = mb_convert_encoding("\x26\x65", 'UTF-8', 'UTF-16BE');
        }
        elseif ($this->getCouleur()=="Carreau"){
            $signe = mb_convert_encoding("\x26\x66", 'UTF-8', 'UTF-16BE');
        }
        else{
            $signe= mb_convert_encoding("\x26\x3C", 'UTF-8', 'UTF-16BE');
        }

        //Couche
        if ($coucheCarte == 0 or $coucheCarte == 3){
            $res = $coul."    ".$reset;
        }
        
        elseif ($coucheCarte == 1){
            if ($this->getValeur() == "10"){
                $res = $coul." $val"." ".$reset;
            }
            else{
                $res = $coul." $val"."  ".$reset;
            }
        }

        elseif ($coucheCarte == 2){
            $res = $coul."  ".$signe." ".$reset;
        }
        
        return $res;
    }

    public function getSliceCache(int $couche = 0, int $skin = 0){
        $reset = "\e[0m";
        $bleu = "\e[104m";
        $blanc = "\e[7m"."\e[40m";
        $rouge = "\e[101m";
        if ($skin ==0){
            if ($couche == 0 or $couche == 2){
                $res = $bleu." ".$reset.$blanc." ".$reset.$bleu." ".$reset.$blanc." ".$reset;
            }
            else{
                $res = $blanc." ".$reset.$bleu." ".$reset.$blanc." ".$reset.$bleu." ".$reset;
            }
        }

        elseif ($skin == 1){
            if ($couche == 0 or $couche == 2){
                $res = $bleu." ".$reset.$rouge." ".$reset.$bleu." ".$reset.$rouge." ".$reset;
            }
            else{
                $res = $rouge." ".$reset.$bleu." ".$reset.$rouge." ".$reset.$bleu." ".$reset;
            }
        }

        elseif($skin == 2){
            if ($couche == 0 or $couche == 3){
                $res = $bleu." ".$reset.$blanc."  ".$reset.$bleu." ".$reset;
            }
            else{
                $res = $blanc." ".$reset.$bleu."  ".$reset.$blanc." ".$reset;
            } 
        }

        else{
            if ($couche == 0 or $couche == 3){
                $res = $bleu." ".$reset.$rouge."  ".$reset.$bleu." ".$reset;
            }
            else{
                $res = $rouge." ".$reset.$bleu."  ".$reset.$rouge." ".$reset;
            } 
        }

        return $res;

    }

    public function __toString():String{
        $res = "";
        for ($i=0;$i<4;$i++){
            $res = $res . $this->getSlice($i)."\n";
        }
        return $res;
    }

    /*
    public function __toString():String{
        $reset = "\e[0m";

        if ($this->getValeur() == "As"){
            $val = "A";}
        elseif ($this->getValeur() == "Roi"){
            $val = "R";}
        elseif ($this->getValeur() == "Dame"){
            $val = "Q";}
        elseif ($this->getValeur() == "Valet"){
            $val = "V";}
        elseif ($this->getValeur() == "Joker"){
            $val = "J";}
        else{
            $val = $this->getValeur();
        }
        
        if ($this->getCouleur()=="Pique" or $this->getCouleur()=="Trefle"){
            $coul = "\e[1m"."\e[7m"."\e[40m";
        }
        else{
            $coul = "\e[1m"."\e[7m"."\e[41m";
        }

        if ($this->getCouleur()=="Pique"){
            $signe = "P";
        }
        elseif ($this->getCouleur()=="Trefle"){
            $signe = "T";
        }
        elseif ($this->getCouleur()=="Coeur"){
            $signe = "H";
        }
        elseif ($this->getCouleur()=="Carreau"){
            $signe = "C";
        }
        else{
            $signe=" ";
        }
        if ($this->getValeur() == "10"){
            $res = $coul."    ".$reset."\n";
            $res = $res.$coul." $val"." ".$reset."\n";
            $res = $res.$coul."  ".$signe." ".$reset."\n";
            $res = $res.$coul."    ".$reset."\n";
        }
        else{
            $res = $coul."    ".$reset."\n";
            $res = $res.$coul." $val"."  ".$reset."\n";
            $res = $res.$coul."  ".$signe." ".$reset."\n";
            $res = $res.$coul."    ".$reset."\n";
        }
        return $res;
        }
        */
}
