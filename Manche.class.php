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

class Manche{

	private $timeDeb; //int
	private $score; //array
	private $table; //array de Pile
	private $talon; //Pile
	private $defausse; //Pile
	private $pourretour; //array
	private $difficulte; //String
	private $skin; //int
	private $cumul; //int
	private $cumoin; //int
	private $commenceTime; //string
	private $pasBT; //bool

	/**
	* Constructeur de la classe Manche.
	* Constructeur permettant de charger un jeu de cartes
	*/

	public function __construct (String $diff ="Facile", int $skin = 2)
	{
		$JeuDeCartes = new Pile(false);

		//Table
		$this->table = array();
		for ($i=0; $i<7; $i++){
			$UnePile = new Pile();
			for ($j=0; $j<5; $j++){
				$carteAlea = $JeuDeCartes->drawCard();
				//echo "----------------------\n";
				//var_dump($carteAlea);
				$UnePile->addCard($carteAlea);
			}
			//var_dump($UnePile);
			array_push($this->table, clone $UnePile);
		}

		//Talon
		
		$this->talon = new Pile();
		for ($i=0; $i<20; $i++){
			$this->talon->addCard($JeuDeCartes->drawCard());
		}

		//Defausse
		$this->defausse = new Pile();
		$this->defausse->addCard($JeuDeCartes->drawCard());

		$this->timeDeb = time();
		$this->score = array(0);
		$this->pourretour = [];
		$this->difficulte = $diff;
		$this->skin = $skin;
		$this->cumul = 20;
		$this->cumoin = -50;
		$this->commenceTime = date("d/m/Y -- H:i");
		$this->pasBT = false;

	}

	public function getScore():array{
		return $this->score;
	}

	public function getCommenceTime(){
		return $this->commenceTime;
	}

	public function getTable():array{
		return $this->table;
	}

	public function getTalon():Pile{
		return $this->talon;
	}

	public function getDefausse():Pile{
		return $this->defausse;
	}

	public function getDifficulte():String{
		return $this->difficulte;
	}
	/**
	 * Retourne la Pile de la table avec le numéro de la pile mis en paramètre.
	 */
	public function getNthPileTable(int $numeroPile=0):Pile{
		return $this->getTable()[$numeroPile];
	}

	public function saisir():String{
		return readline("Quelle action voulez vous faire ? (tapez 'help' pour voir les possibilités) ");
	}

	public function jouerTable(int $colonne):void{
		$vois = new Voisin($this->getDifficulte());
		if ($vois->isVoisin($this->getDefausse()->showLast(),$this->getNthPileTable($colonne-1)->showLast())){
			$this->getDefausse()->addCard($this->getNthPileTable($colonne-1)->popCard());
			array_push($this->pourretour, [2,$colonne-1]);
			$this->cumoin = -50;
			$this->score[0] += $this->cumul;
			$this->cumul += 20;
		}
		else{
			echo "Vous ne pouvez pas faire ça, la carte n'est pas sa voisine \n";
		}
	}

	public function afficherPossibilités():String{
		return "\nVous pouvez choisir la colonne de carte (entre 1 et 7), piocher une carte en tapant 'p' ou faire un undo en tapant 'u'. \n";
	}

	public function piocherCarte():void{
		$this->getDefausse()->addCard($this->getTalon()->popCard());
		array_push($this->pourretour, [1,0]);
		$this->cumul = 20;
	}

	public function faireretour():string{
		$res = "";
		if ($this->pourretour == []){
			$res = "\nImpossible d'executer un undo\n";
		}
		elseif ($this->pourretour[count($this->pourretour)-1][0] == 1){
			$this->getTalon()->addCard($this->getDefausse()->popCard());
			array_splice($this->pourretour, count($this->pourretour)-1, 1);
			$this->cumul = 20;
			$this->score[0] += $this->cumoin;
			$this->cumoin -= 25;
		}
		elseif ($this->pourretour[count($this->pourretour)-1][0] == 2){
			$this->getNthPileTable($this->pourretour[count($this->pourretour)-1][1])->addCard($this->getDefausse()->popCard());
			array_splice($this->pourretour, count($this->pourretour)-1, 1);
			$this->cumul = 20;
			$this->score[0] += $this->cumoin;
			$this->cumoin -= 25;
		}
		return $res;
	}

	public function jouerTour():void{
		$choix = $this->saisir();

		if ($choix == "p" and $this->getTalon()->getCardsNumber() > 0){
			$this->piocherCarte();
			echo $this;
		}
		elseif($choix > 0 and $choix < 8){
			$this->jouerTable($choix);
			echo $this;
		}
		elseif ($choix == "help"){
			echo $this->afficherPossibilités();
		}
		elseif ($choix == "u"){
			echo $this->faireretour();
			echo $this;
		}
		else{
			echo "\nCommande invalide \n";
		}

	}

	public function jouerManche():void{
		$verif = true;
		while ($verif == true){
			
			//Verif des piles de la table
			$pilevidee = 0;
			for ($i = 0; $i <7; $i++){
				if ($this->getNthPileTable($i)->getCardsNumber() == 0){
					$pilevidee += 1;
				}
				if ($pilevidee == 7){
					$verif = False;
				}
			}
			//Verif du Talon
			if ($this->getTalon()->getCardsNumber() == 0){
				$petiteVerif = False;
				for ($i=0;$i < 7; $i++){
					$voisi = new Voisin($this->getDifficulte());
					//echo"on rentre dans la boucle \n";
					if ($voisi->isVoisin($this->getDefausse()->showLast(),$this->getNthPileTable($i)->showLast())){
						$petiteVerif = True;
						//echo "ça ne s'arrête pas pour ".$i."\n";
					}
				}
				//echo "petite verif vaut ".decodeBooleen($petiteVerif)."\n";
				if ($petiteVerif == False){
					$verif = False;
					$this->pasBT = True;
				}
			}

			if ($verif == False){
				if ($this->score[0] < 0){
					$this->score[0] = 0;
				}
				$scoretalonrest = $this->talon->getCardsNumber()*100;
				array_push($this->score, $scoretalonrest);
				if ($this->pasBT == false){
					$bonustime = time() - $this->timeDeb;
					$bonustime = 400 - $bonustime;
					if ($bonustime < 0){
						$bonustime = 0;
					}
				}
				else{
					$bonustime = 0;
				}
				array_push($this->score, $bonustime);
				array_push($this->score, $this->score[0]+$this->score[1]+$this->score[2]);
				echo "Partie terminée \n";
				echo "Votre score ".$this->score[3]."\n";
			}
			else{
				$this->jouerTour();

			}
		}
	}
	/*
	public function reactionSaisir(String $saisie):void{
		if ($saisie == "help"){
			echo "Vous pouvez tirer une carte du talon en insérant 't' \n"
		}
		else if 
	}
	*/

	public function __toString():String{
		$res = "";
		if ($this->getDifficulte()=="Facile" or $this->getDifficulte()=="Normal"){
			for ($k=0; $k<5; $k++){
				for ($i=0; $i<4; $i++){
					for ($j=0; $j<7; $j++){
						$res = $res." ".$this->getNthPileTable($j)->getSliceCard($k, $i);
					}
					$res = $res."\n";
				}
				$res = $res."\n";
			}
		}
		elseif ($this->getDifficulte()=="Difficile"){
			for ($k=0; $k<5; $k++){
				for ($i=0; $i<4; $i++){
					for ($j=0; $j<7; $j++){
						if ($k == $this->getNthPileTable($j)->getCardsNumber()-1){
							
							$res = $res." ".$this->getNthPileTable($j)->getSliceCard($k, $i);
						}
						else{
							$res = $res." ".$this->getNthPileTable($j)->getSliceCardCache($k, $i, $this->skin);
						}
					}
					$res = $res."\n";
				}
				$res = $res."\n";
			}
		}

		$res .= "  1    2    3    4    5    6    7\n\n";
		$res .= $this->getDefausse()->showLast()."\n\n";
		$res .= "Il reste ".$this->getTalon()->getCardsNumber()." cartes dans le talon.\n";
		return $res;
	}


	/*
	public function __toString():String{
		$res = "";
		for ($i = 0;$i<4;$i++){
			for ($j = 0; $j<7; $j++){
				$res = $res . $this->getNthPileTable($j)->getSliceCard(0,$i) . " ";
			}
			$res = $res . "\n";
		}
		return $res;
	}
	*/
}
