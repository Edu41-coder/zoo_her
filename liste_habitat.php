<?php
	$message = $_GET['message'];
	// Page du site actuelle
	$page = "habitat";
	require 'verification_connexion_simple.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des habitats</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
		include("menu.php");
		if ($message == 'ajoutOk') {
			echo('<div class="messageHautDePage">L\'habitat d\'être ajouté.</div>');
		} else if ($message == 'supprOk') {
			echo('<div class="messageHautDePage">L\'habitat vient d\'être supprimé.</div>');
		} else if ($message == 'modifOk') {
			echo('<div class="messageHautDePage">L\'habitat vient d\'être modifié.</div>');
		} else if ($message == 'supprKo') {
			echo('<div class="messageHautDePage">L\'habitat ne peut pas être supprimé car au moins un animal vit dedans.</div>');
		} else if ($message == 'commentaireOk') {
			echo('<div class="messageHautDePage">Un commentaire a été ajouté / modifié sur l\'habitat.</div>');
		} else if ($message == 'ajoutAnimalOk') {
			echo('<div class="messageHautDePage">L\'animal vient d\'être ajouté.</div>');
		} else if ($message == 'supprAnimalOk') {
			echo('<div class="messageHautDePage">L\'animal vient d\'être supprimé.</div>');
		} else if ($message == 'modifAnimalOk') {
			echo('<div class="messageHautDePage">L\'animal vient d\'être modifié.</div>');
		} else if ($message == 'supprAnimalKo') {
			echo('<div class="messageHautDePage">L\'animal n\'a pas pu être supprimé.</div>');
		} else if ($message == 'ajoutNourritureOk') {
			echo('<div class="messageHautDePage">La nourriture vient d\'être ajoutée pour l\'animal</div>');
		} else if ($message == 'ajoutRapportOk') {
			echo('<div class="messageHautDePage">L\'avis vient d\'être créé pour l\'animal</div>');
		} else if ($message == 'erreurImage') {
			echo('<div class="messageHautDePage">Erreur rencontrée lors du téléchargement de l\'image. Veuillez contacter l\'administrateur du site.</div>');
		} else if ($message == 'erreurImageExtension') {
			echo('<div class="messageHautDePage">L\'extension de votre fichier doit être PNG, JPG ou JPEG.</div>');
		} else if ($message == 'champDetailTropLong') {
			echo('<div class="messageHautDePage">Le texte "Détail" est trop long, il doit faire 50 caractères au maximum.</div>');
		} else if ($message == 'champEtatTropLong') {
			echo('<div class="messageHautDePage">Le texte "État" est trop long, il doit faire 50 caractères au maximum.</div>');
		} else if ($message == 'commentaireTropLong') {
			echo('<div class="messageHautDePage">Le commentaire laissé est trop long, il doit faire 50 caractères au maximum.</div>');
		} 
	?>
	<div class="container">
		<h1>Liste des habitats</h1>
		<?php if ($role == "admin") { ?>
		<div class="divDebut">
			<button type="button" class="btn btn-success btn-lg"><a class="lien" href="ajouter_habitat.php">Ajouter un habitat</a></button>
		</div>
 <?php
}
	// On traite les données pour les ajouter en BDD
	$bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

	$requete = 'SELECT * FROM habitat';
	$exe = $bdd->query($requete);

	if ($exe) {
	    $resultats = $exe->fetchAll(PDO::FETCH_ASSOC);

	    ?>
	    <table class="table table-striped mt10perso">
			  <thead>
			    <tr>
			      <th scope="col">Image</th>
			      <th scope="col">Nom</th>
			      <?php
		    		if ($role == "admin") { 
		    			?>
		    			<th>Modifier</th>
				      	<th>Supprimer</th>
		    			<?php
		    		} else if ($role == "veto") {
		    			?>
		    			<th>Écrire un commentaire</th>
		    			<?php
		    		}
		    		?>
		    		<th>Voir le détail de l'habitat</th>
			    </tr>
			  </thead>
			  <tbody>
	    <?php

	    foreach ($resultats as $ligne) {
	    	$requeteImage = "SELECT image.image_data 
							FROM assoimage_habitat 
							LEFT JOIN image ON assoimage_habitat.image_id = image.image_id
							WHERE assoimage_habitat.habitat_id =" . $ligne["habitat_id"];
	    	$exeImage = $bdd->query($requeteImage);
	    	$resultatImage = $exeImage->fetch(PDO::FETCH_ASSOC);
	    	?>
			    <tr>
			      <td><img src="<?php echo($resultatImage["image_data"]);  ?>" alt="Image"></td>
			      <td><?php echo($ligne["nom"]);  ?></td>
		    	<?php
		    		if ($role == "admin") { 
		    			?>
		    			<td><a href='modif_habitat.php?id=<?php echo($ligne["habitat_id"]); ?>&nom=<?php echo($ligne["nom"]); ?>&description=<?php echo($ligne["description"]); ?>&commentaire=<?php echo($ligne["commentaire_habitat"]); ?>' ><i class="fa-solid fa-pen"></i></a></td>
				      	<td><a href='suppr_habitat.php?id=<?php echo($ligne["habitat_id"]); ?>' ><i class="fa-solid fa-trash"></i></a></td>
		    			<?php
		    		} else if ($role == "veto") {
		    			?>
		    			<td><a href='ecrire_commentaire_habitat.php?id=<?php echo($ligne["habitat_id"]); ?>&nom=<?php echo($ligne["nom"]); ?>' ><i class="fa-solid fa-pen-nib"></i></a></td>
		    			<?php
		    		}
		    		?>
		    		<td><a href="detail_habitat.php?id=<?php echo($ligne['habitat_id']); ?>"><i class="fa-solid fa-eye"></i></a></td>
		    		</tr>
		    		<?php
	    }
	    ?>
			  </tbody>
			</table>
	    <?php
	} else {
	    echo "Erreur lors de l'exécution de la requête SQL";
	}
?>
	</div>
	<?php
        include("footer.php");
    ?>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>