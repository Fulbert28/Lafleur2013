<?php

class LignePanier {
	
	private $_prod;	//Objet de la classe Produit
	private $_qte;	//entier
	
	public function LignePanier(Produit $unproduit){
		$this->_prod=$unproduit;
		$this->_qte=1;
	}
	
	public function getProduit(){
		return $this->_prod;
	}
	
	public function getQuantite(){
		return $this->_qte;
	}
	
	/*
	 * Ajoute une unité à la quantit� existante
	 */
	public function AddUnite(){
		$this->_qte++;
	}
	
	public function DelUnite(){
		$this->_qte--;
	}
	
	public function getTotal(){
		return $this->_qte * $this->_prod->getPrixUnitaire();
	}
	
	public function Save($dbconnexion,$numcommande){
				
		$req="INSERT INTO lignecommande VALUES
				('".$numcommande."','"
				   .$this->getProduit()->getId() ."','"
				   .$this->getQuantite()."',"
				   .$this->getProduit()->getPrixUnitaire().")";
		
		//var_dump($req);
		
		$stmt = $dbconnexion->prepare($req);
		$nb=$stmt->execute();
		//echo "Ligne de commande Enregistrée";
	}
}

?>