<?php

include('config.inc.php');

$pseudo = $_POST['pseudoAvis'];
$avis = $_POST['messageAvis'];


$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

$requete = 'INSERT INTO avis (pseudo, commentaire, isvisible) VALUES ("' . $pseudo .'", "' . $avis .'", FALSE)';
$exe = $bdd->query($requete);

if ($exe) {
	header('Location: formulaire_contact.php?message=okAvis');
} else {
	header('Location: formulaire_contact.php?message=avisKo');
}
