<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Écrire un commentaire sur un habitat</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'habitat';
        include("menu.php");
        $id = $_GET['id'];
        $nom = $_GET['nom'];

        if ($role != "veto") {
            header('Location: liste_habitat.php');
        }

        $commentaireExistant = "";

        $requete = 'SELECT commentaire_habitat FROM habitat WHERE habitat_id = :id';
        $requetePrepare = $bdd->prepare($requete);
        $requetePrepare->bindParam(':id', $id);
        $requetePrepare->execute();
        if ($requetePrepare) {
            $resultats = $requetePrepare->fetch(PDO::FETCH_ASSOC);
            $commentaireExistant = $resultats["commentaire_habitat"];
        }   
    ?>
    <div class="container">
        <h1>Écrire un commentaire sur l'habitat <?php echo($nom); ?></h1>
        <form action="ecrire-commentaire-habitat.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group mt10perso">
                <label for="commentaireHabitat">Commentaire sur l'habitat</label>
                <textarea type="text" class="form-control" id="commentaireHabitat" name="commentaire" placeholder="Commentaire sur l'habitat" required><?php echo $commentaireExistant; ?></textarea>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Écrire un commentaire</button>
        <button class="btn btn-primary mt10perso"><a class="lien" href="liste_habitat.php">Retour à la liste des habitats</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>