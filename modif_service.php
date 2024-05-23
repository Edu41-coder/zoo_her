<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un service</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'service';
        include("menu.php");
        $id = $_GET['id'];
        $nom = $_GET['nom'];
        $description = $_GET['description'];
        if ($role != "admin" && $role != "employe") {
            header('Location: liste_service.php');
        }
    ?>
    <div class="container">
        <h1>Modifier un service</h1>
        <form action="modif-service.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group mt10perso">
                <label for="nomService">Nom</label>
                <input type="text" class="form-control" id="nomService" name="nom" value="<?php echo $nom; ?>" required>
            </div>
            <div class="form-group mt10perso">
                <label for="descriptionService">Description</label>
                <input type="text" class="form-control" id="descriptionService" name="description" value="<?php echo $description; ?>" required>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Modifier</button>
        <button class="btn btn-primary mt10perso"><a class="lien" href="liste_service.php">Retour à la liste des services</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>