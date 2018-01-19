<?php
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
            <li><a href="Connexion">Connexion</a></li>
        </ul>
    </div>

    <h2>Inscription</h2>
    <form action="" method="post">
        <label for="username">Pseudo</label><br>
        <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) {
            echo $_POST['username'];
        } ?>"><br>
        <label for="last_name">Nom</label><br>
        <input type="text" name="last_name" id="last_name" value="<?php if (isset($_POST['last_name'])) {
            echo $_POST['last_name'];
        } ?>"><br>
        <label for="first_name">Prénom</label><br>
        <input type="text" name="first_name" id="first_name" value="<?php if (isset($_POST['first_name'])) {
            echo $_POST['first_name'];
        } ?>"><br>
        <label for="mail">Adresse mail</label><br>
        <input type="email" name="mail" id="mail" value="<?php if (isset($_POST['mail'])) {
            echo $_POST['mail'];
        } ?>"><br>
        <label for="mail2">Confirmation de l'adresse mail</label><br>
        <input type="email" name="mail2" id="mail2" value="<?php if (isset($_POST['mail2'])) {
            echo $_POST['mail2'];
        } ?>"><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password"><br>
        <label for="password2">Confirmation mot de passe</label><br>
        <input type="password" name="password2" id="password2"><br>

        <input type="submit" content="S'inscrire">
    </form>
<?php
//Vérification que les champs obligatoires sont bien remplis
if ((isset($_POST)) && (!empty($_POST['username'])) && (!empty($_POST['last_name'])) && (!empty($_POST['first_name']))
    && (!empty($_POST['mail'])) && (!empty($_POST['mail2'])) && (!empty($_POST['password'])) && (!empty($_POST['password2']))
) {
    //Vérification que les adresses mail sont identiques
    if ($_POST['mail'] != $_POST['mail2']) {
        echo "Les adresses mail ne sont pas identiques";
    } else {
        $password = crypt($_POST['password'], '$2a$07$azds8dfbn2sdseferd54gfhjkelqa$');
        $password2 = crypt($_POST['password2'], '$2a$07$azds8dfbn2sdseferd54gfhjkelqa$');
        //Vérification que les mots de passe sont identiques
        if ($password != $password2) {
            echo "Les mots de passe ne sont pas identiques";
        } else {
            //Envoi des données en bdd
            $request = $db->prepare("INSERT INTO user (username, last_name, first_name, mail, password) VALUES (:username, :last_name, :first_name, :mail, :password)");
            $request->execute([
                ':username' => $_POST['username'],
                ':last_name' => $_POST['last_name'],
                ':first_name' => $_POST['first_name'],
                ':mail' => $_POST['mail'],
                ':password' => $password,
            ]);
            //print_r($request->errorInfo());
            echo "Inscrit";
            ?>
            <p>Vous pouvez vous <a href="connexion.php">connecter</a>.</p>
            <?php
            //Redirection (header) vers l'index à rajouter une fois créé
        }
    }
}

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
