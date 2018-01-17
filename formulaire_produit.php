<?php
session_start();
require('./includes/init.php');

if(isset($_SESSION['id'])) {
    ?>
    <form enctype="multipart/form-data" action="" method="post">
        <label for="name">Titre</label><br>
        <input type="text" name="name" id="name" value="<?php if (isset($_POST['name'])) {
            echo $_POST['name'];
        } ?>"><br>
        <label for="category">Catégorie</label><br>
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
        </select><br>
        <label for="brand">Marque</label><br>
        <input type="text" name="brand" id="brand" value="<?php if (isset($_POST['brand'])) {
            echo $_POST['brand'];
        } ?>"><br>
        <label for="price">Prix</label><br>
        <input type="text" name="price" id="price" value="<?php if (isset($_POST['price'])) {
            echo $_POST['price'];
        } ?>"><br>
        <label for="status">Etat</label><br>
        <select name="status" id="status">
            <option value="Neuf" selected>Neuf</option>
            <option value="TresBonEtat">Très Bon Etat</option>
            <option value="BonEtat">Bon Etat</option>
            <option value="Use">Usé</option>
            <option value="TresUse">Très Usé</option>
        </select><br>
        <label for="description">Description</label><br>
        <textarea name="description" id="description" cols="30" rows="10"><?php if (isset($_POST['description'])) {
                echo $_POST['description'];
            } ?></textarea><br>
        <label for="receipt">Reçu</label><br>
        <input type="radio" name="receipt" value="Oui">Oui
        <input type="radio" name="receipt" value="Non">Non <br>
        <label for="warrantly">Garantie</label><br>
        <input type="radio" name="warrantly" value="Oui">Oui
        <input type="radio" name="warrantly" value="Non">Non <br>
        <label for="username">purchase_date</label><br>
        <input type="date" name="purchase_date" id="purchase_date"><br>
        <input type="file" name="photo"><br>
        <!--<label for="delivery">Mode de livraison</label><br>
        <select name="delivery" id="delivery">
            <option value="">Envoi par lettre suivi</option>
            <option value="">Envoi par lettre recommandée avec demande d'avis de réception  R1</option>
            <option value="">Envoi par lettre recommandée avec demande d'avis de réception  R2</option>
            <option value="">Envoi par lettre recommandée avec demande d'avis de réception  R3</option>
            <option value="">Chronopost</option>
            <option value="">Colissimo</option>
            <option value="">Remise en mains propres</option>
        </select><br><br>-->
        <input type="submit" content="Publier l'annonce">
    </form>
    <?php
    if ((isset($_POST)) && (!empty($_POST['name'])) && (!empty($_POST['category'])) && (!empty($_POST['brand']))
        && (!empty($_POST['price'])) && (!empty($_POST['status'])) && (!empty($_POST['description']))
        && (!empty($_POST['receipt'])) && (!empty($_POST['warrantly'])) && (!empty($_FILES['photo']))
    ) {
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

                    $request = $db->prepare("INSERT INTO item (name, date, category, brand, price, status, description, receipt, warrantly, purchase_date, id_seller, photo) VALUES (:name, NOW(), :category, :brand, :price, :status, :description,
    :receipt, :warrantly, :purchase_date, :seller, :photo)");
                    $request->execute([
                        ':name' => $_POST['name'],
                        ':category' => $_POST['category'],
                        ':brand' => $_POST['brand'],
                        ':price' => $_POST['price'],
                        ':status' => $_POST['status'],
                        ':description' => $_POST['description'],
                        ':receipt' => $_POST['receipt'],
                        ':warrantly' => $_POST['warrantly'],
                        ':purchase_date' => $_POST['purchase_date'],
                        ':seller' => $_SESSION['id'],
                        ':photo' => $new_path
                    ]);
                    print_r($request->errorInfo());
                    echo "annonce publiée !";
                }
            }
        }
    }
}
else {
        header('Location: connexion.php');
    }


?>