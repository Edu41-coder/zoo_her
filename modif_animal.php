<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un animal</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        require 'verification_connexion.php';
        $page = 'animal';
        include("menu.php");
        $id = $_GET['id'];
        $prenom = $_GET['prenom'];
        $etat = $_GET['etat'];
        $race = $_GET['race'];
        $habitat = $_GET['habitat'];
        if ($role != "admin") {
            header('Location: liste_habitat.php');
        }
    ?>
    <div class="container">
        <h1>Modifier un animal</h1>
        <form action="modif-animal.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group mt10perso">
                <label for="prenomAnimal">Prénom</label>
                <input type="text" class="form-control" id="prenomAnimal" name="prenom" value="<?php echo $prenom; ?>" required>
            </div>
            <!-- div class="form-group mt10perso">
                <label for="etatAnimal">État</label>
                <input type="text" class="form-control" id="etatAnimal" name="etat" value="<?php /* echo $etat; */ ?>" placeholder="État">
            </div -->            
            <div class="form-group mt10perso">
                <label for="raceAnimal">Race de l'animal</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="race" id="raceAnimal" required>
                        <?php
                            include('config.inc.php');
                            $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
                            $requete = 'SELECT * FROM race';
                            $exe = $bdd->query($requete);

                            if ($exe) {
                                $resultats = $exe->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($resultats as $ligne) {
                                    if ($race == $ligne["race_id"]) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo ('<option ' . $selected . ' value="' . $ligne["race_id"] . '">' . $ligne["abel"] . '</option>');
                                }
                                unset($selected);
                            } else {
                                echo "Erreur lors de l'exécution de la requête SQL";
                            }
                        ?>
                  </select>
                </div>
            </div>
            <div class="form-group ">
                <label for="habitatAnimal">Habitat de l'animal</label>
                <div class="input-group mb-3">
                  <select name="habitat" class="form-control" id="habitatAnimal" required>
                        <?php
                            $requete2 = 'SELECT * FROM habitat';
                            $exe2 = $bdd->query($requete2);

                            if ($exe2) {
                                $resultats2 = $exe2->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($resultats2 as $ligne2) {
                                    if ($habitat == $ligne2["habitat_id"]) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo ('<option ' . $selected . ' value="' . $ligne2["habitat_id"] . '">' . $ligne2["nom"] . '</option>');
                                }
                            } else {
                                echo "Erreur lors de l'exécution de la requête SQL";
                            }
                        ?>
                  </select>
                </div>
            </div>
        <button type="submit" class="btn btn-success mt10perso">Modifier</button>
        <button class="btn btn-primary mt10perso"><a class="lien" href="liste_animal.php">Retour à la liste des animaux</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>