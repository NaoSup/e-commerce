<?php
session_start();
require('./includes/init.php');
include('./includes/header.php');
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $req = $db->query("SELECT * FROM user where id_user = $id");
    $user = $req->fetch();
    if((!empty($user['date_of_birth'])) && (!empty($user['address']))
    && (!empty($user['postal_code'])) && (!empty($user['city'])) && (!empty($user['country']))
    && (!empty($user['phone']))) {
    ?>
<div class="form-style-10">
    <h1>Ajouter un produit</h1>
    <form enctype="multipart/form-data" action="" method="post">
        <label for="name">Titre</label>
        <input type="text" name="name" id="name" value="<?php if (isset($_POST['name'])) {
            echo $_POST['name'];
        } ?>"><br>
        <label for="category">Catégorie</label>
        <select name="category" id="category">
            <optgroup label="Jeux">
                <option value="ps4">PS4</option>
                <option value="ps3">PS3</option>
                <option value="xbox one">Xbox One</option>
                <option value="xbox 360">Xbox 360</option>
                <option value="switch">Switch</option>
                <option value="3DS-2DS">3DS/2DS</option>
                <option value="pc">PC</option>
                <option value="autres">Autres</option>
            </optgroup>
        </select>
        <label for="brand">Marque/Editeur</label>
        <input type="text" name="brand" id="brand" value="<?php if (isset($_POST['brand'])) {
            echo $_POST['brand'];
        } ?>">
        <label for="price">Prix (en euros)</label>
        <input type="text" name="price" id="price" value="<?php if (isset($_POST['price'])) {
            echo $_POST['price'];
        } ?>">
        <label for="status">Etat</label>
        <select name="status" id="status">
            <option value="Neuf" selected>Neuf</option>
            <option value="Très Bon Etat">Très Bon Etat</option>
            <option value="Bon Etat">Bon Etat</option>
            <option value="Usé">Usé</option>
        </select>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"><?php if (isset($_POST['description'])) {
                echo $_POST['description'];
            } ?></textarea>
        <label for="receipt">Reçu</label>
        <input type="radio" name="receipt" value="Oui">Oui
        <input type="radio" name="receipt" value="Non">Non
        <label for="warranty">Garantie</label>
        <input type="radio" name="warranty" value="Oui">Oui
        <input type="radio" name="warranty" value="Non">Non
        <label for="username">Date d'achat</label>
        <input type="date" name="purchase_date" id="purchase_date">
        <input type="file" name="photo">
        <br><br>
        <input type="submit" content="Publier l'annonce">
    </form>
</div>
    <?php
    if ((isset($_POST)) && (!empty($_POST['name'])) && (!empty($_POST['category'])) && (!empty($_POST['brand']))
        && (!empty($_POST['price'])) && (!empty($_POST['status'])) && (!empty($_POST['description']))
        && (!empty($_POST['receipt'])) && (!empty($_POST['warranty'])) && (!empty($_FILES['photo']))
    ) {
        if(empty($_POST['purchase_date'])){
            $date = NULL;
        }
        else {
            $date = $_POST['purchase_date'];
        }
        $directory = 'img/';
        $extensions = array('png', 'jpeg', 'jpg', 'JPG'); //extension autorisé pour les images.
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

                    $request = $db->prepare("INSERT INTO item (name, date, category, brand, price, status, description, receipt, warranty, purchase_date, id_seller, photo) VALUES (:name, NOW(), :category, :brand, :price, :status, :description,
    :receipt, :warranty, :purchase_date, :seller, :photo)");
                    $request->execute([
                        ':name' => $_POST['name'],
                        ':category' => $_POST['category'],
                        ':brand' => $_POST['brand'],
                        ':price' => $_POST['price'],
                        ':status' => $_POST['status'],
                        ':description' => $_POST['description'],
                        ':receipt' => $_POST['receipt'],
                        ':warranty' => $_POST['warranty'],
                        ':purchase_date' => $date,
                        ':seller' => $_SESSION['id'],
                        ':photo' => $new_path
                    ]);
                    echo "annonce publiée !". "<br><br>";
                }
            }
        }
    }
}
else {
    echo "";
    ?>
    <p id="membre">
        Pour pouvoir ajouter une annonce, veuillez <a href="modif_membre.php">remplir votre profil</a>.
    </p>
    <?php
}
}
else {
        header('Location:connexion.php');
    }

include ('./includes/footer.html');

?>

</body>
</html>
