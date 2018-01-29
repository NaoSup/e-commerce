<?php
session_start();
require('./includes/init.php');
include('./includes/header.html');
include ('./includes/footer.html');


?>

<h1 style="margin-left: 46%">Itech Area</h1>


<?php
if (isset($_SESSION['id'])){
    ?>
    <?php
}
else{
    ?>
    <p>Vous n'avez pas de compte chez ITECH AREA, alors qu'attendez vous pour vous inscrire? Allez cliquer ici <a href="inscription.php">Inscription</a></p>

    <?php
}
?>

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
                    <div class="col-md-2">
                <div class="card card-simple">
                    <img src="<?php echo $item['photo'] ?>" alt="" width="200px" height="120px">
                    <h3><?php echo $item['name'] ?></h3>
                    <h4><?php echo $item['category'] ?></h4>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>

