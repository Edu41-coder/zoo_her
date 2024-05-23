<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

$id = $_POST["id"];
$commentaire = $_POST["commentaire"];

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

$requete = 'UPDATE habitat SET commentaire_habitat = :commentaire WHERE habitat_id = :id';
$requetePrepare = $bdd->prepare($requete);
$requetePrepare->bindParam(':commentaire', $commentaire);
$requetePrepare->bindParam(':id', $id);
$exe = $requetePrepare->execute();

if ($exe == true) {
	header('Location: liste_habitat.php?message=commentaireOk');
} else {
	header('Location: liste_habitat.php?message=commentaireTropLong');
}
