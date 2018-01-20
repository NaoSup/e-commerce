<?php
session_start();
require('./includes/init.php');
if(!isset($_SESSION['id'])){
    header('Location:connexion.php');
}
else{
    $id = $_SESSION['id'];
}
?>
<!DOCTYPE HTML>
<html>
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
    <title>Espace Membre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link id="style" rel="stylesheet" href="css/main.css"/>

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
<div class="menumembre col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <ul>
        <li><a href="modif_membre.php">Modifier mes infos</a></li>
    </ul>
</div>
<div class="content col-xs-10 col-sm-10 col-md-10 col-lg-10">
    <h2>Bienvenue dans votre espace membre</h2>
<hr>
<h3>Vos produits en ligne</h3>
<?php
$req = $db->query("SELECT * FROM item WHERE id_seller = $id");
$items = $req->fetchAll();

if (!empty($items)) {
    ?>
    <table class="table table-striped table-hover">
        <tr>
            <td><b>Numéro de la publication</b></td>
            <td><b>Date de la publication</b></td>
            <td><b>Titre</b></td>
        </tr>
        <?php
        foreach ($items as $item) {
            ?>
            <tr>
                <td>
                    <?php echo $item['id_item']; ?>
                </td>
                <td>
                    <?php echo $item['date'];?>
                </td>
                <td>
                    <?php echo $item['name']; ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    ?>
    <tr>
        <i>Cette section est vide.</i>
    </tr>
    <?php
}

?>

<br>
<HR size=2 align=center width="100%">
<br>
<h3>Vos produits vendus</h3>

<?php

$req = $db->query("SELECT * FROM item WHERE id_buyer IS NOT NULL AND id_seller = $id");
$items = $req->fetchAll();
if (!empty($items)) {
    ?>
    <table class="table table-striped table-hover">
        <tr>
            <td><b>Numéro de la publication</b></td>
            <td><b>Date de vente</b></td>
            <td><b>Acheteur</b></td>
            <td><b>Titre</b></td>
        </tr>
        <?php
        foreach ($items as $item) {
            $buyer = $item['id_buyer'];
            $req = $db->query("SELECT * FROM user WHERE id_user = $buyer");
            $user = $req->fetch();
            ?>

            <tr>
                <td>
                    <?php echo $item['id_item']; ?>
                </td>
                <td>
                    <?php
                    if(isset($item['sell_date'])) {
                        $array = explode(" ", $item['sell_date']);
                        $date = explode("-", $array[0]);
                        $new_date = "$date[2]-$date[1]-$date[0]";
                        echo $new_date;
                    }
                    ?>
                </td>
                <td>
                    <a href="Profil/profil.php?id_user=<?php echo $item['id_buyer']?>">
                        <?php echo $user['username']; ?>
                    </a>
                </td>
                <td>
                    <?php echo $item['name']; ?>
                </td>
            </tr>

            <?php
        }
        ?>
    </table>
    <?php
} else {
    ?>
    <i>Cette section est vide.</i>
    <?php
}
?>
<br>
<HR size=2 align=center width="100%">
<br>
<h3>Historique de vos achats</h3>

<?php

$req = $db->query("SELECT * FROM item WHERE id_buyer = $id");
$res = $req->fetchAll();
if (!empty($res)) {
    ?>

    <table class="table table-striped table-hover">
        <tr>
            <td><b>Numéro de la publication</b></td>
            <td><b>Date d'achat</b></td>
            <td><b>Vendeur</b></td>
            <td><b>Titre</b></td>
            <td><b>Prix</b></td>
        </tr>
        <?php
        foreach ($items as $item) {
            $seller = $item['id_seller'];
            $req = $db->query("SELECT * FROM user WHERE id_user = $seller");
            $user = $req->fetch();
            ?>

            <tr>
                <td>
                    <?php echo $item['id_item']; ?>
                </td>
                <td>
                    <?php
                    if(isset($item['sell_date'])) {
                        $array = explode(" ", $item['sell_date']);
                        $date = explode("-", $array[0]);
                        $new_date = "$date[2]-$date[1]-$date[0]";
                        echo $new_date;
                    }
                    ?>
                </td>
                <td>
                    <a href="Profil/profil.php?id_user=<?php echo $item['id_seller']?>">
                        <?php echo $user['username']; ?>
                    </a>
                </td>
                <td>
                    <?php echo $item['name']; ?>
                </td>
                <td>
                    <?php echo $item['price']; ?>

                </td>
            </tr>

            <?php
        }
        ?>
    </table>
    <?php
} else {
    ?>
    <i>Cette section est vide.</i>
    <?php
}

?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>

