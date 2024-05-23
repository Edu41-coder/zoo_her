<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un avis sur un animal</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'habitat';
        $prenom = $_GET['prenom'];
        $id = $_GET['id'];
        include("menu.php");
        if ($role != "veto") {
            header('Location: liste_habitat.php');
        }
    ?>
    <div class="container">
        <h1>Ajouter un avis pour l'animal <?php echo($prenom); ?></h1>
        <form action="laisser-avis-animal.php" method="post">
            <input type="hidden" name="id" value="<?php echo($id); ?>">
            <div class="form-group mt10perso">
                <label for="detailAvis">Détail</label>
                <input type="text" class="form-control" id="detailAvis" name="detailAvis" placeholder="Détail de l'avis" required>
            </div>
            <div class="form-group mt10perso">
                <label for="etatActuel">État actuel de l'animal</label>
                <input type="text" class="form-control" id="etatActuel" name="etatActuel" placeholder="État actuel de l'animal" required>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Ajouter</button>
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