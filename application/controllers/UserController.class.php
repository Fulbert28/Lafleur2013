<?php
class UserController extends Controller {
	
	function IndexAction(){

		$this->showView();
	}
	
	function LoginAction(){

		//var_dump($_POST);
		
		if(isset($_POST['valider'])){
			//Le formulaire a été validé, on le traite
			//echo "formulaire validé ";
			
			$login=$_POST['inputLogin'];
			$password=$_POST['inputPassword'];
			
			$UserConfig=User::getConfigurationUser("config/config.xml");
			
			/*
			 * Verification de la connection en tant qu'administrateur
			 */
			if($login==$UserConfig["login"] && $password==$UserConfig["password"]){
				//echo "Connexion OK";
				
				$tab_admin=array(0,$login,"",true);
				$user=new User($tab_admin);
				User::setInstance($user);
				
				//Redirection sur la page d'accueil
				Application::getController("User","Authentification");
			}
			else{
				
				/*
				 * verification de la connexion en tant que client
				 */
				$DAOUser=new User();
					
				$critere="login='".$login."' AND password='".$password."'";
					
				$unuser=$DAOUser->LoadByCritere($critere);
				
				var_dump($unuser);
				
				if(isset($unuser)){
					User::setInstance($unuser->getElementAtIndex(0));
					//Redirection sur la page d'accueil
					Application::getController("User","Authentification");
				}
				else{
					$params['error']="Authentification incorrecte (couple Login/Password incohérent)";
					Application::getController("User","Form",$params);
				}
			}
			
		}
		else{
			//Le formulaire n'a pas été validé, il faut donc l'appeler
			//echo "formulaire non validé ";
			Application::getController("User","Form");
		}

	}
	
	
	function FormAction($params){
		
		$this->_data['error']=$params['error'];
		
		$this->showView();
	}
	
	function DisconnectAction(){
	
		User::DestroySession();
	
		Application::getController("User","Login");
	}
	
	function AuthentificationAction(){
		
		$this->showView();
	}
	
	function DetailsAction(){
		$user=User::getInstance();
		
		$DAOClient=new Client();
		
		//L'id du user connecté correspond au id du client (même valeurs)
		$client=$DAOClient->LoadOne($user->getId());
		
		var_dump($user);
		
		var_dump($client);
	}
	
}

?>