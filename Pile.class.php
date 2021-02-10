<?php
require_once "Carte.class.php";

class Pile
{
	private $pack; // array

	/**
	* Constructeur de la classe Pile.
	* Constructeur permettant de charger un jeu de cartes vide ou de 56 cartes.
	* en parametre true pour avoir la pile vide, false pour avoir 56 cartes
	* @param $vide
	*/

	public function __construct (bool $vide = true)
    {
	if ($vide == true){
		$this->pack = array();
	}
	else {
        	$this->pack = array();
			$valeur = array(2, 3, 4, 5, 6, 7, 8, 9, 10, "Valet", "Dame", "Roi", "As");
			$couleur = array("Carreau", "Coeur", "Pique", "Trefle");
			$ordre = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 1);
			for ($i=0; $i<count($couleur); $i++){
				for ($j=0; $j<count($valeur); $j++){
					$carte = new Carte((string)$valeur[$j], (string)$couleur[$i], (int)$ordre[$j]);
					$this->pack[] = $carte;
			}
		}
		for ($k=0; $k<4; $k++){
			$this->pack[] = new carte((string)"Joker", "", 14);
		}
	}
    }

    /**
    * renvoie le nombre de carte contenue dans le paquet sous forme d'un int
    * @return nombre de carte dans le paquet
    */

    public function getCardsNumber(): int
    {
    	return sizeof($this->pack);

    }

    /**
    * renvoie la carte d'index mis en parametre sous forme d'une carte
    * @param $indice
    * @return carte d'index $indice
    */

    public function getCard(int $indice)
    {
		if (array_key_exists($indice, $this->pack)){
			$retour = $this->pack[$indice];
		}
		else{
			$retour = NULL;
		}
    	return $retour;
    }

    /**
    * ajoute la carte mis en parametre au packet
    * @param $carte
    */

    public function addCard(Carte $carte): void
    {
    	$this->pack[] = new Carte($carte->getValeur(),$carte->getCouleur(),$carte->getOrdre());
    }

    /**
    * retire la premiere carte du paquet
    * @return premiere carte du paquet
    */

    public function popCard(): Carte
    {
    	if (count($this->pack) == 0)
    	throw new OutOfRangeException ("popCard - paquet vide");
    	$res = array_splice($this->pack, count($this->pack)-1, 1);
    	return $res[0];
    }

    /**
    * renvoie la dernière carte du paquet
    * @return dernière carte du paquet
    */

    public function showLast()
    {	
		$retour = NULL;
		if (count($this->pack)>0){
			$retour = $this->pack[count($this->pack)-1];
		}
    	return $retour;
	}

	/*public function showLast()
    {	
    	return $this->pack[count($this->pack)-1];
    }*/

    /**
    * retire une carte aleatoire du paquet
    * @return la carte aleatoire retiree du paquet
    */
	
    public function drawCard(): Carte
    {
    	if (count($this->pack) == 0)
    	throw new OutOfRangeException ("drawcard- paquet vide");
	    $ind = array_rand($this->pack);
	    $res = clone $this->pack[$ind];
	    array_splice($this->pack, $ind, 1);
	    return $res;
	}

	/**
    * ajoute un tas passé en parametre à un autre tas
    * @param $pileaadd
    */

    public function addPile(Pile $pileaadd):void
    {
	    array_push($this->pack, $pileaadd);
	}

    /**
	* Affiche l'objet de la classe Pile.
	*/

	public function __toString() : String
	{
		$res = "";
	    for ($i=0; $i<count($this->pack); $i++) {
	    	$res = $res.$this->pack[$i]."\n";
	    }
	    return $res;
	}

	public function getSliceCard(int $numCarte = 0, int $coucheCarte = 0):String{
		$carte = $this->getCard($numCarte);
		if ($carte != NULL){
			$retour = $carte->getSlice($coucheCarte);
		}
		else {
			$retour = "    ";
		}
		return $retour;
	}

	public function getSliceCardCache(int $numCarte = 0, int $coucheCarte = 0, int $skin = 0):String{
		$carte = $this->getCard($numCarte);
		if ($carte != NULL){
			$retour = $carte->getSliceCache($coucheCarte,$skin);
		}
		else {
			$retour = "    ";
		}
		return $retour;
	}
}

