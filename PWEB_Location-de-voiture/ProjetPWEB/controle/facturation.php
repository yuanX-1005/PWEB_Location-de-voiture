<?php 

	/*controleur facturation.php :
 	 fonctions-action de gestion (facturation)
	*/

    function facturation(){
		$msg ='';
		$idE=$_GET['idE'];
		$idV=$_GET['idV'];
		$idF=$_GET['idF'];	
	
		if(isset($idE)&&isset($idV)&&isset($idF)&&isset($_SESSION['nbVehicule'])){
			require ("./modele/operationEntrepriseBD.php");
            require ("./modele/autreOperationBD.php");

			$nbVehicule=$_SESSION['nbVehicule'];
			$infosFacturation=array();
			$infosVehicule = array();
			$infosEntreprise=array();
		   
			//obtiens les infos factuartions, voiture et entreprise
			infosEntreprise($idE,$infosEntreprise); 
			infosVoiture($idV,$infosVehicule);
			infosFacturation($idF,$infosFacturation);

			//verifier si date Fin est null
			if($infosFacturation['dateFin']!=NULL){ //si non, nbjours louée un voiture = ecartes entre date debut et date fin
				$nbjours=differenceEntreDeuxDates($infosFacturation['dateDebut'],$infosFacturation['dateFin']); 

			}else{ //si oui, nbjours louée un voiture = 30
				$nbjours="30";
			}

			if($infosFacturation['dateFin']==NULL){ //flage pour que certaines infos soit apparait/non apparait sur page tpl
				$flagF=false;
			}else{
				$flagF=true;
			}

			#$idL=$_SESSION['profilLoueur']['idLoueur'];

			if($infosFacturation['etat']==true) //Aller sur differents page de facturation selon le etat de payement
				require ("./vue/facturation/facturation.tpl");
			else
				require ("./vue/facturation/facturationNonPayes.tpl");	
		}	
    }

	// facturation de un client (il peut etre composer par plusieur flottes de voitures ) 
 	function ligneFacturation(){
		$msg ='';
		$idE=$_GET['idE'];
		$idL=$_GET['idL'];	

		if(isset($idE)&&isset($idL)){

			$infosFacturationParEntreprise=array();
			$infosVehicule = array();
			$infosEntreprise=array();
			$ListInfosVoitures=array();
			$ListeEtatDateFin=array();


			$tempsRelle = date('Y/m/d',time()); //temps relle en estampille

			$Montant_total=0;
			$MontantNonPaye=0;
			$MontantPaye=0;

            require ("./modele/operationEntrepriseBD.php");
            require ("./modele/autreOperationBD.php");

			infosEntreprise($idE,$infosEntreprise); //obtien infos d'un entreprise à partir de son id

			infosLesFacturationsParEntreprise($idE,$tempsRelle,$infosFacturationParEntreprise); //Les listes de facturation courant d'un entreprise

			for($i=0; $i < count($infosFacturationParEntreprise,0); $i++){ 

				infosVoiture($infosFacturationParEntreprise[$i]['idVehicule'],$infosVehicule); //trouves les infos de voitures copprespond au facturation trouve en avant
				$ListInfosVoitures[]=$infosVehicule; // ces voitures dans un tableau

				$Montant_total += $infosFacturationParEntreprise[$i]['valeur']; //calculer montant total à payer 

				if($infosFacturationParEntreprise[$i]['etat']==false){
					$MontantNonPaye+=$infosFacturationParEntreprise[$i]['valeur']; //calculer les montant qui sont deja payé
				}
				else{
					$MontantPaye+=$infosFacturationParEntreprise[$i]['valeur']; //calculer les montant qui ne sont pas encore payé
				}

				if($infosFacturationParEntreprise[$i]['dateFin']!=NULL){ //obtien les flags pour affichier ou non afficher certaines infos sur page tpl
					$ListeEtatDateFin[] = true;
				}else{
					$ListeEtatDateFin[] = false;
				}
				
			}
				require ("./vue/facturation/LigneFacturation.tpl");	
		}	
    }
     



?>