<?php
require('./includes/init.php');
include('./includes/header.html');


?>

<div class="form-style-10">
<h1>Inscription</h1>
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
</div>
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
<div class=""></div>
<?php
include ('./includes/footer.html');
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
