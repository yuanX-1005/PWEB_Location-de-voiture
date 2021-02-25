<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Ajouter Voiture au Panier</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>
	<body style="background:linear-gradient(white,#D4AF37, white); background-repeat: no-repeat;">
	<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			<button class="btn btn-outline-success" type="button"><a href='index.php?controle=entreprise&action=accueil&idE=<?php echo($_SESSION['profil']['idClient']);?>' title='action louerVoiture du controleur entreprise'>
				Retourne</a></button> <!--retourne en page precedente-->
			</form>
		</nav>
	</nav>
	
	<br/><br/><br/>
	<h3> Louer Voiture </h3> <!-- formulaire pour louer voitures-->

	<form class="formConnexion" action="index.php?controle=operationEntreprise&action=louerVoiture&idE=<?php echo($idE);?>&idV=<?php echo($idV); ?>" method="post">
		<div class="form-group">
			<label for="formGroupExampleInput">Date début: </label>
			<input type="date" class="form-control" id="formGroupExampleInput" name="dateDebut" />
		</div>
		<div class="form-group">
			<label for="formGroupExampleInput">Date fin: </label>
			<input type="date" class="form-control" id="formGroupExampleInput" name="dateFin" />
		</div>
		<div class="form-group">
			<label for="formGroupExampleInput2">Nb Vehicule</label>
			<input type="text" class="form-control" id="formGroupExampleInput2" name="nbVehicule" placeholder="Ex: 5" value= "<?php echo($nbVehicule) ?>"/>
		</div>
		<input type="submit" class="btn btn-primary" style="background-color:#D4AF37!important; color:white!important;" name="payement" value="Payer Directe" >
		<input type="submit" class="btn btn-primary" style="background-color: white!important; color:#D4AF37!important; " name="payement" value="Payer Plus tard" >
	</form>

	<div id ="msgErreur"> <?php echo $msg; ?> </div>

	</body>
</html>