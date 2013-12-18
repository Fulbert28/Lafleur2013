<?php

$mod_debug=false;

/*
 * Partie MVC du framework
 */
require_once ("pedaFramework/MVC/Application.class.php");
require_once ("pedaFramework/MVC/ControllerFactory.class.php");
require_once ("pedaFramework/MVC/Controller.class.php");
require_once ("pedaFramework/MVC/Layout.class.php");

/*
 * Classes ORM du framework
*/
require_once ("pedaFramework/ORM/Database.class.php");
require_once ("pedaFramework/ORM/IDAO.class.php");
require_once ("pedaFramework/ORM/Entity.class.php");

/*
 * Classe Collection
 */
require_once ("pedaFramework/Collection.class.php");


/*
 * Faire r�f�rence au Model de notre application
 */
require_once ("application/models/Address.class.php");
require_once ("application/models/Categorie.class.php");
require_once ("application/models/Produit.class.php");
require_once ("application/models/Client.class.php");
require_once ("application/models/Commande.class.php");
require_once ("application/models/Panier.class.php");
require_once ("application/models/LignePanier.class.php");
require_once ("application/models/User.class.php");


/*
 * Faire reference aux controlleurs de l'application
 */
require_once ("application/controllers/NavigationBarController.class.php");
require_once ("application/controllers/MainController.class.php");
require_once ("application/controllers/CategorieController.class.php");
require_once ("application/controllers/ProduitController.class.php");
require_once ("application/controllers/PanierController.class.php");
require_once ("application/controllers/UserController.class.php");
require_once ("application/controllers/CommandeController.class.php");

//Initialisation des sessions (a partir de la methode static initSession de la classe Application
Application::initSession();

//Initialisation de la connexion � la base de donn�es
Database::InitDB("config/config.xml");
//Database::createInstance("mysql","127.0.0.1","lafleur","root","");

//Choix du layout graphique
Application::setLayout("Bootstrap3layout");
Application::getLayout()->show();

//Sauvegarde du panier en session (methode static de la classe Panier)
Panier::savePanierSession();
User::saveUserSession();

if($mod_debug){
	echo "</br></br>";
	echo "</h2>Bloc User</h2>";
	var_dump($_SESSION["user"]);
	echo "</h2>Bloc Panier</h2>";
	var_dump($_SESSION["panier"]);
	
	$pan=$_SESSION["panier"];
	echo "</h2>Bloc Ligne de Panier</h2>";
	var_dump($pan->getLesLignes());
}

//Deconnexion � la base de donn�es
Database::close();

?>