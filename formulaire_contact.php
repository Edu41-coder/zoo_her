<?php
	include('config.inc.php');
    require 'verification_connexion_simple.php';
	// Page du site actuelle
	$page = "contact";
	$message = $_GET['message'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nous contacter</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
		include("menu.php");
		if ($message == 'mailOk') {
			echo('<div class="messageHautDePage">Merci pour votre prise de contact !</div>');
		} else if ($message == 'mailKo') {
			echo('<div class="messageHautDePage">L\'envoi du mail a échoué, veuillez réessayer.</div>');
		} else if ($message == 'okAvis') {
            echo('<div class="messageHautDePage">Votre avis a été envoyé. Il est soumis à une approbation du ZOO pour la publication.</div>');
        } else if ($message == 'avisKo') {
            echo('<div class="messageHautDePage">Votre avis est trop long, il doit faire 50 caractères au maximum.</div>');
        }
	?>
	<div class="container">
        <h1>Nous contacter</h1>
        <form action="envoiMail2.php" method="post">
            <div class="form-group mt10perso">
                <label for="nom">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom complet" required>
            </div>
            <div class="form-group mt10perso">
                <label for="mail">Mail</label>
                <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" required>
            </div>
            <div class="form-group mt10perso">
                <label for="subject">Sujet</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" required>
            </div>
            <div class="form-group mt10perso">
                <label for="message">Message</label>
                <textarea type="text" class="form-control" id="message" name="message" placeholder="Message" required></textarea>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Envoyer</button>
    </form>
        <h1>Laisser un avis</h1>
        <form action="valid_avis.php" method="post">
            <div class="form-group mt10perso">
                <label for="pseudoAvis">Pseudo</label>
                <input type="text" class="form-control" id="pseudoAvis" name="pseudoAvis" placeholder="Pseudo" required>
            </div>
            <div class="form-group mt10perso">
                <label for="messageAvis">Message</label>
                <textarea type="text" class="form-control" id="messageAvis" name="messageAvis" placeholder="Votre avis" required></textarea>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Envoyer</button>
    </form>
    </div>
	<?php
        include("footer.php");
    ?>
</body>