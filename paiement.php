<?php
session_start();
require('./includes/init.php');
$id_user = $_SESSION['id'];
include('./includes/header.php');

?>


<div id="recap">
  <div class="row">
      <div id="coordonnee" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h3>Récapitulatif de vos coordonnées</h3>
        <?php
        //col-xs-12 col-sm-12 col-md-6 col-lg-6
        $id = $_SESSION['id'];
        $req = $db->query("SELECT * FROM user WHERE id_user = $id");
        $user = $req->fetch();
    echo "<b>Nom : </b>".$user['last_name'] . "<br>";
    echo "<b>Prénom : </b>".$user['first_name'] . "<br>";
    echo "<b>Email : </b>".$user['mail'] . "<br>";
    echo "<b>Adresse : </b>".$user['address'] . "<br>";
    echo "<b>Details : </b>".$user['details'] . "<br>";
    echo "<b>Code Postal :</b> ".$user['postal_code'] . "<br>";
    echo "<b>Ville : </b>".$user['city'] . "<br>";
    echo "<b>Pays : </b>".$user['country'] . "<br>";
    echo "<b>Téléphone : </b>".$user['phone'] . "<br>";
        ?>
    </div>
   <div id="tableau2" class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
       <h3>Récapitulatif de votre commande</h3><br>
    <table class="table table-striped table-hover">
        <tr>
            <td><b>Produit</b></td>
            <td><b>Prix</b></td>
        </tr>
        <?php
        //var_dump($_SESSION['cart']);
        if(isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach ($cart as $item) {
                $id = $item;
                $rq = $db->query("SELECT * FROM item WHERE id_item = $id");
                $product = $rq->fetch();
                ?>
                <tr>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['price'] . "€"; ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td></td>
            <td>
                <p>TOTAL : <?php echo $_SESSION['total']; ?>€</p>
            </td>
        </tr>
    </table>
   </div>
</div>
<hr>
    <div class="row">
        <div class="paiement col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Paiement</h3>
        <form action="" method="post">
            <label for="cardnumber">Numéro de carte bancaire :</label><br>
            <input type="number" name="cardnumber"> <br><br>
            <input id="payer" type="submit" value="Payer" name="pay">
        </form>
    </div>
</div>


<?php
        if(isset($_POST['pay'])){
            if(isset($user['address']) && isset($user['postal_code']) && isset($user['city']) && isset($user['country']) && isset($user['phone'])) {
                $number = $_POST['cardnumber'];

                $cardtype = array(
                    "visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/",
                    "mastercard" => "/^5[1-5][0-9]{14}$/",
                    "amex" => "/^3[47][0-9]{13}$/",
                );
                if (preg_match($cardtype['visa'], $number) || (preg_match($cardtype['mastercard'], $number)) || (preg_match($cardtype['amex'], $number))) {
                    $cart = $_SESSION['cart'];

                    foreach ($cart as $item) {
                        $id = $item;
                        $rq = $db->prepare("UPDATE item SET id_buyer=:id_buyer, sell_date= NOW() WHERE id_item = $id");
                        $rq->execute([
                            ':id_buyer' => $_SESSION['id']
                        ]);
                    }
                    echo "Paiement confirmé !";
                    $_SESSION['cart'] = NULL;
                    ?>
                    <a href="index.php">Retour vers l'accueil</a>
                    <a href="membre.php">Voir ma page membre</a>
                    <?php
                } else {
                    echo "Numéro de carte invalide";
                }
            }
            else {
                ?>
                    <p>Pour pouvoir procéder au paiement, vous devez remplir vos coordonnées dans votre <a href="modif_membre.php">espace membre</a>.</p>
<?php
            }
        }


include ('./includes/footer.html');
?>