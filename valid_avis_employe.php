<?php
// Fichier de BDD
include('config.inc.php');
require 'verification_connexion.php';

if ($role != "employe") {
    header('Location: liste_service.php');
}

$id = $_GET["id"];

$requete = 'UPDATE avis SET isvisible = 1 WHERE avis_id = ' . $id;
$exe = $bdd->query($requete);

header('Location: monCompte.php?message=avisValide');