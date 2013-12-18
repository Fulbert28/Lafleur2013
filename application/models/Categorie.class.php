<?php
/**
 *
 * @author MERY Ludovic
 *        
 */
class Categorie extends Entity {
	
	private $_str_id;
	private $_str_libelle;
	private $_col_lesproduits;
	

	/**
	 * 
	 * @param array $params : Tableau de parametres:
	 * 				correspond aux valeurs d'une enregistrement dans la table lié à cette classe (A savoir categorie)
	 */
	function Categorie(array $params=null) {
		
		$this->lierDB("Categorie",'categorie');
		
		//var_dump($params);
		
		if(isset($params)){
			
			$this->_str_id=$params[0];
			$this->_str_libelle=$params[1];
			
			$this->_col_lesproduits=new Collection();
		}
	}
	
	public function getId(){
		return $this->_str_id;
	}
	
	public function getLibelle(){
		return $this->_str_libelle;
	}
	
	public function setId($unId){
		$this->_str_id=$unId;
	}
	
	public function setLibelle($unLibelle){
		$this->_str_libelle=$unLibelle;
	}
	
	public function addProduit($unproduit){
		$this->_col_lesproduits->add($unproduit);
	}
}
?>