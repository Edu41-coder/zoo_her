<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

if ($role != "admin" && $role != "employe") {
    header('Location: liste_service.php');
}

// On récupère les données depuis le formulaire
$id = $_POST["id"];
$nom = $_POST["nom"];
$description = $_POST["description"];

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

$requete="UPDATE service SET nom='$nom', description= '$description' WHERE service_id='$id'";
$exe = $bdd->query($requete);

header('Location: liste_service.php?message=modifOk');