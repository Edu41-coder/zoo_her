<?php
    $id = ($_GET['id']);

    include('config.inc.php');
    $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
    $requete = 'DELETE FROM service WHERE service_id = ' .$id;
    $bdd->query($requete); 
    header('Location: liste_service.php?message=supprOk');
