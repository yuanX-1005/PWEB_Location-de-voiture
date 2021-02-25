<?php 
/*controleur loueur.php :
  fonctions-action de gestion (loueur) 
*/

	//page de connexion de loueur
	function connexionLoueur() {
		
		$nomLoueur=  isset($_POST['nomLoueur'])?($_POST['nomLoueur']):'';
		$mdpLoueur=  isset($_POST['mdpLoueur'])?($_POST['mdpLoueur']):'';
		$msg='';


		if  (count($_POST)==0)
				  require ("./vue/loueur/connexionLoueur.tpl"); 
		else {
			require ("modele/loueurBD.php");
			$profilLoueur = array();
			if  (! verif_connexionLoueur($nomLoueur,$mdpLoueur,$profilLoueur)) {
				$msg ="erreur de saisie";
				require ("./vue/loueur/connexionLoueur.tpl"); 
			}
			else { 
				$_SESSION['profilLoueur'] = $profilLoueur;
				$idL = $_SESSION['profilLoueur']['idLoueur'];
				$url = "index.php?controle=loueur&action=accueilLoueur&idL=$idL"; //saut au page accueil 
				header("Location:" . $url) ;

				
			}
			
		}	
	}

	//accueil de Loueur
	function accueilLoueur(){
		$msg='';
		if (isset($_SESSION['profilLoueur'])) {

			$idL = $_GET['idL'];
			$_SESSION['idL'] = $idL;

			$ListeVoitureStock = array();
			$ListeVoitureLoué = array();
			$nombreVoitureId = array();
			$infoIdF = array();
			$ListFacturatoin = array();

			$nomLoueur = $_SESSION['profilLoueur']['nomLoueur'];
			$idl = $_SESSION['profilLoueur']['idLoueur'];

			require ("./modele/loueurBD.php");	
			
			if(!afficher_Voiture_Stock($idl,$ListeVoitureStock)){ //trouves les voitures stock (pas encore vendu)
				$msg ="Vous n'avez plus de voiture en stock.";
				$flag = false;
			}
			else{
				$_SESSION['ListeVoitureStock']= $ListeVoitureStock; 
				$flag = true;	
			}
			
			if(!afficher_Voiture_Loué($idl,$ListeVoitureLoué,$nombreVoitureId)){ //trouves les voitures qui sont deja loué 
				$msg ="Vous n'avez plus de voiture en stock.";
				$flag2 = false;
			}
			else{
				$tempsRelle = date('Y/m/d',time()); // temps relle
				
				$_SESSION['ListeVoitureLoué']= $ListeVoitureLoué; //Liste de voiture déjà loué aux clients.
				$_SESSION['nombreVoitureId']= $nombreVoitureId; //Liste de nombre de voiture loué par client.
				$flag2 = true;
			}
			require ('./vue/loueur/accueilLoueur.tpl');
		}

	}
	
	
	

?>
