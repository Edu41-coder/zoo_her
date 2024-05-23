<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter de la nourriture</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'habitat';
        include("menu.php");
        if ($role != "employe") {
            header('Location: liste_habitat.php');
        }
    ?>
    <div class="container">
        <h1>Ajouter de la nourriture pour l'animal <?php echo($_GET['prenom']) ?></h1>
        <form action="ajout-nourriture-animal.php" method="post">
            <input type="hidden" value="<?php echo($_GET['id'])?>" name="id">
            <div class="form-group mt10perso">
                <label for="nourriture">Nourriture donnée</label>
                <input type="text" class="form-control" id="nourriture" name="nourriture" placeholder="Nourriture donnée" required>
            </div>
            <div class="form-group mt10perso">
                <label for="quantite">Quantité donnée en gramme</label>
                <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité donnée en gramme" required>
            </div>
            <div class="form-group mt10perso">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
            </div>
            <div class="form-group mt10perso">
                <label for="heure">Heure</label>
                <input type="time" class="form-control" id="heure" name="heure" placeholder="Heure" required>
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