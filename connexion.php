<?php

session_start();
include("includes/init.php");
include('./includes/header.php');

?>


    <div class="form-style-10">
    <form action="" method="post">
    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username" placeholder="username"><br>
    <label for="username">Password</label>
    <input type="password" name="password" id="password" placeholder="password"><br>
    <input type="submit" value="Valider">

</form>
    </div>


<?php

if ((isset($_POST)) && (!empty($_POST['username'])) && (!empty($_POST['password']))) {
    $password = crypt($_POST['password'], '$2a$07$azds8dfbn2sdseferd54gfhjkelqa$');
    $request = $db->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
    $request->execute([
        ':username' => htmlentities($_POST['username']),
        ':password' => htmlentities($password)
    ]);
    $result = $request->fetchAll();

    if(count($result) > 0){
        $_SESSION["id"] = $result[0]["id_user"];
        //header location vers accueil ou page membre
        echo "connecté";
    }
    else {
        echo "connexion impossible, veuillez réessayer";
    }
}
include ('./includes/footer.html');

?>

</body>
</html>
