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
<label for="photo">Photo de profil</label><br>
<input type="file" name="photo"><br><br>
<?php
/**
 * Created by PhpStorm.
 * User: npaul
 * Date: 10/01/2018
 * Time: 21:10
 */
//on convertit la date pour la mettre au format de la bdd
$array = explode("-", $_POST['birth']);
$day = $array[0];
$month = $array[1];
$year = $array['2'];
$date = $year . "-" . $month . "-" . $day;