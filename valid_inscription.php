<?php

include('config.inc.php');

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];

if ($role == 1 || $role == 4) {
	// Le rôle est bon

	if (strlen($password) > 9) {
		// Le mot de passe est juste
		try {
		    $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
		    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		    echo 'Erreur de connexion : ' . $e->getMessage();
		}
		
		$requete = 'SELECT * FROM utilisateur WHERE username = "' . $pseudo .'"';
    	$exe = $bdd->query($requete);
    	$nbReponses = $exe->rowCount();

    	if ($nbReponses > 0) {
    		header('Location: inscription.php?message=erreur1');
    	} else {
    		$requete2 = 'INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES ("' . $pseudo .'", "' . $password .'", "' . $nom .'", "' . $prenom .'", ' . $role .')';
    		$exe = $bdd->query($requete2);

    		header('Location: connexion.php?message=ok');
    	}
	} else {
		header('Location: inscription.php?message=erreur2');
	}
} else {
	header('Location: inscription.php?message=erreur3');
}