<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

if ($role != "admin") {
    header('Location: liste_service.php');
}

// On récupère les données depuis le formulaire
$nom = $_POST["nom"];
$description = $_POST["description"];

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

$requete = 'INSERT INTO service (nom, description) VALUES (:nom, :description)';
$requetePrepare = $bdd->prepare($requete);
$requetePrepare->bindParam(':nom', $nom);
$requetePrepare->bindParam(':description', $description);
$requetePrepare->execute();

header('Location: liste_service.php?message=ajoutOk');