<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulter la nourriture</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    require 'verification_connexion.php';
    $page = 'habitat';
    include("menu.php");
    if ($role != "veto") {
        header('Location: liste_habitat.php');
    }
    ?>
    <div class="container">
        <h1>Consulter la nourriture donnée pour l'animal <?php echo ($_GET['prenom']) ?></h1>

        <button class="btn btn-success margin2"><a class="lien" href="liste_habitat.php">Retour à la liste des habitats</a></button>

        <?php
        $requete = "SELECT * 
                        FROM nourriture_animal
                        WHERE animal_id = :id ORDER BY nourriture_animal.date DESC, nourriture_animal.heure DESC";
        $requetePrepare = $bdd->prepare($requete);
        $requetePrepare->bindParam(':id', $_GET["id"]);
        $requetePrepare->execute();

        if ($requetePrepare) {
            $resultats = $requetePrepare->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultats) > 0) {
        ?>
            <table class="table table-striped mt10perso">
                <thead>
                    <tr>
                        <th scope="col">Nourriture</th>
                        <th scope="col">Quantité en gramme</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultats as $ligne) { 
                        $dateFormatee = strftime('%e %B %Y', strtotime($ligne["date"]));
                        ?>
                        <tr>
                            <td><?php echo ($ligne["nourriture"]); ?></td>
                            <td><?php echo ($ligne["quantite"] . "g"); ?></td>
                            <td><?php echo ($dateFormatee); ?></td>
                            <td><?php echo ($ligne["heure"]); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            ?>
                <div class="mt10perso">Cet animal n'a jamais reçu de nourriture !</div>
            <?php
        }
    } ?>
    </div>
    <?php
    include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>