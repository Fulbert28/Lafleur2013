<?php

/** 
 * @author MERY
 * 
 */
class Produit extends Entity{
	
	private $_str_id;
	private $_str_libelle;
	private $_flt_prixunit;
	private $_img_photo;
	private $_obj_categorie;
	
	/**
	 */
	function Produit(array $params=null) {
		
		$this->lierDB("produit","produit");
		
		//var_dump($params);
		
		if(isset($params)){
			$this->_str_id=$params[0];
			$this->_str_libelle=$params[1];
			$this->_flt_prixunit=$params[2];
			$this->_img_photo=$params[3];
			
			/*
			 * Attention c'est un objet !!!!
			 */
			$code_categorie=$params[4];
			
			$myDAOCategorie=new categorie();
			$mycat=$myDAOCategorie->LoadOne($code_categorie);
			
			$this->_obj_categorie=$mycat;
		}
		
	}
	
	
	public function getId(){
		return $this->_str_id;
	}
	
	public function setId($id){
		$this->_str_id=$id;
	}
	
	public function getLibelle(){
		return $this->_str_libelle;
	}
	
	public function setLibelle($libelle){
		$this->_str_libelle=$libelle;
	}
	
	public function getPrixUnitaire(){
		return $this->_flt_prixunit;
	}
	
	public function setPrixUnitaire($pu){
		$this->_flt_prixunit=$pu;
	}
	
	public function getCategorie(){
		return $this->_obj_categorie;
	}
	
	public function setCategorie(Categorie $categ){
		$this->_obj_categorie=$categ;
	}
	
	public function getPhotoURL(){
		return $this->_img_photo;
	}
	
	public function setPhotoURL($url){
		$this->_img_photo=$url;
	}
	
	public function getPhotoHTML(){
		$html="<img src=\"".$this->getPhotoURL()."\" />";
		return $html;
	}
	
	/**
	 * @author MERY Ludovic
	 * @param Produit $unproduit
	 * @return boolean
	 * 
	 * Permet de comparer un ObjetProduit (transmis en paramètre) à l'instance en cours
	 * 
	 * On considerera que les Produits sont identique s'ils ont la même valeur de clé primaire (id avec la même valeur)
	 * 
	 */
	public function CompareTo(Produit $unproduit){
		if($unproduit->getId()==$this->_str_id){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	public function Save(){
		
		$req="INSERT INTO ".$this->_tablename." VALUES
				('".$this->_str_id."','"
				   .$this->_str_libelle."','"
				   .$this->_flt_prixunit."','"
				   .$this->_img_photo."','"
				   .$this->_obj_categorie->getId()."')";
		
		//var_dump($req);
		
		$db=Database::getInstance();
		
		$stmt = $db->prepare($req);
		$nb=$stmt->execute();
		
		echo "$nb enregistrement ajoutés dans la base";
	}
	
}

?>