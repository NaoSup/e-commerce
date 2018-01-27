<?php
session_start();
require('./includes/init.php');
?>
<!DOCTYPE HTML>
<html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Panier</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link id="style" rel="stylesheet" href="css/main.css" />

</head>

<body>
    <div class="mainmenu">

        <nav class="navbar navbar-default navbar-inverse">
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="formulaire_produit.php">Ajouter un produit</a></li>
                        <li><a href="membre.php">Mon compte</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                        <li><a href="cart.php">Panier</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

    </div>

<div class="panier">
<?php
//var_dump($_SESSION['cart']);
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    foreach ($cart as $items) {
        foreach($items as $item) {
            $id = $item[0];
            $rq = $db->query("SELECT * FROM item WHERE id_item = $id");
            $product = $rq->fetch();
            echo $product['name'] . "<br>";
            echo $product['price'] . "€ <br>";
        }
    }
    ?>
    <p>TOTAL :
    <?php
        $total = array_sum($_SESSION['cart']['price']);
        echo $total;
    ?>
    €</p>
    <a href="paiement.php"><button>Commander</button></a>
    </div>
<?php
}
