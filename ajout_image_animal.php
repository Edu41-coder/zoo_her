<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajout d'une nouvelle image pour l'animal</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'habitat';
        include("menu.php");
        if ($role != "admin") {
            header('Location: liste_habitat.php');
        }
    ?>
    <div class="container">
        <h1>Ajouter une image pour l'animal <?php echo $_GET['nom'] ?></h1>
        <form action="ajout-image-animal.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
                <label for="imageAnimal">Image</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control-file" id="imageAnimal" name="image_id" required>
                </div>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Ajouter</button>
        <button class="btn btn-primary mt10perso"><a class="lien" href="detail_animal.php?id=<?php echo $_GET['id'];?>">Retour sur la fiche de l'animal</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>