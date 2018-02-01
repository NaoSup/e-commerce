<?php
session_start();
require('./includes/init.php');
include('./includes/header.php');
?>
<div class="accueil">
    <h2>Bienvenue sur ITech Area</h2>
    <h6><i>Retrouvez tous vos jeux préférés en occasion</i></h6>
<?php
if (!isset($_SESSION['id'])){
    ?>
    <p><i>Vous n'avez pas de compte chez ITECH AREA, alors qu'attendez vous pour vous inscrire?</i></p>
        <a id="inscription" href="inscription.php"> > Inscription < </a>
    <?php
}
?>
    </div>
<section id="benefit-fluid-6col-2row" class="pt-125 pb-125 text-center light">
    <div class="container-fluid pad-x2">
        <div class="row">
                <?php
                $req = $db->query("SELECT * FROM item ORDER BY date desc");
                $items = $req->fetchAll();
                foreach ($items as $item) {
                $seller = $item['id_seller'];
                $req = $db->query("SELECT * FROM user WHERE id_user = $seller");
                $user = $req->fetch();
                if(empty($item['id_buyer'])){
                ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 produit">
                <div class="card card-simple">
                    <img src="<?php echo $item['photo'] ?>" alt="">
                    <h3><?php echo $item['name'] ?></h3>
                    <h6><i><?php echo $item['category'] ?></i></h6>
                    <p><?php echo $item['price'] ?>€</p>
                    <a href="page_produit.php?id_item=<?php echo $item['id_item'];?>">+ de détails</a>
                </div>
            </div>
                    <?php
                }
                }
                ?>

        </div>
    </div>
    <div class="bg"></div>
</section>


<?php
include ('./includes/footer.html');
?>
</body>
</html>

