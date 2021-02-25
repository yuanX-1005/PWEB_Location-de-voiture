<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>accueil de l'entreprise</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
			<!-- 	<script src="script.js"></script>	-->
	</head>
	<body>

	<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			<button class="btn btn-outline-success" type="button"><a href='index.php?controle=entreprise&action=accueil&idE=<?php echo($_SESSION['profil']['idClient']); ?>' title='action connexionEntrp du controleur entreprise'>
				Louer Voitures</a></button>	
			<button class="btn btn-outline-success" type="button"><a href='index.php?controle=entreprise&action=accueil' title='action connexionEntrp du controleur entreprise'>
				Déconnecter</a></button>
			</form>
		</nav>
	</nav>
	
	<br/><br/><br/>
		<h2>Bienvenue M. <?php echo ($nom) ?> </h2>
		
		<table class="tableauVoitureClient" border="3" <?php if(!$flag) echo ("style=\"display:none\"");?>>
		<h4>Les voitures que vous avez loué</h4>
		<!-- boucle pour affichier toutes les flottes de voitures loue par un entreprise-->
			<?php $voiture =$_SESSION['ListeVoitureLocat']; $facture = $_SESSION['ListFacturationEntrep']; 
			for($i = 0; $i < count($voiture); $i++){
			
			?>
			<tr>
				<th rowspan="4"><img width="200" height="100" src=<?php echo($voiture[$i]['photo']);?>> </th>
				<td>ID de Vehicule : <?php echo($voiture[$i]['idVehicule']); ?></td>
				<th rowspan="4"><a class="btn btn-primary" href="index.php?controle=facturation&action=facturation&idE=<?php echo($idE); ?>&idV=<?php echo($voiture[$i]['idVehicule']); ?>&idF=<?php echo($facture[$i]['idFacturation']); ?>" role="button">Facturation</a></th>
			</tr>
			<tr><td>Type de Vehicule : <?php echo($voiture[$i]['typeVehicule']); ?></td></tr>
			<tr><td>Date de débute : <?php echo($voiture[$i]['dateDebut']); ?></td></tr>
			<tr><td>Date de fin : <?php echo($voiture[$i]['dateFin']); ?></td></tr>
			
			<?php  }?>
		
		</table>
		
		<div id ="msgErreur"> <?php echo $msg; ?> </div>

	</body>
</html>