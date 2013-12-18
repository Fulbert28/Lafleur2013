<?php

class MainController extends Controller {
	
	function IndexAction(){
		// Recuperation du panier en session.
		Panier::initPanierSession();
		User::initUserSession();

		//Aiguilleur en fonction du controlleur désiré et de l'action. (Processus de Routage)
		if(isset($_GET['controller'])){
			
			$nameController=$_GET['controller'];
			
			if(isset($_GET['action'])){
				
				$nameAction=$_GET['action'];
				//Appel du Bon controlleur et de la bonne action associé
				Application::getController($nameController,$nameAction);
			}
			else{
				//Il n'y a pas d'action de precisé, ce sera l'action Index appelé par défaut (Voir le code de la classe Controller)
				Application::getController($nameController);
			}
			
		}
		else{
			/*
			 * Fait appel a la vue indexView.phtml du dossier Main
			 * La vue par defaut du controlleur par défaut (MainControlleur)
			 * utilisé quand un lien pointe vers index.php (sans ausun parametres transmis dans l'URL)
			*/
			$this->showView();
		}
		
	} 
	
}

?>