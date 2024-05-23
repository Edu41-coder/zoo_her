<?php
    session_start();
    include('config.inc.php');


    $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
    $requete = 'SELECT * FROM utilisateur WHERE username = "' . $_POST['pseudo'].'"';
    $exe = $bdd->query($requete);
    $nbreponses = $exe->rowCount();

	if ($nbreponses == 1){
	    $user = $exe->fetch();
	    if ($_POST['password'] == $user['password']) {
	        $_SESSION['utilisateur'] = $user['username'];
	        header('Location: index.php?message=connexionOk');
	    } else {
	        header('Location: connexion.php?connexionKo1');
	    }
	} else {
	    header('Location: connexion.php?connexionKo2');
	}