<?php
session_start();
require('./includes/init.php');
if(!isset($_SESSION['id'])){
    header('Location:connexion.php');
}
else{
    $id = $_SESSION['id'];
}
include('./includes/header.html');
include ('./includes/footer.html');

?>



<div class="menumembre col-xs-2 col-sm-2 col-md-2 col-lg-2">

</div>
<div class="content col-xs-10 col-sm-10 col-md-10 col-lg-10">
    <h2>Bienvenue dans votre espace membre <a href="modif_membre.php">Modifier mes infos</a> </h2>
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
                    <?php
                    $array = explode(" ", $item['date']);
                    $date = explode("-",$array[0]);
                    $new_date = "$date[2]-$date[1]-$date[0]";
                    echo $new_date;
                    ?>
                </td>
                <td>
                    <a href="page_produit.php?id_item=<?php echo $item['id_item']?>">
                        <?php echo $item['name']; ?>
                    </a>
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
                    <a href="profil.php?id_user=<?php echo $item['id_buyer']?>">
                        <?php echo $user['username']; ?>
                    </a>
                </td>
                <td>
                    <a href="page_produit.php?id_item=<?php echo $item['id_item']?>">
                        <?php echo $item['name']; ?>
                    </a>
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
$items = $req->fetchAll();
if (!empty($items)) {
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
                    <a href="page_produit.php?id_item=<?php echo $item['id_item']?>">
                        <?php echo $item['name']; ?>
                    </a>
                </td>
                <td>
                    <?php echo $item['price']; ?>€

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

