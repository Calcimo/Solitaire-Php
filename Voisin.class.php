<?php
require_once "Carte.class.php";

class Voisin{
    private $diff; //String

    public function __construct(String $diff = "Facile"){
        $this->diff = $diff;
    }

    public function getdiff(){
        return $this->diff;
    }
    public function isVoisin($C1, $C2):bool{
        $retour = False;
	if ($C1 == NULL or $C2 == NULL){
		$yaR = "rien ici";
	}
	else{
		if ($C1->getOrdre() == 14 or $C2->getOrdre() == 14) {
			$retour = True;
	    	}

        	elseif ($C1->getOrdre() == 1){
				if($this->getdiff()=="Facile"){
					if ($C2->getOrdre() == 13 or $C2->getOrdre() ==2){
                		$retour = True;
					}
				}
				else{
            		if ($C2->getOrdre() ==2){
                		$retour = True;
					}
				}
			}	

        	elseif ($C1->getOrdre() == 13){
            		//echo "on a capté";
            		if ($this->getdiff() == "Facile"){
                		//echo "tqt facile";
                		if ($C2->getOrdre() == 12 or $C2->getOrdre() ==1){
                    			$retour = True;
                		}
            		}
            		else{
                		if ($C2->getOrdre() == 12){
                    			$retour = True;
                		}
            		}
        	}

        	elseif ($C1->getOrdre() == $C2->getOrdre()+1 or $C1->getOrdre() == $C2->getOrdre()-1){
            		$retour = True;
        	}
	}
        return $retour;
    }
}
