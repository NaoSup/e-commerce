<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Itech Area</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" href="./css/main2.css" />
    <link rel="stylesheet" href="./css/smart.css" type="text/css" media="only screen and (max-width:768px)"/>
</head>
<body>

<main>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" >
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">ITech Area</a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <?php
                if(isset($_SESSION['id'])){
                    ?>
            <li class="nav-item">
                <a class="nav-link" href="formulaire_produit.php">Ajouter un produit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="membre.php">Mon compte</a>
            </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Panier</a>
                    </li>
                    <?php
                } else {
                    ?>

            <li class="nav-item">
                <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
                    <?php
                }
            ?>

        </ul>
    </div>
</nav>

