<?php
session_start();
require('./includes/init.php');
include('./includes/header.php');
$total = array();
?>



<div class="panier">
    <div class="accueil">
        <h2>Panier</h2>
    </div>
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
                <?php
                    echo $product['price'] . "€";
                    array_push($total, $product['price']);
                ?>
            </td>
        </tr>
        <?php
    }
}
?>
        <tr>
            <td></td>
            <td>
                <p>TOTAL :
                    <?php
                    $_SESSION['total'] = array_sum($total);
                    echo $_SESSION['total'];
                    ?>
                    €</p>
            </td>
        </tr>

    </table>
    <div id="commande">
        <a href="paiement.php">Commander</a>
    </div>
    </div>
<?php
//}


include ('./includes/footer.html');
?>
