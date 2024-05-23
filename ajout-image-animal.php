<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

// Page du site actuelle
$page = "habitat";

// On récupère les données depuis le formulaire
$idAjoutAnimal = $_POST["id"];

require('uploadimage.php');
if (empty($erreurImage) == false) {
	header('Location: liste_habitat.php?message=' . $erreurImage);
} else {
	$requete2 = "INSERT INTO image (image_data) VALUES (:cible)";
	$requetePrepare2 = $bdd->prepare($requete2);
	$requetePrepare2->bindParam(':cible', $cible);
	$requetePrepare2->execute();
	$idAjoutImage = $bdd->lastInsertId();

	$requete3 = "INSERT INTO assoimage_animal (animal_id, image_id) VALUES (:idAjoutAnimal, :idAjoutImage)";
	$requetePrepare3 = $bdd->prepare($requete3);
	$requetePrepare3->bindParam(':idAjoutAnimal', $idAjoutAnimal);
	$requetePrepare3->bindParam('idAjoutImage', $idAjoutImage);
	$requetePrepare3->execute();

	header('Location: detail_animal.php?message=ajoutOk&id=' . $idAjoutAnimal);
}
