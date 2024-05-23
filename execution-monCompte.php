<?php
require('verification_connexion.php');
$page = 'compte';

$type = $_POST["typeForm"];

if ($type == "horaires") {
	$debut = $_POST["heureDebut"];
	$fin = $_POST["heureFin"];

	$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
	$requete="UPDATE settings SET donnee = :debut WHERE nom = 'ouvertureZoo'";
	$requete2="UPDATE settings SET donnee = :fin WHERE nom = 'fermetureZoo'";
	$requetePrepare = $bdd->prepare($requete);
	$requetePrepare->bindParam(':debut', $debut);
	$requetePrepare->execute();
	$requetePrepare2 = $bdd->prepare($requete2);
	$requetePrepare2->bindParam(':fin', $fin);
	$requetePrepare2->execute();

	header('Location: monCompte.php?message=modifHorairesOk');
} else {
	header('Location: monCompte.php?message=erreurDansEnvoiFormulaire');
}
