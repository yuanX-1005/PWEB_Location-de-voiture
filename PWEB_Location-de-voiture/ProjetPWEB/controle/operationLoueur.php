<?php 
	/*controleur operationLoueur.php :
	fonctions-action de gestion (operationLoueur)
	*/

	//ajouter les voitures aux voitures stockes 
	function ajouterVoiture(){
		$typeVehicule=  isset($_POST['typeVehicule'])?($_POST['typeVehicule']):'';
		$nbVehicule=  isset($_POST['nbVehicule'])?($_POST['nbVehicule']):'';
		$prix= isset($_POST['prix'])?($_POST['prix']):'';
		$moteur=  isset($_POST['moteur'])?($_POST['moteur']):'';
		$vitesse=  isset($_POST['vitesse'])?($_POST['vitesse']):'';
		$places=  isset($_POST['places'])?($_POST['places']):'';
		$msg='';

		if(count($_POST)==0)
			require ("./vue/operationLoueur/ajouterVoiture.tpl") ;
		else{
			$image = $_FILES['image']; 
			$nouveauVoiture = array();
			
			require("./modele/operationLoueurBD.php");
			
			if(isset($_SESSION['profilLoueur'])){

				$idLoueur = $_SESSION['profilLoueur']['idLoueur'];

				//Les champs ne peuvent pas etre vide
				if(empty($_POST['typeVehicule']) | empty($_POST['nbVehicule']) | empty($_POST['prix']) 
				| empty($_POST['moteur']) | empty($_POST['vitesse']) | empty($_POST['places']) ){
					$msg = "Les champs ne peuvent pas etre vide";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				} 
				// typeVehicule ne peut etre que des chiffre ou lettre majuscule/minuscule (20 caracteres maximum)
				elseif(!preg_match("/^[A-Za-z0-9]{1,20}$/",$_POST['typeVehicule'])){ 
					$msg = "Seulement les lettres et l'espace sont accepté dans l'espace de typeVehicule!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}
				// nbVehicule ne peut etre que des chiffre (10 numeros maximum)
				elseif(!preg_match("/^[0-9]{1,10}$/",$_POST['nbVehicule'])){ 
					$msg = "Seulement les nombres et l'espace sont accepté dans l'espace de nbVehicule!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}
				//prix ne peut etre que des chiffre (20 numeros maximum)
				elseif(!preg_match("/^[1-9]{1,20}$/",$_POST['prix'])){ 
					$msg = "Seulement les chiffres l'espace de prix!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}
				// moteur ne peut etre que du lettre majuscule/minuscule (20 caracteres maximum)
				elseif(!preg_match("/^[a-z]{1,20}$/",$_POST['moteur'])){ 
					$msg = "Seulement les lettres minuscules et l'espace sont accepté dans l'espace de moteur!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}
				// vitesse ne peut etre que des chiffre ou lettre minuscule (20 caracteres maximum)
				elseif(!preg_match("/^[a-z0-9]{1,20}$/",$_POST['vitesse'])){ 
					$msg = "Seulement les lettres minuscules et l'espace sont accepté dans l'espace de vitesse!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}
				// nombre de places par vehicules ne peut etre que des chiffre (2 numeros maximum)
				elseif(!preg_match("/^[0-9]{1,2}$/",$_POST['places'])){ 
					$msg = "Seulement les nombres et l'espace sont accepté dans l'espace de places!";
					require("./vue/operationLoueur/ajouterVoiture.tpl");
				}

				elseif(verif_existance_typeVehicule($typeVehicule,$typeVehiculePresentes)) { // les type de vehicule est unique
					$msg ="Cette type de véhicule existe déjà";
					require("./vue/operationLoueur/ajouterVoiture.tpl"); 
				}
				
				elseif ($image['error'] > 0) { //erreurs de uplote de l'image
					switch ($image['error']) {
						case 1:
							$msg= "les tailles est trop grand pour serveur！";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						case 2:
							$msg= "les tailles est trop grand pour form！";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						case 3:
							$msg= "seul une pertie de image soit envoyé！";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						case 4:
							$msg= "aucune img soit envoyé!";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						case 6:
							$msg= "Le répertoire temporaire n'existe pas！";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						case 7:
							$msg= "echec d'ecrit!";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
						default:
							$msg= "erreur inconnu！";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							break;
					}
				} else {
					$typeVehicule=  test_input($_POST['typeVehicule']); //enlever les espaces vide et \
					$moteur= test_input($_POST['moteur']);
					$vitesse= test_input($_POST['vitesse']);

					$caractArray = array('moteur' => $moteur, 'vitesse' => $vitesse,'places' => $places);
					$caract = json_encode($caractArray); //code en jason les caracteres 
					//prend la recine de l'img
					$type = strrchr($image['name'], ".");
					//Définir le chemin de téléchargement
					$photo = "./vue/images/voitures/" . $image['name']; 
					//Déterminez si le fichier téléchargé est au format image
					if (strtolower($type) == '.png' || strtolower($type) == '.jpg' || strtolower($type) == '.bmp' || strtolower($type) == '.gif') {
						//Déplacez le fichier image dans ce répertoire
						if(!(move_uploaded_file($image['tmp_name'], $photo))){
							$msg = "enregistrement echec";
							require("./vue/operationLoueur/ajouterVoiture.tpl");
							return;
						}else{ //ajouter voiture dans le base de donnée
							if(!ajouter_Voiture($typeVehicule,$nbVehicule,$caract,$prix,$photo,$idLoueur,$nouveauVoiture)){
								$msg ="Erreure de saisir";
								require("./vue/operationLoueur/ajouterVoiture.tpl");
							}
							else{
								$msg = "insertion reussi";
								require("./vue/operationLoueur/ajouterVoiture.tpl");
							}
						}
					}
				}
			}
		}
	}
    
	function test_input($data){ //enlevre l'espace et \ du entre
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	//supprimer les voitures
	function suppVoiture(){
		$typeVehicule=  isset($_POST['typeVehicule'])?($_POST['typeVehicule']):'';
		$nbVehicule =  isset($_POST['nbVehicule'])?($_POST['nbVehicule']):'';
		$msg='';

		if  (count($_POST)==0){
			require ("./vue/operationLoueur/SuppVoiture.tpl") ;
		}
		else {
			$SupprimVoiture = array(); 
			require("./modele/operationLoueurBD.php");
			if(isset($_SESSION['profilLoueur'])){
				$idLoueur = $_SESSION['profilLoueur']['idLoueur'];
				
				if(!SupprVoiture($typeVehicule,$nbVehicule, $SupprimVoiture)){
					$msg ="Echec de suprression";
					require ("./vue/operationLoueur/SuppVoiture.tpl");
				}
				else{
					$msg = "Vous avez supprimé la ou les  voiture(s) du stock";
					require ("./vue/operationLoueur/SuppVoiture.tpl");
				}
                
			}
		}
	}
?>