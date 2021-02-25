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
				Retourne</a></button>
			</form>
		</nav>
	</nav>
	
	<br/><br/><br/>

	<h3>Ajouter Voitures</h3> <!-- ajouter les voitures en stock-->

	<form class="formConnexion" action="index.php?controle=operationLoueur&action=ajouterVoiture&idL=<?php echo($_SESSION['profilLoueur']['idLoueur']);?>" method="post" enctype="multipart/form-data" >
		  <div class="form-group">
			<label for="formGroupExampleInput">Type vehicule</label>
			<input type="text" class="form-control" id="formGroupExampleInput" name="typeVehicule" placeholder="Ex: Clio" value= "<?php echo($typeVehicule) ?>"/>
		  </div>
		  <div class="form-group">
			<label for="formGroupExampleInput2">Nb Vehicule</label>
			<input type="text" class="form-control" id="formGroupExampleInput2" name="nbVehicule" placeholder="Ex: 5" value= "<?php echo($nbVehicule) ?>"/>
		  </div>
		  <div class="form-group">
			<label for="formGroupExampleInput2">Prix par jour</label>
			<input type="text" class="form-control" id="formGroupExampleInput2" name="prix" placeholder="Ex: 13" value= "<?php echo($prix) ?>"/>
		  </div>
		  <div class="form-group">
			  <div class="row">
			  <label for="formGroupExampleInput">caracteres:</label>
				<div class="col">
					<label for="formGroupExampleInput">- moteur</label>
				  <input type="text" class="form-control"  name="moteur" placeholder="Ex: hybride" value= "<?php echo($moteur) ?>"/>
				</div>
				<div class="col">
					<label for="formGroupExampleInput">- vitesse</label>
					<input type="text" class="form-control" name="vitesse" placeholder="Ex: automatique" value= "<?php echo($vitesse) ?>"/>
				</div>
				<div class="col">
					<label for="formGroupExampleInput">- places</label>
					<input type="text" class="form-control"  name="places" placeholder="Ex: 5" value= "<?php echo($places) ?>"/>
				</div>
			  </div>
			  </div>
			   <div class="form-group">
				<label for="exampleFormControlFile1">images input</label>
				<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" />
			  </div>
			<button type="submit" class="btn btn-primary">Submit</button>

		</form>

		<div id ="msgErreur"> <?php echo $msg; ?> </div>
		
		
	</body>
</html>