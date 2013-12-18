<?php

class Commande extends Entity {
	
	private $_id;
	private $_datecommande;
	private $_montantHT;
	
	protected $_leslignes;		//Collection de LignePanier
	
	
	public function Commande(array $params=null){
		
		$this->lierDB("Commande","commande");
		
		if(isset($params)){
			$this->_id=$params[0];
			$this->_datecommande=$params[1];
			$this->_montantHT=$params[2];				
		}
		else{
			$this->_leslignes=new Collection();
		}
	}
	
	public function getLeslignes(){
		return $this->_leslignes;
	}
	
	/**
	 * Fonction permettant l'ajout d'un produit au panier
	 * Verifier si le produit est d�ja pr�sent dans le panier.
	 * 		S'il ne l'est pas :  On ajoute le produit
	 * 		S'il l'est : On augmente la quantit� de ce produit
	 * 
	 * @param Produit $leprod
	 */
	public function Add($leprod){
		
		$laligne=$this->ExisteProduit($leprod);
		
		if( ! $laligne){
		
			$maligne=new lignepanier($leprod);
			$this->_leslignes->add($maligne);
		
		}
		else{
			$laligne->AddUnite();
		}
		
		
	}
	
	/**
	 * 
	 * @param Produit $unproduit
	 * @return Ambigous <multitype:, LignePanier>|boolean
	 * 
	 * Verifie si le produit est pr�sent dans la collection de LignePanier.
	 * S'il est pr�sent: retourne la ligne concern�e.
	 * S'il ne l'est pas: retourne faux.
	 * 
	 * Cela explique le fait que la fonction retourne un type Ambigue (Ligne Panier ou un Bool�en)
	 */
	protected function ExisteProduit(Produit $unproduit){
		
		foreach ($this->_leslignes->getAll() as $uneligne){
			if($uneligne->getProduit()->CompareTo($unproduit)){
				return $uneligne;
			}
		}
		
		return false;
		
	}

	/*
	 * Retourne le nombre de produit diff�rent dans le panier (sans prendre en compte les quantit�s)
	 */	
	public function getNbProduitDifferent(){
		return $this->_leslignes->Cardinal();
	}
	
	/*
	 * Retourne le montant total du panier hors taxes. 
	*/
	public function getTotalHT(){
		$HT=0;
		foreach ($this->_leslignes->getAll() as $uneligne){
			$HT+=$uneligne->getTotal();
		}
		return $HT;
	}
		
	


	public function get_id()
	{
	    return $this->_id;
	}

	public function set_id($_id)
	{
	    $this->_id = $_id;
	}

	public function get_datecommande()
	{
	    return $this->_datecommande;
	}

	public function set_datecommande($_datecommande)
	{
	    $this->_datecommande = $_datecommande;
	}

	public function get_montantHT()
	{
	    return $this->_montantHT;
	}

	public function set_montantHT($_montantHT)
	{
	    $this->_montantHT = $_montantHT;
	}
}

?>