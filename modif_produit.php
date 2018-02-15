<?php
session_start();
require('./includes/init.php');
include('./includes/header.php');

?>


<?php
$id_item = $_GET['id_item'];
$req = $db->query("SELECT * FROM item WHERE id_item = $id_item");
$item = $req->fetch();
?>

<div class="form-style-10">
<h3>Modifier votre photo d'annonce</h3>
<form enctype="multipart/form-data" action="" method="post" >
    <?php
    if(isset($item['photo'])){
        ?>
        <img src="<?php echo $item['photo'] ?>" alt="" width="100px">
        <?php
    }
    else {
        ?>
        <img src="./img/no_photo.png" alt="" width="100px">

        <?php
    }
    ?>
    <br><br>
    <input type="file" name="photo"><br><br>
    <input type="submit" value="Modifier la photo" name="sub_photo">
</form>
</div>
<?php

if(isset($_POST['sub_photo']) && !empty($_FILES['photo'])){
    echo "test";
    $directory = 'img/';
    $extensions = array('png', 'jpeg', 'jpg'); //extension autorisé pour les images.
    $mimes = array('image/png', 'image/jpeg'); //extension autorisé pour les images

    // Vérifier le typemime du fichier qui sera uploadé
    $verifymime = finfo_open(FILEINFO_MIME_TYPE); // vérifier le mime
    $mime = finfo_file($verifymime, $_FILES['photo']['tmp_name']); // regarder dans ce fichier le type mime
    if (!in_array($mime, $mimes)) {
        echo "Ce type de fichier n'est pas autorisé";
        finfo_close($verifymime); //Une fois vérifié on arrête la lecture
    } else {
        finfo_close($verifymime); //Une fois vérifié on arrête la lecture
        $tableau = explode('.', $_FILES['photo'] ['name']); // on fait un tableau
        $imagename = $_FILES['photo']['name']; //Nom réel de l'image
        $extension = $tableau[1];
        $old_path = $_FILES['photo'] ['tmp_name']; //Nom temporaire donné par le serveur
        $imagetype = $_FILES['photo'] ['type']; // type de l'image
        $imagesize = $_FILES['photo'] ['size']; // poids de l'image
        if (!in_array($extension, $extensions)) {
            echo "Ce type de fichier n'est pas de la bonne extension";
        } else {
            //Vérifions si le fichier est supérieur à 8Mo
            $taille_maxi = 8000000; // taille maximum autorisé par le serveur.
            if ($imagesize > $taille_maxi) {
                echo "Désolé le fichier est trop gros..";
            } else {
                $newname = "photo" . uniqid();
                $finalname = $newname . '.' . $extension;
                $new_path = $directory . $finalname;
                move_uploaded_file($old_path, $new_path);

                $request = $db->prepare("UPDATE item SET photo = :photo WHERE id_item = $id_item");
                $request->execute([
                    ':photo' => $new_path
                ]);
                header("Refresh:0");
            }
        }
    }
}
?>
<div class="form-style-10">
<h3>Modifier votre annonce</h3>
<form action="" method="post" name="infos">
    <label for="name">Titre de l'annonce</label>
    <input type="text" name="name" id="name" value="<?php if (isset($item['name'])) {echo $item['name'];} ?>"><br><br>
    <label for="category">Catégorie</label>
    <select name="category" id="category">
        <optgroup label="Jeux">
            <option value="ps4" <?php if($item['category'] == "ps4"){echo "selected";} ?>>PS4</option>
            <option value="ps3" <?php if($item['category'] == "ps3"){echo "selected";} ?>>PS3</option>
            <option value="xbox one" <?php if($item['category'] == "xbox one"){echo "selected";} ?>>Xbox One</option>
            <option value="xbox 360" <?php if($item['category'] == "xbox 360"){echo "selected";} ?>>Xbox 360</option>
            <option value="switch" <?php if($item['category'] == "switch"){echo "selected";} ?>>Switch</option>
            <option value="3DS-2DS" <?php if($item['category'] == "3DS-2DS\""){echo " selected";} ?>>3DS/2DS</option>
            <option value="pc" <?php if($item['category'] == "pc"){echo "selected";} ?>>PC</option>
            <option value="autres" <?php if($item['category'] == "autres"){echo "selected";} ?>>Autres</option>
        </optgroup>
    </select><br>
    <label for="brand">Marque/Editeur</label>
    <input type="text" name="brand" id="brand" value="<?php if (isset($item['brand'])) {echo $item['brand'];} ?>"><br><br>
    <label for="price">Prix (en euros)</label>
    <input type="text" name="price" id="price" value="<?php if (isset($item['price'])) {echo $item['price'];} ?>"><br><br>
    <label for="status">Etat</label>
    <select name="status" id="status">
        <option value="Neuf" <?php if($item['status'] == "Neuf"){echo "selected";} ?>>Neuf</option>
        <option value="TresBonEtat" <?php if($item['status'] == "TresBonEtat"){echo "selected";} ?>>Très Bon Etat</option>
        <option value="BonEtat" <?php if($item['status'] == "BonEtat"){echo "selected";} ?>>Bon Etat</option>
        <option value="Use" <?php if($item['status'] == "Use\""){echo " selected";} ?>>Usé</option>
    </select><br>
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"><?php if (isset($item['description'])) {
            echo $item['description'];
        } ?></textarea><br>
    <label for="receipt">Reçu</label>
    <input type="radio" name="receipt" value="Oui" checked="<?php if($item['receipt'] == "Oui"){echo "checked";} ?>">Oui
    <input type="radio" name="receipt" value="Non" checked="<?php if($item['receipt'] == "Non"){echo "checked";} ?>">Non <br>
    <label for="warrantly">Garantie</label>
    <input type="radio" name="warranty" value="Oui" checked="<?php if($item['warranty'] == "Oui"){echo "checked";} ?>">Oui
    <input type="radio" name="warranty" value="Non" checked="<?php if($item['warranty'] == "Non"){echo "checked";} ?>">Non <br>
    <label for="username">Date d'achat</label>
    <input type="date" name="purchase_date" id="purchase_date" value="<?php echo $item['purchase_date'];?>"><br>
    <input type="submit" value="Modifier mes infos" name="sub_infos">
</form>
</div>

<?php
if((isset($_POST)) && (!empty($_POST['name'])) && (!empty($_POST['category'])) && (!empty($_POST['brand']))
    && (!empty($_POST['price'])) && (!empty($_POST['status'])) && (!empty($_POST['description']))
    && (!empty($_POST['receipt'])) && (!empty($_POST['warranty']))) {
    $request = $db->prepare("UPDATE item SET name = :name, category= :category, brand = :brand, price = :price, status = :status, description = :description, receipt = :receipt, warranty = :warranty WHERE id_item = $id_item");
    $request->execute([
        ':name' => $_POST['name'],
        ':category' => $_POST['category'],
        ':brand' => $_POST['brand'],
        ':price' => $_POST['price'],
        ':status' => $_POST['status'],
        ':description' => $_POST['description'],
        ':receipt' => $_POST['receipt'],
        ':warranty' => $_POST['warranty']
    ]);
    echo "Vos mises à jour ont été prise en compte";
}
?>
<a href="supp_produit.php?id_item=<?php echo $item['id_item'];?>">Supprimer cette annonce</a> <span>Attention ! Cette action est irréversible.</span>

<?php
include ('./includes/footer.html');
?>