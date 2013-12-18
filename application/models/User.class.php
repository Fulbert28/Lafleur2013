<?php

class User extends Entity{
	
	private $_id;
	private $_login;
	private $_password;
	private $_administrator;
	
	private static $_leuser;
	
	/*
	 * 
	 function User($lelogin=null) {
		$this->_login=$lelogin;
	}
	*/
	
	public function User(array $params=null) {
		
		$this->lierDB("User","User");
		
		//var_dump($params);
		
		if(isset($params)){
			$this->_id=$params[0];
			$this->_login=$params[1];
			$this->_password=$params[2];
			
			if(isset($params[3])){
				$this->_administrator=$params[3];
			}
			else{
				$this->_administrator=false;
			}
		}
	}
	
	public function getLogin(){
		return $this->_login;
	}
	
	public function getId(){
		return $this->_id;
	}
	
	/*
	 * Methodes à porté de classe (static)
	 */
	
	/**
	 * Recupere l'instance de l'utilisateur stocké sous la forme de singleton dans la classe User
	 */
	public static function getInstance(){
		return self::$_leuser;
	}
	
	/***
	 * Place une instance de User sous la forme d'un singleton dans la classse User
	 */
	public static function setInstance(User $leuser){
		self::$_leuser=$leuser;
	}
	
	/***
	 * Sauvegarde le Singleton User dans la variable de session "user"
	 */
	public static function saveUserSession(){
		$_SESSION['user']=self::$_leuser;
	}
	
	/***
	 * Initialise le User en fonction de ce qu'il y a dans la session.
	 */
	public static function initUserSession(){
		//var_dump($_SESSION['user']);
		if(isset($_SESSION['user'])){
			//echo "<h1>le user existe, je le recupere</h1>";
			self::$_leuser=$_SESSION['user'];
		}
	}
	/***
	 * Permet de verifier si un utilisateur est connecté
	 */
	public static function isConnected(){
		
		if(self::$_leuser==NULL){
			return false;
		}
		else{
			return isset(self::$_leuser);
		}
	}
	
	/**
	 * Suprime la variable de session user, a la prochaine requette http, le User ne sera plus reconnu
	 */
	public static function DestroySession(){
		self::$_leuser=NULL; 
		//unset(User::$_leuser);
		unset($_SESSION['user']);
	}
	
	public static function isAdministrator(){
		
		if(self::isConnected() && self::$_leuser->_administrator){
			return true;
		}
		else{
			return false;
		}
	}
	
	public static function getConfigurationUser($_fichier_XML){
		
		if (file_exists($_fichier_XML)){
			$config = simplexml_load_file($_fichier_XML);
		}
		else{
			$data='<application>
						<user login="admin" password="azerty"/>
				   </application>';
				
			$config = simplexml_load_string($data);
		}
		
		$user_element=$config->children()->user;
		
		$UserConfig['login']=$user_element->attributes()->login;
		$UserConfig['password']=$user_element->attributes()->password;
		
		return $UserConfig;
	}


}

?>