<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un habitat</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'habitat';
        include("menu.php");
    ?>
    <div class="container">
        <h1>Ajouter un habitat</h1>
        <form action="ajout-habitat.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt10perso">
                <label for="nomHabitat">Nom</label>
                <input type="text" class="form-control" id="nomHabitat" name="nom" placeholder="Nom de l'habitat" required>
            </div>
            <div class="form-group mt10perso">
                <label for="descriptionHabitat">Description</label>
                <input type="text" class="form-control" id="descriptionHabitat" name="description" placeholder="Description de l'habitat" required>
            </div>
            <!-- div class="form-group mt10perso">
                <label for="descriptionHabitat">Commentaire</label>
                <input type="text" class="form-control" id="commentaireHabitat" name="commentaire_habitat" placeholder="Commentaire de l'habitat" required>
            </div -->
            <div class="form-group mt10perso">
                <label for="imageHabitat">Image</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control-file" id="imageHabitat" name="image_id" required>
                </div>
            </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <button class="btn btn-primary"><a class="lien" href="liste_habitat.php">Retour à la liste des habitats</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>