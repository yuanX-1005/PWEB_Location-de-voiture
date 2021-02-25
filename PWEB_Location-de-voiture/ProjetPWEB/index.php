<?php session_start();

//entre de site
if (isset($_GET['controle']) & isset($_GET['action'])) {
 	$controle = $_GET['controle'];
	$action= $_GET['action'];
	}
else { 
	$controle = "entreprise";
	$action= "accueil";
	}

	require ('./controle/' . $controle . '.php');   
	$action (); 
?>
