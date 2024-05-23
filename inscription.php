<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="styles/zoo.css" rel="stylesheet" type="text/css">
    <title>Inscription - Zoo Arcadia</title>
</head>

<body>
    <?php
    $page = "compte";
    include("menu.php");
    $message = $_GET['message'];
    if ($message == "erreur1") {
        echo "<div class='messageHautDePage'>Ce pseudo est déjà utilisé, veuillez recommencer...</div>";
    } else if ($message == "erreur2") {
        echo "<div class='messageHautDePage'>Le mot de passe est trop court, il doit faire 10 caractères au minimum, veuillez recommencer...</div>";
    } else if ($message == "erreur3") {
        echo "<div class='messageHautDePage'>Le rôle de l'inscription n'est pas correcte, veuillez recommencer...</div>";
    }
    ?>
    <div class="container">
        <h1>Inscription</h1>
        <form action="valid_inscription.php" method="post">
            <div class="form-group mt10perso">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" required>
            </div>
            <div class="form-group mt10perso">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group mt10perso">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group mt10perso">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-group mt10perso">
                <label for="role">Rôle</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="role" id="role" required>
                    <option value="1">Vétérinaire</option>
                    <!-- option value="3">Administrateur</option -->
                    <option value="4">Employé</option>
                  </select>
                </div>
            </div>
        <button type="submit" class="btn btn-success mt10perso">S'inscrire</button>
        <button class="btn btn-primary mt10perso"><a class="lien" href="connexion.php">Se connecter</a></button>
    </form>
    </div>
    <?php
        include("footer.php");
    ?>
</body>
</html>