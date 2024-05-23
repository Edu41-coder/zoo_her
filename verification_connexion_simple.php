<?php
    session_start();
        include('config.inc.php');
        $bdd = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_DATABASE.';charset=utf8', BDD_LOGIN, BDD_PASSWORD);
        $role = "visiteur";
    if (isset($_SESSION['utilisateur']))
    {
        $requeteCo = 'SELECT * FROM utilisateur WHERE username = "'.$_SESSION['utilisateur'].'"';
        $exeuserCo = $bdd->query($requeteCo);
        $userCo = $exeuserCo->fetch();
        if ($userCo['role_id'] == 3) {
            $role = "admin";
        } else if ($userCo['role_id'] == 1) {
            $role = "veto";
        } else if ($userCo['role_id'] == 4) {
            $role = "employe";
        }
    }