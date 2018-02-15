<?php
session_start();
require('./includes/init.php');
/*$_SESSION['cart'] = array();
$_SESSION['cart']['id_item'] = array();
$_SESSION['cart']['price'] = array();*/
include('./includes/header.php');

?>


<?php
$id_item = $_GET['id_item'];
$req = $db->query("SELECT * FROM item WHERE id_item = $id_item");
$item = $req->fetch();

$id_seller = $item['id_seller'];
$req = $db->query("SELECT * FROM user WHERE id_user = $id_seller");
$seller = $req->fetch();
?>
<div class="row">
    <div class="pageproduit col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div id="date">
            <i>Mise en ligne le <?php
            $array = explode(" ", $item['date']);
            $date = explode("-",$array[0]);
            $new_date = "$date[2]-$date[1]-$date[0]";
            echo $new_date;
                ?> </i>
        </div>
        <h4><?php echo $item['name']; ?></h4>
        <article>
            <div id="categorie"><?php echo $item['category']; ?></div>  <br>
            <i><?php echo $item['brand']; ?></i> <br>
            <span id="price"><?php echo $item['price']; ?> €<br></span>
                <b>Etat :</b> <?php echo $item['status']; ?>
                <b>Date d'achat :</b> <?php
                    if(isset($item['purchase_date'])) {
                        $array = explode(" ", $item['purchase_date']);
                        $date = explode("-",$array[0]);
                        $new_date = "$date[2]-$date[1]-$date[0]";
                        echo $new_date;
                    } else {echo "Non renseigné";}
                    ?>
                <b>Reçu :</b> <?php echo $item['receipt']; ?>
                <b>Garantie :</b> <?php echo $item['warrantly']; ?><br>
            <img src="<?php echo $item['photo']; ?>" alt="" width="300">
            <hr>
            <p id="description">
                <?php echo $item['description']; ?> <br>
            </p>
            <hr>
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
                    }
                    if(in_array($item['id_item'],$_SESSION['cart'])){
                        echo "Ce produit a déjà été ajouté à votre panier.";
                    }
                    else{
                        echo "Produit ajouté au panier";
                        array_push($_SESSION['cart'], $item['id_item']);
                    }
                }
            }
        ?>
    </div>
</div>

<?php
include ('./includes/footer.html');
?>