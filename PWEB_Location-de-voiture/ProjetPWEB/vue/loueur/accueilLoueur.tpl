<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>accueil du loueur</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>
	<body>
	
	<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			<button class="btn btn-outline-success" type="button"><a href='index.php?controle=entreprise&action=accueil' title='action connexionEntrp du controleur entreprise'>
				Déconnecter</a></button>
			</form>
		</nav>
	</nav>

	<br/><br/><br/>

		<h2>Bienvenue M. <?php echo ($nomLoueur) ?> </h2>
		<br/>
		
		<h4 style="text-align:center">Operations sur les vehicules<h4>
		<div id="opération">
			<div>
			<form action="index.php?controle=operationLoueur&action=ajouterVoiture&idL=<?php echo($_SESSION['profilLoueur']['idLoueur']);?>" method="post">
				<input class="button" type="submit" style="background-color: #D4AF37;" value="Ajouter une  voiture">
			</form>
			</div>
			<div>
			<form action="index.php?controle=operationLoueur&action=SuppVoiture&idL=<?php echo($_SESSION['profilLoueur']['idLoueur']);?>" method="post">
				<input class="button" type="submit" style="background-color: #D4AF37;" value="Supprimer une voiture">
			</form>
			</div>
		</div>

		</br>
		
		<table class="tableauVoitureClient" border="3" <?php if(!$flag) echo ("style=\"display:none\"");?>>
			
			<h4>Voitures en stock</h4> <!-- les voitures en stock-->
			
			<?php foreach($_SESSION['ListeVoitureStock'] as $v){
				$json=$v['caract'];
				$caracts = array();
				$caracts = (json_decode($json, true));
			?>
			
			<tr id = <?php echo($v['idVehicule']); ?> > 
				<th rowspan="6"><img width="250" height="150" src=<?php echo($v['photo']);?>> </th>
				<td colspan = "2">ID de Vehicule : <?php echo($v['idVehicule']); ?></td>
			</tr>
			<tr><td colspan = "2">type de Vehicule : <?php echo($v['typeVehicule']); ?></td>
			</tr>
			<tr>
				<td colspan = "2">Nombre de vehicule : <?php echo($v['nbVehicule']); ?></td>
			</tr>
			<tr>
				<th rowspan ="3">Caracteres :</th>
				<td col>Places : <?php echo ($caracts['places']);?></td>
			</tr>
			<tr>
				<td>Moteur : <?php echo ($caracts['moteur']);?></td> </tr>
			<tr><td>Vitesse : <?php echo ($caracts['vitesse']);?></td>
			</tr>
			<?php }?>
			
		</table>
		
			
		
		<div id ="msgErreur"> <?php echo $msg; ?> </div>
		
		<br/><br/><br/><br/> <!-- les voitures deja loué-->
		
		<table class="tableauVoitureClient" border="3" <?php if(!$flag2) echo ("style=\"display:none\"");?>>
			<h4>Voitures louées</h4>
			<?php 
			$cpt=0;$nb=2;$voitures = $_SESSION['ListeVoitureLoué'];
			foreach($_SESSION['nombreVoitureId'] as $nbVoitures){
			?>
				<tr>
					<th rowspan ="<?php echo($nb*$nbVoitures[1]); ?>">client : <?php echo($voitures[$cpt]['idClient']); ?> 
					</th>
					<th rowspan ="<?php echo($nb*$nbVoitures[1]); ?>"><a class="btn btn-primary" href="index.php?controle=facturation&action=LigneFacturation&idE=<?php echo($voitures[$cpt]['idClient']); ?>&idL=<?php echo($idL);?>" role="button">Facturation</a></th>
					<?php for($i=0; $i<$nbVoitures[1]; $i++, $cpt++){ ?>
					<th rowspan="2"><img width="250" height="150" src=<?php echo($voitures[$cpt]['photo']);?>> </th>
					<td>Type de Vehicule : <?php echo($voitures[$cpt]['typeVehicule']); ?></td>
					
					
				</tr>
				<tr>
					<td>Nombre de vehicule :<?php echo($voitures[$cpt]['nbVehicule']); ?></td>
				</tr>
				
				<?php } 
			}?>
		</table>

		
	</body>
</html>