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
    <link id="style" rel="stylesheet" href="css/main.css" />

</head>

<body>
<div class="mainmenu">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="formulaire_produit.php">Ajouter un produit</a></li>
        <li><a href="membre.php">Mon compte</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="Connexion">Connexion</a></li>
    </ul>
</div>
<?php
$id_item = $_GET['id_item'];
$req = $db->query("SELECT * FROM item WHERE id_item = $id_item");
$item = $req->fetch();

$id_seller = $item['id_seller'];
$req = $db->query("SELECT * FROM user WHERE id_user = $id_seller");
$seller = $req->fetch();
?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <h3>Présentation du produit</h3>
        <img src="<?php echo $item['photo']; ?>" alt="" width="300">
        <h4><?php echo $item['name']; ?></h4>
        <article>
            Mise en ligne le : <?php echo $item['date']; ?> <br>
            Catégorie : <?php echo $item['category']; ?> <br>
            Marque/Editeur : <?php echo $item['brand']; ?> <br>
            <span id="price">Prix : <?php echo $item['price']; ?> €<br></span>
            Etat : <?php echo $item['status']; ?> <br>
            Reçu : <?php echo $item['receipt']; ?> <br>
            Garantie : <?php echo $item['warrantly']; ?> <br>
            <p>
                Description : <?php echo $item['description']; ?> <br>
            </p>
        </article>
        <?php
            if($_SESSION['id'] == $id_seller){
                ?>
                <a href="modif_produit.php">Modifier votre annonce</a><br>
                <a href="supp_produit.php">Supprimer votre annonce</a><br>
        <?php
            }
        ?>
    </div>
</div>
