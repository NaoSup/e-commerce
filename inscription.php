<?php
require('./includes/init.php');
?>

<h2>Inscription</h2>
<form action="" method="post">
    <label for="username">Pseudo</label><br>
    <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>"><br>
    <label for="last_name">Nom</label><br>
    <input type="text" name="last_name" id="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>"><br>
    <label for="first_name">Prénom</label><br>
    <input type="text" name="first_name" id="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>"><br>
    <label for="mail">Adresse mail</label><br>
    <input type="email" name="mail" id="mail" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>"><br>
    <label for="mail2">Confirmation de l'adresse mail</label><br>
    <input type="email" name="mail2" id="mail2" value="<?php if(isset($_POST['mail2'])){echo $_POST['mail2'];} ?>"><br>
    <label for="password">Mot de passe</label><br>
    <input type="password" name="password" id="password"><br>
    <label for="password2">Confirmation mot de passe</label><br>
    <input type="password" name="password2" id="password2"><br>
    <label for="birth">Date de naissance</label><br>
    <input type="date" name="birth" id="birth"><br>
    <label for="address">Adresse</label><br>
    <input type="text" name="address" id="address"value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>"><br>
    <label for="details">Autres informations (bâtiment, appt, escaliers,...) <i>(facultatif)</i></label><br>
    <input type="text" name="details" id="details" value="<?php if(isset($_POST['details'])){echo $_POST['details'];} ?>"><br>
    <label for="postal_code">Code Postal</label><br>
    <input type="text" name="postal_code" id="postal_code" value="<?php if(isset($_POST['postal_code'])){echo $_POST['postal_code'];}?>"><br>
    <label for="city">Ville</label><br>
    <input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>"><br>
    <label for="country">Pays</label><br>
    <input type="text" name="country" id="country" value="<?php if(isset($_POST['country'])){echo $_POST['country'];} ?>"><br>
    <label for="phone">Phone</label><br>
    <input type="text" name="phone" id="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"><br>
    <label for="company">Entreprise <i>(facultatif)</i></label><br>
    <input type="text" name="company" id="company" value="<?php if(isset($_POST['company'])){echo $_POST['company'];} ?>"><br>
    <input type="submit" content="S'inscrire">
</form>
<?php
//Vérification que les champs obligatoires sont bien remplis
if ((isset($_POST)) && (!empty($_POST['username'])) && (!empty($_POST['last_name'])) && (!empty($_POST['first_name']))
    && (!empty($_POST['mail'])) && (!empty($_POST['mail2'])) && (!empty($_POST['password'])) && (!empty($_POST['password2']))
    && (!empty($_POST['birth'])) && (!empty($_POST['address'])) && (!empty($_POST['postal_code'])) && (!empty($_POST['city']))
    && (!empty($_POST['country'])) && (!empty($_POST['phone']))) {
        //Vérification que les adresses mail sont identiques
        if ($_POST['mail'] != $_POST['mail2']) {
            echo "Les adresses mail ne sont pas identiques";
        }
        else {
            $password = crypt($_POST['password'], '$2a$07$azds8dfbn2sdseferd54gfhjkelqa$');
            $password2 = crypt($_POST['password2'], '$2a$07$azds8dfbn2sdseferd54gfhjkelqa$');
            //Vérification que les mots de passe sont identiques
            if ($password != $password2) {
                echo "Les mots de passe ne sont pas identiques";
            }
            else {
                //on convertit la date pour la mettre au format de la bdd
                $array = explode("-", $_POST['birth']);
                $day = $array[0];
                $month = $array[1];
                $year = $array['2'];
                $date =$year."-".$month."-".$day;
                //Envoi des données en bdd
                $request = $db->prepare("INSERT INTO user (username, last_name, first_name, mail, password, date_of_birth, address, 
                                          details, postal_code, city, country, phone) VALUES (:username, :last_name, :first_name, :mail, :password, :date_of_birth,
                                            :address, :details, :postal_code, :city, :country, :phone)");
                $request->execute([
                    ':username' => $_POST['username'],
                    ':last_name' => $_POST['last_name'],
                    ':first_name' => $_POST['first_name'],
                    ':mail' => $_POST['mail'],
                    ':password' => $password,
                    ':date_of_birth' => $date,
                    ':address' => $_POST['address'],
                    ':details' => $_POST['details'],
                    ':postal_code' => $_POST['postal_code'],
                    ':city' => $_POST['city'],
                    ':country' => $_POST['country'],
                    ':phone' => $_POST['phone']
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
