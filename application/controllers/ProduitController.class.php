<?php 

class ProduitController extends Controller{
	
	function ListbycategorieAction($params=null){
		
		//Recuperation de la categorie (Methode GET ->lien hypertexte classique, ou Redirection via Controlleur  -->utilisation du parametres params de la fonction)
		if(isset($_GET['idcategorie'])){
			$codecateg=$_GET['idcategorie'];
		}
		else{
			$codecateg=$params['idcategorie'];
		}
		
		//Recuperation de la categorie concerné via les fonctionnalité de chargement d'un objet du framework (classe Categorie herite de Entity)
		$myDAOCategorie=new Categorie();
		$macateg=$myDAOCategorie->LoadOne($codecateg);
		
		//Recupération des produits en fonction de la categorie
		$myDAOProduit=new Produit();
		$lesproduits=$myDAOProduit->LoadByCritere("idCategorie='$codecateg'");
		
		//On alimente le tableau associatif _data nécessaire à la vue.
		$this->_data['lesproduits']=$lesproduits;
		$this->_data['categorie']=$macateg;
		
		//Appel de la vue
		$this->showView();
		
	}
	
	
	function addAction(){
		
		/*
		 * Verification de l'autorisation ou non d'effectuer l'action
		*/
		 if(User::isAdministrator()){	
		
			if(isset($_POST['validation'])){
				//Le formulaire a été validé
				var_dump($_POST);
				
				
				//Instanciation d'un nouveau produit
				//Pas d'appel au constructeur car celui ci necessite un tableau en parametre.
				$leprod=new Produit();
				
				//recuperation de l'ID....(Peut etre qu'il faut eviter que ce soit a l'utilisateur de le saisir)
				$id=$_POST['txt_ref'];
				
				//Valorisation de chaque attribut de la classe avec les valeurs saisie dans le formulaire (pas de verif pour l'instant)
				$leprod->setId($id);
				$leprod->setLibelle($_POST['txt_libelle']);
				$leprod->setPrixUnitaire($_POST['txt_prix']);
				
				//recuperation de la categorie choisie par l'utilisateur
				$codecateg=$_POST["sel_categ"];
					
				//Acces à la couche de données, recuperation de l'objet categorie correspondant
				$DAOCateg=new Categorie();
				$sacateg=$DAOCateg->LoadOne($codecateg);
				
				//On precise la categorie a laquelle appartient l'objet
				$leprod->setCategorie($sacateg);
				
				
				//TYraitement de la photo
				if(isset($_FILES)){
					var_dump($_FILES);
					
					//Chemin du dossier ou sera stocké l'image
					$cat=$sacateg->getLibelle();
					$uploaddir = "images/$cat/";
					
					//recuperation de la postion du point dans le nom du fichier
					$pos = strpos($_FILES['photo']['name'], ".");
					
					//Recuperation de la sous chaine (substring) a la droite de la position du point: Donc l'extension
					$extension=substr($_FILES['photo']['name'], $pos); 
					
					//nom relatif de la nouvelle image
					$uploadfile = $uploaddir.$id.$extension;
					
					if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
						echo "Le fichier est valide, et a été téléchargé  avec succès.";
					
						$leprod->setPhotoURL($uploadfile);
					} 
					else {
						echo "Erreur dans la copie de la photo...enregistrement dans la base sans faire reference à la photo";
						$leprod->setPhotoURL("");
					}
					//Sauvegarde de l'objet en base de données
					$leprod->Save();
				}
			}
			else{
						
				//Recuperation de la categorie (Methode GET ->lien hypertexte classique, ou Redirection via Controlleur  -->utilisation du parametres params de la fonction)
				if(isset($_GET['idcategorie'])){
					$codecateg=$_GET['idcategorie'];
				}
				else{
					$codecateg=$params['idcategorie'];
				}
				
				//Recuperation de la categorie concerné via les fonctionnalité de chargement d'un objet du framework (classe Categorie herite de Entity)
				$myDAOCategorie=new Categorie();
				$macateg=$myDAOCategorie->LoadOne($codecateg);
				
				//Chargement de toutes les categorie pour alimenter la liste déroulante
				$lescateg=$myDAOCategorie->LoadAll();
				
				//var_dump($lescateg);
			
				//Le formulaire n'a pas été validé...Appel de la vue
				$this->_data['lescategories']=$lescateg;
				$this->_data['categorie']=$macateg;
				$this->showView();
			}
		 }
		 else{
		 	//Compte non autorisé a faire cette action
		 	echo "<h3>Vous n'etes pas autorisé à faire cette action.</h3>";
		 	echo "<h3>Vous devez être authentifié avec un compte d'\"administration\"</h3>";
		 }
	}
}
?>