<?php
    $id = ($_GET['id']);

    include('config.inc.php');
    $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);

    $requete3 = 'SELECT COUNT(animal.prenom) AS nb FROM animal WHERE habitat_id = :id';

    $requetePrepare3 = $bdd->prepare($requete3);
    $requetePrepare3->bindParam(':id', $id);
    $requetePrepare3->execute();
    $resultats = $requetePrepare3->fetch(PDO::FETCH_ASSOC);

    if ($resultats["nb"] > 0) {
        header('Location: liste_habitat.php?message=supprKo');
    } else {
        $requete = 'DELETE FROM assoimage_habitat WHERE habitat_id = :id';
        $requetePrepare = $bdd->prepare($requete);
        $requetePrepare->bindParam(':id', $id);
        $requetePrepare->execute();

        $requete2 = 'DELETE FROM habitat WHERE habitat_id = :id';
        $requetePrepare2 = $bdd->prepare($requete2);
        $requetePrepare2->bindParam(':id', $id);
        $requetePrepare2->execute();
        
        header('Location: liste_habitat.php?message=supprOk');
    }
