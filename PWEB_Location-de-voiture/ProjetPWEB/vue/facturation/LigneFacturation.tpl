<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>facturation par client</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>
	<body>

	<!--navbar -->
	<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			    <button class="btn btn-outline-success" type="button"><a href='index.php?controle=loueur&action=accueilLoueur&idL=$idL'
					title='action facturation du controleur entreprise'>
				Accueil</a></button>			
			</form>
		</nav>
	</nav>
	
	<br/><br/><br/>
        		
	<div class="formConnexion"> <!--facturation par client -->
        <h5>Facturation de Client n°<?php echo($idE);?></h3>

			<div class="info">
				<h2>Client :  <?php echo ($infosEntreprise['nom']) ?> </h2>
			</div>

			<?php foreach($ListInfosVoitures as $v){ ?> <!--afficher images de vehicules-->
				<img width="200" height="100" src=<?php echo($v['photo']);?>>
			<?php }?>

		<div class="recap"> <!--infos facturation -->
			<h2 style="float:left;">Recapitulatif : </h2>
			
			<table>
				<tr>
					<th>Qté</th>
					<th>Description</th>
					<th>Prix /j</th>
					<th>Montant (de ce mois)</th>
					<th>Payement</th>
				</tr>

				<?php for($i=0; $i<count($infosFacturationParEntreprise,0); $i++){ ?> <!--liste de véhicules-->
					<tr>
						<td><?php echo($ListInfosVoitures[$i]['nbVehicule']); ?></td>
						<td><ul>
							<li>Id Vehicule: <?php echo($ListInfosVoitures[$i]['idVehicule']); ?></li>
							<li>Type : <?php echo($ListInfosVoitures[$i]['typeVehicule']); ?></li>
							<li>Date début : <?php echo($infosFacturationParEntreprise[$i]['dateDebut']); ?></li>
							<li>Date fin : <?php if($ListeEtatDateFin[$i]) echo($infosFacturationParEntreprise[$i]['dateFin']); else echo(" indefini (payement mensuelle = 30jours)");?></li>
						</ul></td>
						<td><?php echo($ListInfosVoitures[$i]['prix']); ?>€</td>
						<td><?php echo($infosFacturationParEntreprise[$i]['valeur']); ?>€</td>
						<td><?php if($infosFacturationParEntreprise[$i]['etat']==true) echo("Payé"); else echo("Non payé"); ?></td>
					</tr>
				<?php }?>
			</table>
			<br/>
			<table> <!-- les montants -->
				<tr>
					<th>Montant total</th>
					<th>Montant payé</th>
					<th>Montant non payé</th>
				</tr>
				<tr>
					<td><?php echo($Montant_total); ?></td>
					<td><?php echo($MontantPaye); ?></td>
					<td><?php echo($MontantNonPaye); ?></td>
				</tr>
			</table>
		</div>
	</div>
			
	<div id ="msgErreur"> <?php echo $msg; ?> </div>

	
	</body>
</html>