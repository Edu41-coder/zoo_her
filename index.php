<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zoo Arcadia</title>
    <!-- Bootstrap 5.1 CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        $page = 'accueil';
        require 'verification_connexion_simple.php';
        include('config.inc.php');
        include("menu.php");
    ?>
    <div class="container" id="homePage">
        <h1>Bienvenue sur la page du zoo Arcadia !</h1>
        <?php
            $bdd = new PDO('mysql:host=' . BDD_SERVER . ';dbname=' . BDD_DATABASE . ';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
            date_default_timezone_set('Europe/Paris');

            $heure_actuelle = date('H:i');

            $requete5="SELECT donnee FROM settings WHERE nom = 'ouvertureZoo'";
            $requete6="SELECT donnee FROM settings WHERE nom = 'fermetureZoo'";
            $exe5 = $bdd->query($requete5);
            $exe6 = $bdd->query($requete6);
            if ($exe5) {
                $resultats5 = $exe5->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultats5 as $ligne5) {
                    $heureOuverture = $ligne5["donnee"];
                    $heureOuvertureFormattee = DateTime::createFromFormat('H:i', $heureOuverture);
                    $heureOuvertureFormattee = $heureOuvertureFormattee->format('G\hi');
                    break;
                }
            }
            if ($exe6) {
                $resultats6 = $exe6->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultats6 as $ligne6) {
                    $heureFermeture = $ligne6["donnee"];
                    $heureFermetureFormattee = DateTime::createFromFormat('H:i', $heureFermeture);
                    $heureFermetureFormattee = $heureFermetureFormattee->format('G\hi');
                    break;
                }
            }

            if ($heure_actuelle >= $heureOuverture && $heure_actuelle < $heureFermeture) {
                echo "Votre ZOO est actuellement <span style='color: green; font-weight: bold;'>ouvert</span> de " . $heureOuvertureFormattee . " à " . $heureFermetureFormattee;
            } else {
                echo "Votre ZOO est actuellement <span style='color: red; font-weight: bold;'>fermé</span>. Ouverture chaque jour de " . $heureOuvertureFormattee . " à " . $heureFermetureFormattee . ".";
            }
        ?>
        <div id="carousel" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="image/1.jpg" class="d-block w-100" alt="Image de présentation du zoo 1">
            </div>
            <div class="carousel-item">
              <img src="image/2.jpg" class="d-block w-100" alt="Image de présentation du zoo 2">
            </div>
            <div class="carousel-item">
              <img src="image/3.webp" class="d-block w-100" alt="Image de présentation du zoo 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class='mt10perso'>
            <p>
                Arcadia est un zoo situé en France près de la forêt de Brocéliande, en Bretagne depuis 1960.  Plus de soixante ans plus tard, il se distingue toujours et fait partie des 5 premiers parcs zoologiques français en nombre de visiteurs. Au travers de la qualité de ses installations et le travail de ses équipes, le parc porte toute son attention et ses efforts au développement du bien-être des animaux et à l’accueil des visiteurs.
                Le zoo est entièrement indépendant au niveau des énergies et représente les valeurs de l’écologie dont nous sommes fier.
                <br>
                <br>
                Votre ZOO est ouvert chaque jour de <?php echo $heureOuvertureFormattee; ?> à <?php echo $heureFermetureFormattee; ?>.
            </p>
        </div>
        <div>
            <h2 class="mt30perso">Habitats du zoo</h2>
            <?php
            $requete = 'SELECT * FROM habitat LIMIT 15';
            $exe = $bdd->query($requete);

            if ($exe) {
                $resultats = $exe->fetchAll(PDO::FETCH_ASSOC);
                $i = 0;
                foreach ($resultats as $ligne) {
                        $requeteImage = "SELECT image.image_data 
                                        FROM assoimage_habitat 
                                        LEFT JOIN image ON assoimage_habitat.image_id = image.image_id
                                        WHERE assoimage_habitat.habitat_id =" . $ligne["habitat_id"];
                        $exeImage = $bdd->query($requeteImage);
                        $resultatImage = $exeImage->fetch(PDO::FETCH_ASSOC);
                        if ($i == 0) {
                        ?><div class="ligneHabitat"><div class="habitatG"><?php
                        } else {
                            ?><div class="habitatD"><?php
                            }
                        ?>
                            <img src="<?php echo($resultatImage["image_data"]);  ?>" >
                            <div class="contenuHabitatsHomePage">
                                <p class='pHomePage pHomePageElement1'><?php echo ($ligne["nom"]); ?></p>
                                <p class='pHomePage'><?php echo ($ligne["description"]); ?></p>
                            </div>

                        </div>
                    <?php 
                        if ($i == 0) {
                            $i++;
                        } else {
                            ?></div><?php
                                $i = 0;
                            }
                        ?>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <h2 class="mt30perso">Services du zoo</h2>
            <?php
            $requete2 = 'SELECT * FROM service';
            $exe2 = $bdd->query($requete2);

            if ($exe2) {
                $resultats2 = $exe2->fetchAll(PDO::FETCH_ASSOC);
                $i = 0;
                foreach ($resultats2 as $ligne2) {
                    ?>
                        <h4><?php echo ($ligne2["nom"]); ?></h4>
                        <p><?php echo ($ligne2["description"]); ?></p>
                    <?php
                }
            }
            ?>
        </div>
        <div>
            <h2 class="mt30perso">Animaux du zoo</h2>
            <?php
            $requete3 = 'SELECT animal.animal_id, animal.prenom, animal.etat, race.abel, habitat.nom 
                FROM animal
                LEFT JOIN race ON animal.race_id = race.race_id
                LEFT JOIN habitat ON animal.habitat_id = habitat.habitat_id
                LIMIT 15;';
            $exe3 = $bdd->query($requete3);

            if ($exe) {
                $resultats3 = $exe3->fetchAll(PDO::FETCH_ASSOC);
                $i = 0;
                foreach ($resultats3 as $ligne3) {
                    $requeteImageAnimal = "SELECT image.image_data 
                                FROM assoimage_animal 
                                LEFT JOIN image ON assoimage_animal.image_id = image.image_id
                                WHERE assoimage_animal.animal_id =" . $ligne3["animal_id"];
                    $exeImageAnimal = $bdd->query($requeteImageAnimal);
                    $resultatImageAnimal = $exeImageAnimal->fetch(PDO::FETCH_ASSOC);
                        if ($i == 0) {
                        ?><div class="ligneHabitat"><div class="habitatG"><?php
                        } else {
                            ?><div class="habitatD"><?php
                            }
                        ?>
                            <img class="imgAnimalIndex" src="<?php echo($resultatImageAnimal["image_data"]);  ?>" alt="Image">
                            <div class="contenuHabitatsHomePage">
                                <p class='pHomePage pHomePageElement1'><?php echo ($ligne3["prenom"]); ?></p>
                                <p class='pHomePage'><?php echo ($ligne3["abel"]); ?></p>
                                <p class='pHomePage'><?php echo ($ligne3["nom"]); ?></p>
                            </div>

                        </div>
                    <?php 
                        if ($i == 0) {
                            $i++;
                        } else {
                            ?></div><?php
                                $i = 0;
                            }
                        ?>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <h2 class="mt30perso">Les 5 derniers avis sur le zoo</h2>
            <?php
                $requete4 = 'SELECT * 
                            FROM avis 
                            WHERE avis.isvisible > 0
                            ORDER BY avis.avis_id DESC
                            LIMIT 5';
                $exe4 = $bdd->query($requete4);

                if ($exe4) {
                    $resultats4 = $exe4->fetchAll(PDO::FETCH_ASSOC);
                    $i = 0;
                    foreach ($resultats4 as $ligne4) {
                        ?>
                            <h4><?php echo ($ligne4["pseudo"]); ?></h4>
                            <p><?php echo ($ligne4["commentaire"]); ?></p>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
</div>
    <?php
        include("footer.php");
    ?>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>