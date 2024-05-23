<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

// On récupère les données depuis le formulaire
$nom = $_POST["nom"];
$description = $_POST["description"];
/* $commentaire = $_POST["commentaire_habitat"]; */
$commentaire = "";

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

require('uploadimage.php');
if (empty($erreurImage) == false) {
	header('Location: liste_habitat.php?message=' . $erreurImage);
} else {
	$requete = 'INSERT INTO habitat (nom, description, commentaire_habitat) VALUES (:nom, :description, :commentaire)';
	$requetePrepare = $bdd->prepare($requete);
	$requetePrepare->bindParam(':nom', $nom);
	$requetePrepare->bindParam(':description', $description);
	$requetePrepare->bindParam(':commentaire', $commentaire);
	$requetePrepare->execute();


	$idAjoutHabitat = $bdd->lastInsertId();

	$requete2 = "INSERT INTO image (image_data) VALUES (:cible)";
	$requetePrepare = $bdd->prepare($requete2);
	$requetePrepare->bindParam(':cible', $cible);
	$requetePrepare->execute();

	$idAjoutImage = $bdd->lastInsertId();

	$requete3 = "INSERT INTO assoimage_habitat (habitat_id, image_id) VALUES (:idAjoutHabitat, :idAjoutImage)";
	$requetePrepare3 = $bdd->prepare($requete3);
	$requetePrepare3->bindParam(':idAjoutHabitat', $idAjoutHabitat);
	$requetePrepare3->bindParam(':idAjoutImage', $idAjoutImage);
	$requetePrepare3->execute();

	header('Location: liste_habitat.php?message=ajoutOk');
}