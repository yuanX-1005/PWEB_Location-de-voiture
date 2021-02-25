<!doctype html>
<html><head>
  <meta charset="utf-8">
  <title>Connexion Loueur</title>
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
  <link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./vue/styleCSS/style.css"/>
</head>

<body style="background:linear-gradient(white, #D4AF37, white); background-repeat: no-repeat;">

	<nav> 	
		<?php  require ("./vue/menu.tpl"); ?>
	</nav> <!-- fin du menu nav -->


	
	<h3> Connexion Loueur </h3> <!--formulaire pour connexion loue -->

	<form class="formConnexion" action="index.php?controle=loueur&action=connexionLoueur" method="post">

		<div class="élément">Nom</div>
		<input class="container" name="nomLoueur" type="text" value= "<?php echo($nomLoueur); ?>" /><br/><br/>
				 
		<div class="élément">Mot de passe</div><input class="container" name="mdpLoueur"  type="password" value= "<?php echo($mdpLoueur) ?>" /><br/><br/> 
				 
		<input class="button" type= "submit"  value="soumettre">
	</form>

	<div id ="msgErreur"> <?php echo $msg; ?> </div>

</body>
</html>
