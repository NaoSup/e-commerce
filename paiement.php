<?php
session_start();
require('./includes/init.php');
$id_user = $_SESSION['id'];
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
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="formulaire_produit.php">Ajouter un produit</a></li>
        <li><a href="membre.php">Mon compte</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
        <li><a href="cart.php">Panier</a></li>
    </ul>
</div>

<div class="recap">
    <h3>Récapitulatif de votre commande</h3>
    <?php
    //var_dump($_SESSION['cart']);
    if(isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        foreach ($cart as $items) {
            foreach ($items as $item) {
                $id = $item[0];
                $rq = $db->query("SELECT * FROM item WHERE id_item = $id");
                $product = $rq->fetch();
                echo $product['name'] . "<br>";
                echo $product['price'] . "<br>";
            }
        }
        ?>
        <p>TOTAL :
            <?php
            $total = array_sum($_SESSION['cart']['price']);
            echo $total;
            ?>
            €</p>
        <h3>Récapitulatif de vos coordonnées</h3>
        <?php
        $id = $_SESSION['id'];
        $req = $db->query("SELECT * FROM user WHERE id_user = $id");
        $user = $req->fetch();
    echo "Nom : ".$user['last_name'] . "<br>";
    echo "Prénom : ".$user['first_name'] . "<br>";
    echo "Email : ".$user['mail'] . "<br>";
    echo "Adresse : ".$user['address'] . "<br>";
    echo "Details : ".$user['details'] . "<br>";
    echo "Code Postal : ".$user['postal_code'] . "<br>";
    echo "Ville : ".$user['city'] . "<br>";
    echo "Pays : ".$user['country'] . "<br>";
    echo "Téléphone : ".$user['phone'] . "<br>";
        ?>
        </div>
        <div class="paiement">
            <h3>Paiement</h3>
            <form action="" method="post">
                <label for="cardnumber">Numéro de carte bancaire :</label><br>
                <input type="number" name="cardnumber"><br>
                <input type="submit" value="Payer" name="submit">
            </form>
        </div>
<?php
        if(isset($_POST['submit'])){
            if(isset($user['address']) && isset($user['postal_code']) && isset($user['city']) && isset($user['country']) && isset($user['phone'])){
            $number= $_POST['cardnumber'];

            $cardtype = array(
                "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
                "mastercard" => "/^5[1-5][0-9]{14}$/",
                "amex"       => "/^3[47][0-9]{13}$/",
            );

            if (preg_match($cardtype['visa'],$number) || (preg_match($cardtype['mastercard'],$number)) || (preg_match($cardtype['amex'],$number))) {
                foreach ($cart as $items) {
                    foreach ($items as $item) {
                        $id = $item[0];
                        $rq = $db->prepare("UPDATE item SET id_buyer=:id_buyer, sell_date= NOW() WHERE id_item");
                        $rq->execute([
                            ':id_buyer' => $_SESSION['id']
                        ]);
                    }
                }
                echo "Paiement confirmé !";
                $_SESSION['cart'] = NULL;
                var_dump($_SESSION['cart']);
            }
            else
            {
                echo "Numéro de carte invalide";
            }
        }
        else {
                ?>
            <p>Pour pouvoir procéder au paiement, vous devez remplir vos coordonnées dans votre <a href="modif_membre.php">espace membre</a>.</p>
<?php
            }
        }

    }
    else {
        header('Location:cart.php');
    }

