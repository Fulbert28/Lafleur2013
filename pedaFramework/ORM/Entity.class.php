<?php
abstract class Entity implements IDAO{
	
	protected $_tablename;
	protected $_classename;
	
	 public function Entity(array $params=null){

	 }
	 
	 protected function lierDB($classname, $tablename){
	 	$this->_tablename=$tablename;
	 	$this->_classename=$classname;
	 }
	
	
	public function LoadAll() {
		$db=Database::getInstance();
		
		//var_dump($db);
	
		$tablename=$this->_tablename;
		$classe=$this->_classename;
		
		$req="SELECT * FROM ".$tablename;
		
		//var_dump($req);
		
		$stmt = $db->prepare($req);
		$stmt->execute();
		
		$lesobjets=new Collection();
		/*
		 * Pour chaque ligne du jeu d'enregistrement
		 */
		while ($jeuenregistrement = $stmt->fetch(PDO::FETCH_ASSOC)) {

			/*
			 * Creation d'une collection de valeurs de champ
			 */
			$params=new Collection();
			
			/*
			 * Pour chacune des colonnes de la ligne en cours
			 */
			foreach($jeuenregistrement as $champ => $valeur){
				//On stocke la valeur dans la collection
				$params->add($valeur);
			}
			
			$dataligne=$params->getAll();
			
			//var_dump($dataligne);
			/*
			 * On instancie un objet avec toute les valeurs de ces colonnes (dans le tableau de valeur)
			 */
			$monobjet=new $classe($dataligne);
		
			/*
			 * On ajoute l'objet a la collection
			 */
			$lesobjets->add($monobjet);
		}
		/*
		 * Retour de la collection
		 */
		return $lesobjets;
	}
	
	public function LoadByCritere($critere) {
		$db=Database::getInstance();
	
		//var_dump($db);
	
		$tablename=$this->_tablename;
		$classe=$this->_classename;
	
		$req="SELECT * FROM $tablename WHERE $critere" ;
	
		//var_dump($req);
	
		$stmt = $db->prepare($req);
		$stmt->execute();
	
		$lesobjets=new Collection();
		/*
		 * Pour chaque ligne du jeu d'enregistrement
		*/
		while ($jeuenregistrement = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
			/*
			 * Creation d'une collection de valeurs de champ
			*/
			$params=new Collection();
				
			/*
			 * Pour chacune des colonnes de la ligne en cours
			*/
			foreach($jeuenregistrement as $champ => $valeur){
				//On stocke la valeur dans la collection
				$params->add($valeur);
			}
				
			$dataligne=$params->getAll();
				
			//var_dump($dataligne);
			/*
			 * On instancie un objet avec toute les valeurs de ces colonnes (dans le tableau de valeur)
			*/
			$monobjet=new $classe($dataligne);
	
			/*
			 * On ajoute l'objet a la collection
			*/
			$lesobjets->add($monobjet);
		}
		/*
		 * Retour de la collection
		*/
		return $lesobjets;
	}
	
	
	public function LoadOne($id=null){
		
		$critere="id='".$id."'";
		
		$lesobjets=$this->LoadByCritere($critere);
		
		return $lesobjets->getElementAtIndex(0);
		
	}
	
	public function Save(){
		
	}
	
}

?>