<?php 
class CategorieController extends Controller{
	
	function MenuAction(){
		//Recuperation de toutes les categories via les fonctionnalit� de chargement de plusieurs objet du framework (classe Categorie herite de Entity)
		$myDAOCategorie=new Categorie();
		$lescateg=$myDAOCategorie->LoadAll();
		
		//On alimente la vue en donn�es (data)
		$this->_data['lescateg']=$lescateg;
		//Appel de la vue
		$this->showView();
		
	}
}
?>