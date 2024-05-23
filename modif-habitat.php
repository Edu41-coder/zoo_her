<?php
// Fichier de BDD
require 'verification_connexion.php';

if ($role != "admin") {
    header('Location: liste_habitat.php');
}

// On récupère les données depuis le formulaire
$id = $_POST["id"];
$nom = $_POST["nom"];
$description = $_POST["description"];
/* $commentaire = $_POST["commentaire"]; */

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

/* $requete="UPDATE habitat SET nom='$nom', description= '$description', commentaire_habitat= '$commentaire' WHERE habitat_id='$id'"; */
$requete="UPDATE habitat SET nom='$nom', description= '$description' WHERE habitat_id='$id'";
$exe = $bdd->query($requete);

header('Location: liste_habitat.php?message=modifOk');