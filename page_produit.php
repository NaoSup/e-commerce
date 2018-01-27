<?php
session_start();
require('./includes/init.php');
/*$_SESSION['cart'] = array();
$_SESSION['cart']['id_item'] = array();
$_SESSION['cart']['price'] = array();*/
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
            Mise en ligne le : <?php
            $array = explode(" ", $item['date']);
            $date = explode("-",$array[0]);
            $new_date = "$date[2]-$date[1]-$date[0]";
            echo $new_date;
            ?> <br>
            Catégorie : <?php echo $item['category']; ?> <br>
            Marque/Editeur : <?php echo $item['brand']; ?> <br>
            <span id="price">Prix : <?php echo $item['price']; ?> €<br></span>
            Etat : <?php echo $item['status']; ?> <br>
            Date d'achat : <?php
            if(isset($item['purchase_date'])) {
                $array = explode(" ", $item['purchase_date']);
                $date = explode("-",$array[0]);
                $new_date = "$date[2]-$date[1]-$date[0]";
                echo $new_date;
            } else {echo "Non renseigné";}
            ?>
            <br>
            Reçu : <?php echo $item['receipt']; ?> <br>
            Garantie : <?php echo $item['warrantly']; ?> <br>
            <p>
                Description : <?php echo $item['description']; ?> <br>
            </p>
        </article>
        <?php
            if(isset($_SESSION['id']) && $_SESSION['id'] == $id_seller){
                ?>
                <a href="modif_produit.php?id_item=<?php echo $item['id_item']?>">
                    Modifier votre annonce
                </a>
        <?php
            }
            elseif(empty($item['id_buyer']) && isset($_SESSION['id'])){
                ?>
                <form action="" method="post">
                    <input type="submit" name="cart" value="Ajouter au panier">
                </form>
        <?php
                if(isset($_POST['cart'])){
                    if(!isset($_SESSION['cart'])){
                        $_SESSION['cart'] = array();
                        $_SESSION['cart']['id_item'] = array();
                        $_SESSION['cart']['price'] = array();
                    }
                    if(in_array($item['id_item'],$_SESSION['cart']['id_item'])){
                        echo "Ce produit a déjà été ajouté à votre panier.";
                    }
                    else{
                        echo "ok";
                        array_push($_SESSION['cart']['id_item'], $item['id_item']);
                        array_push($_SESSION['cart']['price'], $item['price']);
                    }
                }
            }
        ?>
    </div>
</div>
