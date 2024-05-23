<?php
// Fichier de BDD
require 'verification_connexion.php';

if ($role != "admin") {
    header('Location: liste_habitat.php');
}

// On récupère les données depuis le formulaire
$id = $_POST["id"];
$prenom = $_POST["prenom"];
// $etat = $_POST["etat"];
$race = $_POST["race"];
$habitat = $_POST["habitat"];

// On traite les données pour les ajouter en BDD
$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

$requete="UPDATE animal SET prenom='$prenom', race_id= '$race', habitat_id= '$habitat' WHERE animal_id='$id'";
$exe = $bdd->query($requete);

header('Location: liste_habitat.php?message=modifAnimalOk');