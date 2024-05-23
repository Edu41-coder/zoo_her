<?php
    
    session_start();
        include('config.inc.php');
        $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
        $role = "visiteur";
    if (isset($_SESSION['utilisateur']))
    {
        $requeteCo2 = 'SELECT * FROM utilisateur WHERE username = "'.$_SESSION['utilisateur'].'"';
        $exeuserCo2 = $bdd->query($requeteCo2);
        $userCo2 = $exeuserCo2->fetch();
        if ($userCo2['role_id'] == 3) {
            $role = "admin";
        } else if ($userCo2['role_id'] == 1) {
            $role = "veto";
        } else if ($userCo2['role_id'] == 4) {
            $role = "employe";
        }
    } else {
        header('Location: connexion.php');
    }