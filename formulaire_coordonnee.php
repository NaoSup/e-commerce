<?php
session_start();
require('./includes/init.php');
include('./includes/header.php');

?>


<h2>Coordonnée</h2>

<form action="" method="post">
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
    <input type="submit" content="Valider">
</form>


</body>
</html>

<?php
var_dump($_POST);
$request = $db->prepare("INSERT INTO user VALUES (NULL, :address, :details, :postal_code, :city, :country, :phone, :company)");
$sending = $request->execute([
    ':address' => $_POST['address'],
    ':details' => $_POST['details'],
    ':postal_code' => $_POST['postal_code'],
    ':city' => $_POST['city'],
    ':country' => $_POST['country'],
    ':phone' => $_POST['phone'],
    ':company' => $_POST['company']
]);

include ('./includes/footer.html');
?>
