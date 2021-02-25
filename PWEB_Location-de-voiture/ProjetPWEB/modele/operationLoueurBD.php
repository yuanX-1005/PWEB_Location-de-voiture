<?php

	//créer un nouvelle flote de voitures en liste `Vehicule`
    function ajouter_Voiture($typeVehicule,$nbVehicule,$caract,$prix,$photo,$idLoueur,&$nouveauVoiture){
		require ("connect.php") ; 
		$sql="INSERT INTO `Vehicule` (typeVehicule, nbVehicule, caract, location, prix, photo, idLoueur, idCLient) VALUES (:typeVehicule, :nbVehicule, :caract, 'disponible', :prix, :photo, :idLoueur, null )"; 
		
			try{
			$commande2 = $pdo->prepare($sql);
			$commande2->bindParam(':typeVehicule', $typeVehicule, PDO::PARAM_STR); 
			$commande2->bindParam(':nbVehicule', $nbVehicule, PDO::PARAM_STR); 
			$commande2->bindParam(':caract', $caract, PDO::PARAM_STR);
			$commande2->bindParam(':prix', $prix, PDO::PARAM_STR);
			$commande2->bindParam(':photo', $photo, PDO::PARAM_STR);
			$commande2->bindParam(':idLoueur', $idLoueur, PDO::PARAM_INT);
			$commande2->execute();

			if ($commande2->rowCount() > 0) {  //compte le nb d'enregistrement
				$nouveauVoiture = $commande2->fetch(PDO::FETCH_ASSOC); //svg du inscrit
				return true;
			}
			else {
				return false;
			}


		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec d'insert : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
		
	}

   // verifier si le type de véhucule existe deja
	function verif_existance_typeVehicule($typeVehicule,&$typeVehiculePresentes){
		require ("connect.php");
		$sql="SELECT * FROM `Vehicule`  where typeVehicule=:typeVehicule"; 
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':typeVehicule', $typeVehicule, PDO::PARAM_STR); 
			$commande->execute();
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$typeVehiculePresentes = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
				return true;
			}
			else {
				return false;
			}
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
		
	}

	//supprimer un nombre de vehicules souhaites selon type de vehicule
	function SupprVoiture($typeVehicule,$nbVehicule, &$SupprimVoiture){
		require ("connect.php") ; 
		$sql3="DELETE FROM `Vehicule` WHERE typeVehicule =:typeVehicule AND location='disponible' AND (nbVehicule -  :nbVehicule ) <=0"; 
		$sql4="UPDATE `Vehicule` SET nbVehicule = nbVehicule - :nbVehicule  WHERE typeVehicule =:typeVehicule AND (nbVehicule -  :nbVehicule ) >0"; 
		
        try{
            
            $commande3 = $pdo->prepare($sql3);
            $commande4 = $pdo->prepare($sql4);
            $commande4->bindParam(':typeVehicule', $typeVehicule, PDO::PARAM_STR); 
            $commande4->bindParam(':nbVehicule', $nbVehicule, PDO::PARAM_STR);
            $commande3->bindParam(':typeVehicule', $typeVehicule, PDO::PARAM_STR); 
            $commande3->bindParam(':nbVehicule', $nbVehicule, PDO::PARAM_STR);
            $commande3->execute();
            $commande4->execute();
                
                if ($commande3->rowCount() > 0) {  //compte le nb d'enregistrement
                    $SupprimVoiture = $commande3->fetch(PDO::FETCH_ASSOC); 
                    return true;
                }
                else {
					if ($commande4->rowCount() > 0) {  //compte le nb d'enregistrement
						$SupprimVoiture = $commande4->fetch(PDO::FETCH_ASSOC); 
						return true;
					}
                    else {
						return false;
					}
                }
                
        
        }
        catch (PDOException $e) {
            echo utf8_encode("Echec Suppression : " . $e->getMessage() . "\n");
            die(); // On arrête tout.
        }
    }
    
?>