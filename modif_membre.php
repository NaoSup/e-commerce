<?php
session_start();
require('./includes/init.php');
?>
<!DOCTYPE HTML>
<html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Accueil TechArea</title>
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
<?php
$id = $_SESSION['id'];
$req = $db->query("SELECT * FROM user WHERE id_user = $id");
$user = $req->fetch();
?>
<h3>Modifier votre photo de profil</h3>
<form enctype="multipart/form-data" action="" method="post" >
    <?php
    if(isset($user['photo'])){
        ?>
    <img src="<?php echo $user['photo'] ?>" alt="" width="100px">
        <?php
        }
        else {
        ?>
            <img src="./img/anon.png" alt="" width="100px">

            <?php
        }
        ?>
    <br><br>
    <input type="file" name="photo"><br><br>
    <input type="submit" value="Modifier ma photo" name="sub_photo">
</form>
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

                    $request = $db->prepare("UPDATE user SET photo = :photo WHERE id_user = $id");
                    $request->execute([
                        ':photo' => $new_path
                    ]);
                    header("Refresh:0");
                }
            }
        }
    }
?>
<h3>Modifier vos informations personnelles</h3>
<form action="" method="post" name="infos">
    <label for="username">Pseudo</label><br>
    <input type="text" name="username" id="username" value="<?php echo $user['username'];?>" disabled><br><br>
    <label for="last_name">Nom</label><br>
    <input type="text" name="last_name" id="last_name" value="<?php if (isset($user['last_name'])) {echo $user['last_name'];} ?>"><br><br>
    <label for="first_name">Prénom</label><br>
    <input type="text" name="first_name" id="first_name" value="<?php if (isset($user['first_name'])) {echo $user['first_name'];} ?>"><br><br>
    <label for="mail">Adresse mail</label><br>
    <input type="email" name="mail" id="mail" value="<?php if (isset($user['mail'])) {echo $user['mail'];} ?>"><br><br>
    <label for="birth">Date de naissance</label><br>
    <input type="date" name="birth" id="birth" value="<?php if(isset($user['date_of_birth'])){echo $user['date_of_birth'];} ?>"><br><br>
    <label for="address">Adresse</label><br>
    <input type="text" name="address" id="address"value="<?php if(isset($user['address'])){echo $user['address'];} ?>"><br><br>
    <label for="details">Autres informations (bâtiment, appt, escaliers,...) <i>(facultatif)</i></label><br>
    <input type="text" name="details" id="details" value="<?php if(isset($user['details'])){echo $user['details'];} ?>"><br><br>
    <label for="postal_code">Code Postal</label><br>
    <input type="number" name="postal_code" id="postal_code" value="<?php if(isset($user['postal_code'])){echo $user['postal_code'];}?>"><br><br>
    <label for="city">Ville</label><br>
    <input type="text" name="city" id="city" value="<?php if(isset($user['city'])){echo $user['city'];} ?>"><br><br>
    <label for="country">Pays</label><br>
    <input type="text" name="country" id="country" value="<?php if(isset($user['country'])){echo $user['country'];} ?>"><br><br>
    <label for="phone">Phone</label><br>
    <input type="number" name="phone" id="phone" value="<?php if(isset($user['phone'])){echo $user['phone'];} ?>"><br><br>
    <input type="submit" value="Modifier mes infos" name="sub_infos">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: npaul
 * Date: 10/01/2018
 * Time: 21:10
 */
//on convertit la date pour la mettre au format de la bdd
/*$array = explode("-", $_POST['birth']);
$day = $array[0];
$month = $array[1];
$year = $array['2'];
$date = $year . "-" . $month . "-" . $day;*/
if((isset($_POST['sub_infos'])) && (!empty($_POST['last_name'])) && (!empty($_POST['first_name']))
    && (!empty($_POST['mail'])) && (!empty($_POST['birth'])) && (!empty($_POST['address'])) && (!empty($_POST['postal_code']))
    && (!empty($_POST['city'])) && (!empty($_POST['country'])) && (!empty($_POST['phone']))) {
    echo "test";
    $request = $db->prepare("UPDATE user SET last_name = :last_name, first_name = :first_name, mail = :mail, date_of_birth = :birth, address = :address, details = :details, postal_code = :postal_code, city = :city, country = :country, phone = :phone WHERE id_user = $id");
    $request->execute([
        ':last_name' => $_POST['last_name'],
        ':first_name' => $_POST['first_name'],
        ':mail' => $_POST['mail'],
        ':birth' => $_POST['birth'],
        ':address' => $_POST['address'],
        ':details' => $_POST['details'],
        ':postal_code' => $_POST['postal_code'],
        ':city' => $_POST['city'],
        ':country' => $_POST['country'],
        ':phone' => $_POST['phone']
    ]);
    print_r($request->errorInfo());
    echo "Vos mises à jour ont été prise en compte";
}
?>
<a href="supp_membre.php">Supprimer mon compte</a> <span>Attention ! Cette action est irréversible.</span>
