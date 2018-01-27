<?php
session_start();
require('./includes/init.php');
?>
<!DOCTYPE HTML>
<html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Accueil TechArea</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link id="style" rel="stylesheet" href="./css/main.css" />

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

<h1>Itech Area</h1>


<?php
if (isset($_SESSION['id'])){
    ?>
    <?php
}
else{
    ?>
    <p>Vous n'avez pas de compte chez ITECH AREA, alors qu'attendez vous pour vous inscrire? Allez cliquer ici <a href="inscription.php">Inscription</a></p>

    <?php
}
?>

<?php
$req = $db->query("SELECT * FROM item ORDER BY date desc");
$items = $req->fetchAll();
foreach ($items as $item) {
    $seller = $item['id_seller'];
    $req = $db->query("SELECT * FROM user WHERE id_user = $seller");
    $user = $req->fetch();
    if(empty($item['id_buyer'])){
    ?>
    <div class="item">
        <img src="<?php echo $item['photo'] ?>" alt="" width="200px">
        <h3><?php echo $item['name'] ?></h3>
        <h4><?php echo $item['category'] ?></h4>
        <p><?php echo $item['price'] ?>€</p>
        <a href="page_produit.php?id_item=<?php echo $item['id_item'];?>">+ de détails</a>
    </div>
    <?php
    }
}
?>
<div class="bas"></div>
<div id="footer">
    <ul>
        <p> Copyright 2018 <span>Itech Area</span> aka Pratheepa KONESWARAN, Naomi PAULMIN, Stanley TISSOT </p>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
    </ul>

    <div>
        <h3>Contact:</h3>
        <p>mail: itech_area@ynov.com</p>
        <p>telephone:0698457532</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>

