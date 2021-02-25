<?php 
	$no=htmlspecialchars($nom); 
	$nu=htmlspecialchars($mdp); 
	$em=htmlspecialchars($email);
?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>inscription Particulier</title>
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
	<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
</head>

<body style="background:linear-gradient(white,#D4AF37, white); background-repeat: no-repeat;">
	<nav> 	
		<?php  require ("./vue/menu.tpl"); ?>
	</nav> <!-- fin du menu nav -->
	
	<h3> Formulaire d'inscription </h3>  <!--formulaire de l'inscription d'un entreprise-->

	<form class="formConnexion" action="index.php?controle=entreprise&action=inscriptEntrep" method="post">
	
		<div class="élément">Nom</div>
		<input class="container" name="nom" type="text" placeholder="Ex Zozor" required value= "<?php echo($no); ?>" />
		
		<div class="élément">Matricule</div>
		<input class="container" name="mdp" type="password" placeholder="Ex 13abY59G" required value= "<?php echo($nu) ?>" />
		
		<div class="élément">Email</div>
		<input class="container" name="email" type="text" placeholder="Ex YanBili@gmail.com" required value= "<?php echo($em) ?>" /><br/><br/> 
		
		<input class="button" type= "submit"  value="je m'inscris">
	</form>

	<div id ="msgErreur"> <?php echo $msg; ?> </div> 


</body>
</html>