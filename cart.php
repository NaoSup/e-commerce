<?php
session_start();
require('./includes/init.php');
include('./includes/header.html');
include ('./includes/footer.html');
?>



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



