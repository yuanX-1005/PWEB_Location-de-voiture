<?php 
	
	/*controleur operationEntreprise.php :
	fonctions-action de gestion (operationEntreprise)
	*/

	//fonction : les entreprise louer une flotte de voiture
    function louerVoiture(){ 
		
		$dateDebut = isset($_POST['dateDebut'])?($_POST['dateDebut']):'';
		$dateFin = isset($_POST['dateFin'])?($_POST['dateFin']):'';
		$nbVehicule = isset($_POST['nbVehicule'])?($_POST['nbVehicule']):'';
		$msg ='';
		
		$idE = $_GET['idE'];
		$idV = $_GET['idV']; 

		$ModifVehicule = array();
		$infosVoiture = array();
		$infosFacturation=array();

		$_SESSION['nbVehicule']=$nbVehicule; 

		if(count($_POST)==0){
			require ("./vue/operationEntreprise/louerVoiture.tpl"); 
		}
		else{
			$payement = isset($_POST['payement'])?($_POST['payement']):'';
			
			require("./modele/operationEntrepriseBD.php");
			require("./modele/autreOperationBD.php");

			if(isset($idV)&&isset($idE)){

				if("Payer Directe"==$payement){ //recupere l'etat de payemnt  
					$etat = true;
				}elseif("Payer Plus tard"==$payement){
					$etat = false;
				}

				if(!infosVoiture($idV,$infosVoiture)){ //obtenir les attributs de voitures selon son id 
					$msg = "Echec de récupération des infos de la voiture";
					require ("./vue/operationEntreprise/louerVoiture.tpl");
				}
				else{
					if(empty($dateDebut)){ //Si la date début est vide returne les messages erreure
						$msg="Il est obligatoire d'inscrire la date début.";
						require ("./vue/operationEntreprise/louerVoiture.tpl");
						return;
					}
					else{
						$date_List_D=explode("-",$dateDebut); //Sinon convertir la date début en estampille du temps
						$dDebut=mktime(0,0,0,$date_List_D[1],$date_List_D[2],$date_List_D[0]);
					}
					if($dDebut<time()){ //comparer la date debut et le temps actuelle, s'il est inferieur alors recommencer 
						$msg="La date debut doit etre superieur à la date d'aujourd'hui";
						require ("./vue/operationEntreprise/louerVoiture.tpl");
					}

					//Verifie si les nombres de Vehicule est-il vide ou pas et la seule nombre possible est la nombre de flotte de véhicule (nous n'avons pas encore reussi de separe les vehicules)
					elseif(empty($nbVehicule)||($infosVoiture['nbVehicule']!==$nbVehicule)){   
						$msg="Il est obligatoire d'inscrire le nombre de véhicule et ce nombre est oblige d'egale au nombre de vehicule ".$infosVoiture['typeVehicule']." : ". $infosVoiture['nbVehicule'];
						require ("./vue/operationEntreprise/louerVoiture.tpl");
					}

					//(partie non utilise) verifier si le nb de voiture entre est super à nb voiture existe  
					elseif($nbVehicule > $infosVoiture['nbVehicule']){ 
						$msg="il n'a pas assez de vehicule, le nb de véhicule stocke est:". $infosVoiture['nbVehicule'];
						require ("./vue/operationEntreprise/louerVoiture.tpl");
					}
					else{
						if($dateFin!=NULL){ // dans le cas la date fin n'est pas null
							if(differenceEntreDeuxDates($dateDebut,$dateFin)==0){ //verifier si la date fin est superieur à data debut
								$msg = "La date Fin doit etre superieur à la date début";
								require ("./vue/operationEntreprise/louerVoiture.tpl"); 
								return;
							}
						}

						if(!ajouter_Voitures_Au_Panier($idE,$idV,$ModifVehicule)){ //si Louer la voiture && Modifie info de base de donnée n\'est pas reussi
							$msg = "Echec de location de la voiture"; // retourne msg erreur
							require ("./vue/operationEntreprise/louerVoiture.tpl");
						}
						else{
							$prixParJour=$infosVoiture['prix']; // sinon 

							if(empty($dateFin)){ //si date fin est null

								$dateFin = NULL;
								$valeur = 30*$prixParJour*$nbVehicule; //le prix pour chaque mois egele 30*$prixParJour*$nbVehicule

								$dateDebut = date('Y/m/d',$dDebut); //reconvertir la date debut en mode Y/m/d

								$idF = ajouterFacturation($dateDebut, $valeur, $dateFin, $etat, $idV, $idE); //créer un nouvelle facturation

								$msg = "Les voitures sont bien louée."; // sinon affiche cette phrase	

								$url = "index.php?controle=facturation&action=facturation&idE=$idE&idV=$idV&idF=$idF"; //saut au page facturation 
								header("Location:" . $url) ;
								
							}else{
								//meme chose pour la date fin non null
								if(($nbjours = differenceEntreDeuxDates($dateDebut,$dateFin))>0){ 

									$_SESSION['nbJoursLoue'] = $nbjours;
									$valeur = $nbVehicule*$nbjours*$prixParJour; // sauf, la valeur egale $nbVehicule*$nbjours*$prixParJour

									if($nbjours>30){ // (partie à ameliorer)
										$valeur = 30*$nbjours*$prixParJour; // si les ecartes entre deux date superieur à 30j, la facturation ne compte que la ontant de mois courant
									}
									if($nbVehicule>=10){ // si nb de vehicule depasse à 10 
										$valeur=$valeur*0.9; //promotion de 10% 
									}

									// transfert les dates dates en mode Y/m/d
									$dateDebut = date('Y/m/d',$dDebut);
									$date_List_F = explode("-",$dateFin);
									$dFin=mktime(0,0,0,$date_List_F[1],$date_List_F[2],$date_List_F[0]);
									$dateFin = date('Y/m/d',$dFin);

									$idF=ajouterFacturation($dateDebut, $valeur, $dateFin, $etat, $idV, $idE); //créer un nouvelle facturation

									$msg = "Les voitures sont bien louée."; // sinon affiche cette phrase
									$url = "index.php?controle=facturation&action=facturation&idE=$idE&idV=$idV&idF=$idF"; //saut au page facturation 
									header("Location:" . $url);
									
								}
							}
						}
					}
				}	
			}
			else{
				$msg = "erreur lors de la connexion";
				require ("./vue/operationEntreprise/louerVoiture.tpl"); 
			}
		}
	}
?>