<?php
	$message = $_GET['message'];
	// Page du site actuelle
	$page = "service";
	require 'verification_connexion_simple.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des services</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
		include("menu.php");
		if ($message == 'ajoutOk') {
			echo('<div class="messageHautDePage">Le service vient d\'être ajouté.</div>');
		} else if ($message == 'supprOk') {
			echo('<div class="messageHautDePage">Le service vient d\'être supprimé.</div>');
		} else if ($message == 'modifOk') {
			echo('<div class="messageHautDePage">Le service vient d\'être modifié.</div>');
		}
	?>
	<div class="container">
		<h1>Liste des services</h1>
		<?php if ($role == "admin") { ?>
		<div class="divDebut">
			<button type="button" class="btn btn-success btn-lg"><a class="lien" href="ajouter_service.php">Ajouter un service</a></button>
		</div>
 <?php
    }

	$requete = 'SELECT * FROM service';
	$exe = $bdd->query($requete);

	if ($exe) {
	    $resultats = $exe->fetchAll(PDO::FETCH_ASSOC);

	    ?>
	    <table class="table table-striped mt10perso">
			  <thead>
			    <tr>
			      <th scope="col">Nom</th>
			      <th scope="col">Description</th>
			      <?php
		    		if ($role == "admin") { 
		    			?>
		    				<th>Modifier</th>
				      	<th>Supprimer</th>
		    			<?php
		    		} else if ($role == "employe") { 
		    			?>
		    				<th>Modifier</th>
		    			<?php
		    		} 
		    		?>
			    </tr>
			  </thead>
			  <tbody>
	    <?php

	    foreach ($resultats as $ligne) {
	    	?>
			    <tr>
			      <td><?php echo($ligne["nom"]);  ?></td>
			      <td><?php echo($ligne["description"]);  ?></td>
	    	<?php
	    		if ($role == "admin") { 
	    			?>
	    			<td><a href='modif_service.php?id=<?php echo($ligne["service_id"]); ?>&nom=<?php echo($ligne["nom"]); ?>&description=<?php echo($ligne["description"]); ?>' ><i class="fa-solid fa-pen"></i></a></td>
			      	<td><a href='suppr_service.php?id=<?php echo($ligne["service_id"]); ?>' ><i class="fa-solid fa-trash"></i></a></td>
	    			<?php
	    		} else if ($role == "employe") {
	    			?>
	    				<td><a href='modif_service.php?id=<?php echo($ligne["service_id"]); ?>&nom=<?php echo($ligne["nom"]); ?>&description=<?php echo($ligne["description"]); ?>' ><i class="fa-solid fa-pen"></i></a></td>
	    			<?php
	    		}
	    		?></tr><?php
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