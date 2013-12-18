<?php

class Panier extends Commande{
	
	private static $_lepanier;	//Attribut static (A porté de classe) utilisé comme Singleton
	
	public function Panier(){
		parent::Commande();
		
		$this->lierDB("Panier","commande");
	}
	
	public function Del(Produit $leprod){
		$laligne=$this->ExisteProduit($leprod);
		
		if($laligne->getQuantite()>1 ){
			$laligne->DelUnite();
		}
		else{
			$this->_leslignes->Remove($laligne);
		}
	}
	
	
	/**
	 * 
	 * @return Panier
	 * 
	 * retourne l'instance de panier stockée sous la forme d'un Singleton dans la classe Panier
	 */
	public static function getInstance(){
		return self::$_lepanier;
	}
	
	/**
	 * 
	 * @param Panier $paniermodifie
	 * Modifie le panier existant en l'écrasant avec sa nouvelle valeur
	 */
	public static function setInstance($paniermodifie){
		self::$_lepanier=$paniermodifie;
	}
	
	/**
	 * Permet d'initialiser la gestion du Panier en Session.
	 * 
	 * Instancie la classe Panier si la session est vide
	 * Dans le cas contraire, recupere le Panier existant dans la session.
	 */
	public static function initPanierSession(){
		if(isset($_SESSION['panier'])){
			//echo "<h1>le panier existe, je le recupere</h1>";
			self::$_lepanier=$_SESSION['panier'];
		}
		else{
			//echo "<h1>le panier n' existe pas, je l'instancie</h1>";
			$panier=new Panier();
			self::$_lepanier=$panier;
		}
	}
	
	/**
	 * Permet de sauvegarder le Panier en Session.
	 *.
	 */
	public static function savePanierSession(){
		$_SESSION['panier']=self::$_lepanier;
	}
	
	public function SaveToCommande($id_commanditaire, $id_destinataire){
			
		$today = date('Y-m-d H:i:s');
			
		$req="INSERT INTO ".$this->_tablename." (dateCommande, TotalHT, refCommanditaire, RefDestinataire)
			  VALUES ('". $today. "',"
		   		.$this->getTotalHT().","
		   		.$id_commanditaire.","
		  		.$id_destinataire.")";
			
		//var_dump($req);
			
		$db=Database::getInstance();
	
		try {
			$db->beginTransaction();
			
			$stmt = $db->prepare($req);
			$nb=$stmt->execute();
				
			$idcommande=$db->lastInsertId();
			
			foreach($this->_leslignes->getAll() as $uneligne){
				$uneligne->Save($db,$idcommande);
			}
				
			$db->commit();
			
		}
		catch(PDOExecption $e) {
			$db->rollback();
			throw new Exception("Erreur dans l'enregistrement de la commande");
		}

	}

}

?>