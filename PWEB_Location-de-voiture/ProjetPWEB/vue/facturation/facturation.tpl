<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>facturation</title>
		<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet"> <!--police d'écriture-->
		<link rel = "stylesheet" href = "./vue/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vue/styleCSS/style.css"/>
	</head>
	<body>

	<nav>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href='index.php' title='index.php sans paramètre'>Home</a>
			<form class="form-inline">
			    <button class="btn btn-outline-success" type="button"><a href='index.php?controle=entreprise&action=accueilEntrep&idE=<?php echo($idE);?>' title='action facturation du controleur entreprise'>
				Accueil</a></button>			
			</form>
		</nav>
	</nav>
	
	<br/><br/><br/>
        		
	<div class="formConnexion">
        <h5>Facture n°<?php echo($infosFacturation['idFacturation']);?></h3>

        <div class="info">
            <h2>Client :  <?php echo ($infosEntreprise['nom']) ?> </h2>
            <img width="200" height="100" src=<?php echo($infosVehicule['photo']);?>>
            <p>Voiture louée depuis le <?php echo($infosFacturation['dateDebut']);?>.</p>
            <p>Prix de la voiture "<?php echo($infosVehicule['typeVehicule']); ?>" par jour est de <?php echo($infosVehicule['prix']);?> euros.</p>
            <p>Vous avez loué <?php echo($nbVehicule);?> vehicules pendant <?php echo($nbjours);?> jours.</p>
			<p>Le montant du mois courant est de <?php echo($infosFacturation['valeur']); ?> euros</p>
		</div>
		<div class="recap">
			<h2 style="float:left;">Recapitulatif : </h2>
			<p style="float:right">Etat de payement : <?php if($infosFacturation['etat']==true) echo("Payé"); else echo("Non payé"); ?></p>
			<table>
				<tr>
					<th>Qté</th>
					<th>Description</th>
					<th>Prix /j</th>
					<th>Montant</th>
				</tr>
				<tr>
					<td><?php echo($nbVehicule); ?></td>
					<td><ul>
						<li>Id : <?php echo($infosVehicule['idVehicule']); ?></li>
						<li>Type : <?php echo($infosVehicule['typeVehicule']); ?></li>
						<li>Date début : <?php echo($infosFacturation['dateDebut']); ?></li>
						<li>Date fin : <?php if($flagF) echo($infosFacturation['dateFin']); else echo("indefini(payement mensuelle -> 30jours)");?></li>
					</ul></td>
					<td><?php echo($infosVehicule['prix']); ?>€</td>
					<td><?php echo($infosFacturation['valeur']); ?>€</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>Total : </td>
					<th> <?php echo($infosFacturation['valeur']); ?>€</th>
				</tr>
			</table>
		</div>
	</div>

	<div id ="msgErreur"> <?php echo $msg; ?> </div> 
		
	</body>
</html>