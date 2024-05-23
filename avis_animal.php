<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avis du vétérinaire</title>
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
        $id = $_GET['id'];
        $debut = $_GET['debut'];
        $fin = $_GET['fin'];
        $requete = 'SELECT *
                FROM rapport_veterinaire';

        if (empty($id) == true) {
            $id = 0;
        }

        if ($id > 0) {
            $requete .= ' WHERE rapport_veterinaire.animal_id = :id';
        } else {
            $requete .= ' WHERE rapport_veterinaire.animal_id > :id';
        }

        if (empty($debut) == false && empty($fin) == false) {
            $requete .= " AND rapport_veterinaire.date BETWEEN :debut AND :fin";
        }        

        $requete .= " ORDER BY rapport_veterinaire.date DESC";

        $requetePrepare = $bdd->prepare($requete);

        $requetePrepare->bindParam(':id', $id);

        if (empty($debut) == false && empty($fin) == false) {
            $requetePrepare->bindParam(':debut', $debut);
            $requetePrepare->bindParam(':fin', $fin);
        }
        $requetePrepare->execute();

        $resultats = $requetePrepare->fetchAll(PDO::FETCH_ASSOC);
        setlocale(LC_TIME, 'fr_FR.UTF-8');
    ?>
    <div class="container">
        <h1>Avis du vétérinaire pour l'animal </h1>

        <div id="filtres" class="mt10perso">
            <form action="avis_animal.php" method="get">
                    <select name="id">
                        <option value="0">Tous les animaux</option>
                        <?php
                            include('config.inc.php');
                            $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
                            $requete2 = 'SELECT * FROM animal';
                            $exe2 = $bdd->query($requete2);
                            

                            if ($exe2) {
                                $resultats2 = $exe2->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($resultats2 as $ligne2) {
                                    if ($id == $ligne2["animal_id"]) {
                                        $selectedAnimal = "selected";
                                    } else {
                                        $selectedAnimal = "";
                                    }
                                    echo ('<option ' . $selectedAnimal . ' value="' . $ligne2["animal_id"] . '">' . $ligne2["prenom"] . '</option>');
                                }
                            } else {
                                echo "Erreur lors de l'exécution de la requête SQL";
                            }
                        ?>
                  </select>
                <input type="date" name="debut" placeholder="Date de début" value="<?php echo $debut; ?>">
                <input type="date" name="fin" placeholder="Date de fin" value="<?php echo $fin; ?>" >
        <button type="submit" class="btn btn-success">Chercher</button>
        <button type="button" class="btn btn-primary"><a class="lien" href="avis_animal.php?id=<?php echo $id ?>">Réinitialiser le filtre</a></button>
    </form>
        </div>

        <div class="divDebut">
            <button type="button" class="btn btn-success btn-lg"><a class="lien" href="liste_habitat.php">Retour à la liste des habitats</a></button>
        </div>
        <?php
            if (count($resultats) == 0) {
                ?>
                    <p class="mt10perso">Aucun avis du vétérinaire pour cet animal.</p>
                <?php
            }
            foreach ($resultats as $ligne) {
                $dateFormatee = strftime('%e %B %Y', strtotime($ligne['date']));
                ?>
                    <h2 class="mt30perso">Avis du vétérinaire du <?php echo $dateFormatee; ?></H2>
                    <p class="mt10perso"><span class="boldSpan">État : </span><?php echo $ligne['etatAvis'] ?></p>
                    <p><span class="boldSpan">Détail de l'état : </span><?php echo $ligne['detail'] ?></p>
                <?php
            }
        ?>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>