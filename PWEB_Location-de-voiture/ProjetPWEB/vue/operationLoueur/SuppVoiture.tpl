<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>accueil du loueur</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>

	<body style="background:linear-gradient(white, #D4AF37, white); background-repeat: no-repeat;">
	
		<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			<button class="btn btn-outline-success" type="button"><a href='index.php?controle=loueur&action=accueilLoueur&idL=<?php echo($_SESSION['profilLoueur']['idLoueur']);?>' title='action connexionEntrp du controleur entreprise'>
				Retourn</a></button>
			</form>
		</nav>
	</nav>

	<br/><br/><br/>

	<h3>Supprimer Voitures</h3> <!--formulaire pour supprimer les voitures en stock -->

	<form class="formConnexion" action="index.php?controle=operationLoueur&action=SuppVoiture&idL=<?php echo($_SESSION['profilLoueur']['idLoueur']);?>" method="post" enctype="multipart/form-data" >
		  <div class="form-group">
			<label for="formGroupExampleInput">Type vehicule</label>
			<input type="text" class="form-control" id="formGroupExampleInput" name="typeVehicule" placeholder="Ex: Clio" value= "<?php echo($typeVehicule) ?>" required />
		  </div>
		  
		   <!-- A PRENDRE   -->
		  <div class="form-group">
			<label for="formGroupExampleInput2">Nombre de Véhicule</label>
			<input type="text" class="form-control" id="formGroupExampleInput2" name="nbVehicule" placeholder="Ex: 5" value= "<?php echo($nbVehicule) ?>"/>
		  </div>
		  
			 <button type="submit" class="btn btn-primary">Submit</button>

		</form>
		
		<div id ="msgErreur"> <?php echo $msg; ?> </div>

	</body>
</html>