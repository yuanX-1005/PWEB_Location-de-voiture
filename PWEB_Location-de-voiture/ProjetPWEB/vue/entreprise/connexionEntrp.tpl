<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Connexion Particulier</title>
   <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
  <link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./vue/styleCSS/style.css"/>
</head>

<body style="background:linear-gradient(white,#D4AF37, white); background-repeat: no-repeat;">
	<nav>
		<?php  require ("./vue/menu.tpl"); ?>	
	</nav>    <!-- fin du menu nav -->

	<h3> Connexion Entreprise </h3> <!-- formulaire pouer la connexion d'un entreprise-->

	<form class="formConnexion" action="index.php?controle=entreprise&action=connexionEntrp" method="post">

		<div class="élément">Nom</div><input class="container"	name="nom" 	type="text" value= "<?php echo($nom); ?>" /><br/><br/>
				 
		<div class="élément">Mot de passe</div><input class="container" name="mdp"  type="password" value= "<?php echo($mdp) ?>" /><br/><br/> 
				 
		<input class="button" type= "submit"  value="soumettre">
	</form>

	<!-- aller sur la page d'inscription-->
	<form class="formConnexion" action="index.php?controle=entreprise&action=inscriptEntrep" method="post">
	<div class="inscription_text">Si vous n'avez pas de compte, veuillez vous inscrire : </div>
	<input class="button" type= "submit"  value="je m'inscris">
	</form> 

	<div id ="msgErreur"> <?php echo $msg; ?> </div> 


</body></html>
