<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Page Accueil</title>
	  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@1,600&display=swap" rel="stylesheet"><!--police d'écriture-->
	  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet">
	  <link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>

	<body>
		<nav style="margin-top: -80px;"> 	
			<?php  require ("./vue/menu.tpl"); ?>
		</nav>  <!-- fin du menu nav -->

		<header class ="head"> 
			<h1> Location de voiture</h1>
		</header>
		
		<div id="voiture"> <!-- metter decoder les caracteres de vehicules-->
		<?php foreach($_SESSION['infoVoiture'] as $v){   
			$json=$v['caract']; 
			$caracts = array();
			$caracts = (json_decode($json, true)); #decode le caracteres de voiture	
		?>
			<div id="voitureDisp">
				<div class="typeV"><h6><?php echo($v['typeVehicule']);?></h6></div>
				<div>Nombre de vehicule disponible : <?php echo($v['nbVehicule']); ?></div>
				<div>Prix/jour : <?php echo($v['prix']); ?> </div>
				<div><img width="350" height="200" src=<?php echo($v['photo']);?>></div>
				<div class="carac">
					<ul>Moteur : <?php echo ($caracts['moteur']);?></ul>
					<ul>Vitesse : <?php echo ($caracts['vitesse']);?></ul>
					<ul>Places : <?php echo ($caracts['places']);?></ul>
					<br/>
					<ul><a class="btn btn-outline-primary" href='<?php if(isset($_GET['idE'])){
						$idE = $_GET['idE'];
						$idVehicule = $v['idVehicule'];
						echo("index.php?controle=operationEntreprise&action=louerVoiture&idE=$idE&idV=$idVehicule");}
						else{
							echo("index.php?controle=entreprise&action=connexionEntrp");} 
						?>' role="button">Louer</a></ul>
				</div>
			</div>
			
		
		<?php } ?> 

		</div>
	</body>
</html>
