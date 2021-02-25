<?php 
/*controleur entreprise.php :
  fonctions-action de gestion (entreprise)
*/

	//accueil de le plateforme, entrée de la site 
	function accueil() {
		$msg='';
		$infoVoiture = array();
		require ("./modele/entrepriseBD.php");	
		if(!chercher_VoituresDisp($infoVoiture)){
			$msg = "aucune voirures sont disponibles";
		}
		else{
			$_SESSION['infoVoiture']=$infoVoiture;
			require("./vue/entreprise/accueil.tpl");
		}
	}


	//page connextion de l'entreprise, le personne non inscritpt peut tourne vers le page inscription 
	function connexionEntrp() { 

		$nom=  strip_tags(isset($_POST['nom'])?($_POST['nom']):'');
		$mdp=  strip_tags(isset($_POST['mdp'])?($_POST['mdp']):'');
		$cleanmdp = crypt(md5($mdp),md5($nom)); // crypter les mods de passe
		$msg='';

		if  (count($_POST)==0)
			require ("./vue/entreprise/connexionEntrp.tpl") ;
		else {
			require("./modele/entrepriseBD.php");
			$profil = array();
			if  (! verif_connexionEntrep($nom,$cleanmdp,$profil)) {
				$msg ="erreur de saisie";
				require ("./vue/entreprise/connexionEntrp.tpl");
			}
			else { 
				$_SESSION['profil'] = $profil;
				$idE = $_SESSION['profil']['idClient'];
				$url = "index.php?controle=entreprise&action=accueilEntrep&idE=$idE";
				header("Location:" . $url) ;
			}
		}	
	}

	// accueil de l'entreprise connecte
	function accueilEntrep(){
		$msg='';

		if (isset($_SESSION['profil'])) {
			$ListeVoitureLocat = array();

			$nom = $_SESSION['profil']['nom'];
			$idE=$_GET['idE'];

			$infoIdF = array();
			$ListFacturationEntrep = array();
			$tempsRelle = date('Y/m/d',time()); // temps actuel en estampilles

			require ("./modele/entrepriseBD.php");
			require ("./modele/autreOperationBD.php");	

			if(!vehiculeEnCourDeLocation($idE,$tempsRelle, $ListeVoitureLocat)){ //chercher les vehicules en cours de loué par l'entreprise
				$msg ="Vous n'avez pas encore loué de voitures.";
				$flag = false;
				require("./vue/entreprise/accueilEntrep.tpl");
			}
			else{
				$_SESSION['ListeVoitureLocat']= $ListeVoitureLocat;
				require ("./modele/loueurBD.php");

				for($i=0; $i<count($ListeVoitureLocat,0); $i++){ //obtien la liste de facturation de cette client 
					acquerirInfoFacturation($idE,$ListeVoitureLocat[$i]['idVehicule'],$tempsRelle,$infoIdF);
					$ListFacturationEntrep[]=$infoIdF;
				}

				$_SESSION['ListFacturationEntrep']=$ListFacturationEntrep; //fait que cette liste soit accesible dans les autres fichier
				$flag = true;
				require ('./vue/entreprise/accueilEntrep.tpl');	
			}			
		}
	}
	
	//inscription de client 
	function inscriptEntrep(){
		$nom = strip_tags(isset($_POST['nom'])?($_POST['nom']):'');
		$mdp = strip_tags(isset($_POST['mdp'])?($_POST['mdp']):'');
		$email= isset($_POST['email'])?($_POST['email']):'';
		$cleanmdp = crypt(md5($mdp),md5($nom)); // crypter les mods de passe
		$msg='';

		if  (count($_POST)==0)
			require ("./vue/entreprise/inscriptEntrep.tpl") ;

		else {
			$profil = array();
			$inscrit = array();

			require("./modele/entrepriseBD.php");

			if(verif_inscriptEntrep_email($email,$profil)) { //verifier s'il existe un email existe deja dans le BD
				$msg ="cet email existe déjà";
				require ("./vue/entreprise/inscriptEntrep.tpl") ; //verifier s'il existe un mdp existe deja dans le BD
			}
			elseif (verif_inscriptEntrep_mdp($cleanmdp,$profil)){
				$msg ="ce mot de passe existe déjà";
				require ("./vue/entreprise/inscriptEntrep.tpl") ;
			}
			else { 
				//verif_contraintes();
				if(isset($_POST['nom'], $_POST['mdp'], $_POST['email'])){
					if(empty($_POST['nom'])){
						$msg = "Le champ nom est vide";
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					} 
					//verifier si le champ de matricule est vide
					elseif(empty($_POST['mdp'])){//le champ matricule est vide
						$msg = "Le champ matricule est vide";	
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					}
					elseif(empty($_POST['email'])){//le champ matricule est vide
						$msg = "Le champ email est vide";	
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					}  
					// Seulement les lettres et l'espace sont accepté !
					elseif(!preg_match("/^[a-zA-Z ]{1,20}$/",$_POST['nom'])){ 
						$msg = "Seulement les lettres et l'espace sont acceptés dans le champ  nom!";
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					}
					//Il faut respecter le forme de l'email
					elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])){
						$msg = "La forme de l'email est incorrecte";
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					}
					//le champ matricule n'est peut pas dépasser de 10 caractères
					elseif(strlen($_POST['mdp'])>10){ 
						$msg = "La longueur mot de passe  doit être compris entre 8 et 10 caractères";
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					} 
					//le champ matricule n'est peut pas inférieur de 8 caractères
					elseif(strlen($_POST['mdp'])<8){ //le champ matricule est trop court (moins de 8 caractères)
						$msg = "La longueur mot de passe  doit être compris entre 8 et 10 caractères";
						require ("./vue/entreprise/inscriptEntrep.tpl") ;
					} 
					else {
						if(!ajouter_persone($nom, $cleanmdp, $email, $inscrit)){ 
							$msg = "Une erreur s'est produite. ";
							require ("./vue/entreprise/inscriptEntrep.tpl");
						} 
						else {
							$msg = ("Votre inscription est reussie !"); //l'utilisateur reussi d'inscription 
							require ("./vue/entreprise/connexionEntrp.tpl");
						}
					}
				}
				
			}
		}	
	}

	

	
	

?>
