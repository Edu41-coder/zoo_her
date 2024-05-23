<?php
    $id = ($_GET['id']);

    include('config.inc.php');
    $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
    $requete = 'DELETE FROM assoimage_animal WHERE animal_id = ' .$id;
    $exe = $bdd->query($requete); 
    $requete3 = 'DELETE FROM consultationparanimal WHERE animal_id = ' .$id;
    $exe3 = $bdd->query($requete3); 
    $requete2 = 'DELETE FROM animal WHERE animal_id = ' .$id;
    $exe2 = $bdd->query($requete2); 

    if ($exe2 == false) {
        header('Location: liste_habitat.php?message=supprAnimalKo');
    } else {
        header('Location: liste_habitat.php?message=supprAnimalOk');
    }
