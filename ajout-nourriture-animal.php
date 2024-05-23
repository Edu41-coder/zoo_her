<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

// On récupère les données depuis le formulaire
$animal_id = $_POST["id"];
$nourriture = $_POST["nourriture"];
$quantite = $_POST["quantite"];
$date = $_POST["date"];
$heure = $_POST["heure"];

$requete = 'INSERT INTO nourriture_animal (date, nourriture, heure, quantite, animal_id) VALUES ("' . $date .'", "' . $nourriture .'", "' . $heure .'",  "' . $quantite .'",  "' . $animal_id .'")';
$exe = $bdd->query($requete);

header('Location: liste_habitat.php?message=ajoutNourritureOk');