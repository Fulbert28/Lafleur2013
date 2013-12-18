<?php 
class CommandeController extends Controller{
	
	function IndexAction(){
		//Recuperation de toutes les categories via les fonctionnalit� de chargement de plusieurs objet du framework (classe Categorie herite de Entity)
		$DAOCommande=new Commande();
		
		$idclient=User::getInstance()->getId();
		
		$critere="refCommanditaire=$idclient";
		$lescommandes=$DAOCommande->LoadByCritere($critere);
		
		//On alimente la vue en donn�es (data)
		$this->_data['lescommandes']=$lescommandes;
		//Appel de la vue
		$this->showView();
		
	}
}
?>