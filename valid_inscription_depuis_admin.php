<?php
    require('verification_connexion.php');

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$role = $_POST['role'];
if ($role == 1 || $role == 4) {
	// Le rôle est bon

	if (strlen($password) > 9) {
		$requete = 'SELECT * FROM utilisateur WHERE username = "' . $pseudo .'"';
    	$exe = $bdd->query($requete);
    	$nbReponses = $exe->rowCount();

    	if ($nbReponses > 0) {
    		header('Location: monCompte.php?message=erreur1');
    	} else {
    		$requete2 = 'INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES ("' . $pseudo .'", "' . $password .'", "", "", ' . $role .')';
    		$exe = $bdd->query($requete2);

    		$mailDelivreur = "hehermosilla@gmail.com";
			$nom = "ZOO Arcadia";
			$subject = "Inscription au ZOO Arcadia";
			$message = "Bienvenue sur le ZOO Arcadia !\n\n
						Votre nom d'utilisateur est votre email.\n\n
						Rapprochez-vous de l'administrateur du site pour obtenir votre mot de passe.";
			$headers   = [
			    'MIME-Version' => 'MIME-Version: 1.0',
			    'Content-type' => 'text/plain; charset=UTF-8',
			    'From' => "{$nom} <{$mailDelivreur}>",
			    'X-Mailer' => 'PHP/' . phpversion(),
			];
			$mailEnvoi = mail($pseudo, $subject, $message, $headers);

    		header('Location: monCompte.php?message=ok');
    	}
	} else {
		header('Location: monCompte.php?message=erreur2');
	}
} else {
	header('Location: monCompte.php?message=erreur3');
}