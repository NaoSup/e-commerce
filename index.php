<?php
session_start();
require('./includes/init.php');

$req = $db->query("SELECT * FROM item ORDER BY date desc");
$items = $req->fetchAll();
foreach ($items as $item) {
    $seller = $item['id_seller'];
    $req = $db->query("SELECT * FROM user WHERE id_user = $seller");
    $user = $req->fetch();
    ?>
    <div class="item">
        <img src="<?php echo $item['photo'] ?>" alt="" width="200px">
        <h3><?php echo $item['name'] ?></h3>
        <h4><?php echo $item['category'] ?></h4>
        <p><?php echo $item['price'] ?>€</p>
    </div>
    <?php
}
    ?>
