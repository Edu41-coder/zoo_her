<?php
	$message = $_GET['message'];
	// Page du site actuelle
	$page = "habitat";
	require 'verification_connexion_simple.php';
	$requete = 'SELECT * FROM habitat WHERE habitat_id = ' . $_GET['id'];
	$exe = $bdd->query($requete);

	if ($exe) {
	    $resultats = $exe->fetch(PDO::FETCH_ASSOC);
	}
	$requeteImage = "SELECT image.image_data 
					FROM assoimage_habitat 
					LEFT JOIN image ON assoimage_habitat.image_id = image.image_id
					WHERE assoimage_habitat.habitat_id = :id";
	$requetePrepare = $bdd->prepare($requeteImage);
	$requetePrepare->bindParam(':id', $_GET['id']);
	$requetePrepare->execute();
	$resultatImage = $requetePrepare->fetchAll(PDO::FETCH_ASSOC);

	$requete2 = 'SELECT animal.animal_id, animal.prenom, animal.etat, race.race_id, race.abel, habitat.habitat_id, habitat.nom 
				FROM animal
				LEFT JOIN race ON animal.race_id = race.race_id
				LEFT JOIN habitat ON animal.habitat_id = habitat.habitat_id
				WHERE animal.habitat_id = :id';
	$requetePrepare2 = $bdd->prepare($requete2);
	$requetePrepare2->bindParam(':id', $_GET['id']);
	$requetePrepare2->execute();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détail d'un habitat</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
		include("menu.php");
		$message = $_GET["message"];
        if ($message == 'ajoutOk') {
            echo('<div class="messageHautDePage">L\'image vient d\'être ajoutée avec succès !</div>');
        } 
	?>
	<div class="container">
		<h1>Détail de l'habitat <?php echo $resultats['nom']; ?></h1>
		        <?php if ($role == "admin") { ?>
        <button class="btn btn-success mt10perso"><a class="lien" href="ajout_image_habitat.php?id=<?php echo $_GET['id'];?>&nom=<?php echo $resultats['nom'] ?>">Ajouter une photo à l'habitat</a></button>
    <?php } ?>
		<div id="divHabitatDetail">
			<?php
				foreach ($resultatImage as $value) {
					?>
						<img src="<?php echo($value["image_data"]);  ?>" class="imageHabitatDetail">
					<?php
				}
			?>
			<div>
				<span class="boldSpan">Description de l'habitat :</span>
				<br><?php echo $resultats['description']; ?>
				<?php if ($role == "admin" || $role == "veto" || $role == "employe")  { ?>
					<br><br>
					<span class="boldSpan">Commentaire sur l'habitat :</span>
					<br><?php if (empty($resultats['commentaire_habitat']) == false) { echo $resultats['commentaire_habitat']; } else { echo ("Aucun commentaire sur cet habitat.");} ?>
				<?php } ?>
			</div>
		</div>
		<h1>Animaux présents dans l'habitat <?php echo $resultats['nom']; ?></h1>
				<?php if ($role == "admin") { ?>
		<div class="divDebut">
			<button type="button" class="btn btn-success btn-lg"><a class="lien" href="ajouter_animal.php?id=<?php echo $_GET['id']; ?>">Ajouter un animal</a></button>
		</div>
	<?php
	}

	if ($requetePrepare2) {
	    $resultats2 = $requetePrepare2->fetchAll(PDO::FETCH_ASSOC);

	    if (count($resultats2) > 0) {

	    ?>
	    <table class="table table-striped mt10perso">
			  <thead>
			    <tr>
			      <th scope="col">Image</th>
			      <th scope="col">Prénom</th>
			      <th scope="col">État</th>
			      <th scope="col">Race</th>
			      <th scope="col">Voir l'animal</th>
			      <?php
		    		if ($role == "admin") { 
		    			?>
			      		<th scope="col">Voir les avis du vétérinaire</th>
		    			<th>Modifier</th>
				      	<th>Supprimer</th>
		    			<?php
		    		} else if ($role == "employe") {
		    			?>
		    				<th>Ajouter de la nourriture</th>
		    			<?php
		    		} else if ($role == "veto") {
		    			?>
		    				<th>Consulter la nourriture donnée</th>
		    				<th>Laisser un avis sur l'animal</th>
		    			<?php
		    		}
		    	   ?>
			    </tr>
			  </thead>
			  <tbody>
	    <?php
	    foreach ($resultats2 as $ligne) {
	    		$requeteImageAnimal = "SELECT image.image_data 
					FROM assoimage_animal 
					LEFT JOIN image ON assoimage_animal.image_id = image.image_id
					WHERE assoimage_animal.animal_id = :id";
				$requetePrepare3 = $bdd->prepare($requeteImageAnimal);
				$requetePrepare3->bindParam(':id', $ligne["animal_id"]);
				$requetePrepare3->execute();
				$resultatImageAnimal = $requetePrepare3->fetch(PDO::FETCH_ASSOC);

				if (empty($ligne["etat"]) == true) {
					$ligne["etat"] = "Non défini";
				}
	    	?>
			    <tr>
			      <td><img src="<?php echo($resultatImageAnimal["image_data"]);  ?>" alt="Image"></td>
			      <td><?php echo($ligne["prenom"]);  ?></td>
			      <td><?php echo($ligne["etat"]);  ?></td>
			      <td><?php echo($ligne["abel"]);  ?></td>
			      <td><a href="detail_animal.php?id=<?php echo($ligne["animal_id"]); ?>"><i class="fa-solid fa-eye"></i></a></td>
			      	<?php
			    		if ($role == "admin") { 
			    			?>
			      <td><a href="avis_animal.php?id=<?php echo($ligne["animal_id"]); ?>"><i class="fa-solid fa-eye"></i></a></td>
			    			<td><a href='modif_animal.php?id=<?php echo($ligne["animal_id"]); ?>&prenom=<?php echo($ligne["prenom"]); ?>&etat=<?php echo($ligne["etat"]); ?>&race=<?php echo($ligne["race_id"]); ?>&habitat=<?php echo($ligne["habitat_id"]); ?>' ><i class="fa-solid fa-pen"></i></a></td>
					      	<td><a href='suppr_animal.php?id=<?php echo($ligne["animal_id"]); ?>' ><i class="fa-solid fa-trash"></i></a></td>
			    			<?php
			    		} else if ($role == "employe") {
			    			?><td><a href='ajout_nourriture_animal.php?id=<?php echo($ligne["animal_id"]); ?>&prenom=<?php echo($ligne["prenom"]); ?>' ><i class="fa-solid fa-plus"></i></a></td><?php
			    		} else if ($role == "veto") {
			    			?><td><a href='consulter_nourriture_animal.php?id=<?php echo($ligne["animal_id"]); ?>&prenom=<?php echo($ligne["prenom"]); ?>' ><i class="fa-solid fa-eye"></i></a></td>
			    			<td><a href='laisser_avis_animal.php?id=<?php echo($ligne["animal_id"]); ?>&prenom=<?php echo($ligne["prenom"]); ?>' ><i class="fa-solid fa-pen-nib"></i></a></td>
			    			<?php
			    		}
			    	?></tr>
			    	<?php
		}
		?>		
		</tbody>
	</table>
	<?php
		} else {
			?><div class="mt10perso">Aucun animal ne vit dans cet habitat.</div><?php 
		}
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