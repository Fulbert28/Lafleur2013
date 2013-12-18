<?php

class MainController extends Controller {
	
	function IndexAction(){
		// Recuperation du panier en session.
		Panier::initPanierSession();
		User::initUserSession();

		//Aiguilleur en fonction du controlleur d�sir� et de l'action. (Processus de Routage)
		if(isset($_GET['controller'])){
			
			$nameController=$_GET['controller'];
			
			if(isset($_GET['action'])){
				
				$nameAction=$_GET['action'];
				//Appel du Bon controlleur et de la bonne action associ�
				Application::getController($nameController,$nameAction);
			}
			else{
				//Il n'y a pas d'action de precis�, ce sera l'action Index appel� par d�faut (Voir le code de la classe Controller)
				Application::getController($nameController);
			}
			
		}
		else{
			/*
			 * Fait appel a la vue indexView.phtml du dossier Main
			 * La vue par defaut du controlleur par d�faut (MainControlleur)
			 * utilis� quand un lien pointe vers index.php (sans ausun parametres transmis dans l'URL)
			*/
			$this->showView();
		}
		
	} 
	
}

?>