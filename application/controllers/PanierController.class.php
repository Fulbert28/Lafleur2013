<?php

class PanierController extends Controller {
	
	function ResumeAction(){
		
		//Recuperation du Panier
		$monpanier=Panier::getInstance();
		
		//On alimente en donn�es la vue
		$this->_data['panier']=$monpanier;
		
		//On appele la vue associ� a cette action (Controlleur->Panier Action->Index)
		$this->showView();
	}
	
	function IconeAction(){
		//Code identique � IndexAction, on y fait donc appel
		$this->ResumeAction();
	}
	
	function DetailAction(){
		
		//Code identique � IndexAction, on y fait donc appel
		//$this->ResumeAction();
		
		//Recuperation du Panier
		$monpanier=Panier::getInstance();
		
		//On alimente en donn�es la vue
		$this->_data['panier']=$monpanier;
		
		$this->showView();
	}
	
	function AddAction(){
		
		//Recuperation de l'id du produit transmis par la methode GET (dans l'URL donc)
		$idproduit=$_GET['id'];
		
		//Chargement du Produit concern� grace au framework ORM (la classe instanci� herite de Entity donc dispose des methodes d�crites dans l'interface IDAO)
		$myDAOprod=new Produit();
		$objproduit=$myDAOprod->LoadOne($idproduit);
		
		//Recuperation du panier
		$lepanier=Panier::getInstance();
		
		//Ajout du Produit concern� (charg� pr�cedement via son id) dans le panier
		$lepanier->Add($objproduit);
		
		//Sauvegarde du panier en utilisant la methode a port� de classe (static) setInstance de la classe Panier
		Panier::setInstance($lepanier);
		
		//Tentative de reirection sur le Controlleur affichant les produits par categorie (la categorie du produit ajout� dans le panier)
		$parametres['idcategorie']=$objproduit->getCategorie()->getId();
		Application::getController("Produit","Listbycategorie",$parametres);
		
	}
	
	function addqteAction(){
		
		//Recuperation de l'id du produit transmis par la methode GET (dans l'URL donc)
		$idproduit=$_GET['prodid'];
		
		//Chargement du Produit concern� grace au framework ORM (la classe instanci� herite de Entity donc dispose des methodes d�crites dans l'interface IDAO)
		$myDAOprod=new Produit();
		$objproduit=$myDAOprod->LoadOne($idproduit);
		
		//Recuperation du panier
		$lepanier=Panier::getInstance();
		
		//Ajout du Produit concern� (charg� pr�cedement via son id) dans le panier
		$lepanier->Add($objproduit);
		
		//Sauvegarde du panier en utilisant la methode a port� de classe (static) setInstance de la classe Panier
		Panier::setInstance($lepanier);
		
		Application::getController("Panier","Detail");
	}
	
	function delqteAction(){
		
		//Recuperation de l'id du produit transmis par la methode GET (dans l'URL donc)
		$idproduit=$_GET['prodid'];
		
		//Chargement du Produit concern� grace au framework ORM (la classe instanci� herite de Entity donc dispose des methodes d�crites dans l'interface IDAO)
		$myDAOprod=new Produit();
		$objproduit=$myDAOprod->LoadOne($idproduit);
		
		//Recuperation du panier
		$lepanier=Panier::getInstance();
		
		//Ajout du Produit concern� (charg� pr�cedement via son id) dans le panier
		$lepanier->Del($objproduit);
		
		//Sauvegarde du panier en utilisant la methode a port� de classe (static) setInstance de la classe Panier
		Panier::setInstance($lepanier);
		
		Application::getController("Panier","Detail");
	}
	
	function CommanderAction(){
		
		$user=User::getInstance();
		var_dump($user);
		
		if(isset($user)){
			$id_commanditaire=User::getInstance()->getId();
			
			$lepanier=Panier::getInstance();
			
			try{
				$lepanier->SaveToCommande($id_commanditaire,$id_commanditaire);
				echo "<h2>Commande Enregistrée avec succés</h2>";
				
				$nouveaupanier=new Panier();
				Panier::setInstance($nouveaupanier);
			}
			catch(Exception $e){
				echo "Erreur!: " . $e->getMessage() . "</br>";
			}
		}
		else{
			echo "<h2>Merci de vous authentifier</h2>";
		}
	}
	
}

?>