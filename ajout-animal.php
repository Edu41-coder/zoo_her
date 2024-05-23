<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

// Page du site actuelle
$page = "habitat";

// On récupère les données depuis le formulaire
$prenom = $_POST["prenom"];
// $etat = $_POST["etat"];
$etat = "";
$race = $_POST["race"];
$habitat = $_POST["habitat"];


// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

require('uploadimage.php');
if (empty($erreurImage) == false) {
	header('Location: liste_habitat.php?message=' . $erreurImage);
} else {
	$requete = 'INSERT INTO animal (prenom, etat, race_id, habitat_id) VALUES (:prenom, :etat, :race, :habitat)';
	$requetePrepare = $bdd->prepare($requete);
	$requetePrepare->bindParam(':prenom', $prenom);
	$requetePrepare->bindParam(':etat', $etat);
	$requetePrepare->bindParam(':race', $race);
	$requetePrepare->bindParam(':habitat', $habitat);
	$requetePrepare->execute();

	$idAjoutAnimal = $bdd->lastInsertId();

	$requete2 = "INSERT INTO image (image_data) VALUES (:cible)";
	$requetePrepare2 = $bdd->prepare($requete2);
	$requetePrepare2->bindParam(':cible', $cible);
	$requetePrepare2->execute();

	$idAjoutImage = $bdd->lastInsertId();

	$requete3 = "INSERT INTO assoimage_animal (animal_id, image_id) VALUES (:idAjoutAnimal, :idAjoutImage)";
	$requetePrepare3 = $bdd->prepare($requete3);
	$requetePrepare3->bindParam(':idAjoutAnimal', $idAjoutAnimal);
	$requetePrepare3->bindParam(':idAjoutImage', $idAjoutImage);
	$requetePrepare3->execute();

	header('Location: liste_habitat.php?message=ajoutAnimalOk');
}
