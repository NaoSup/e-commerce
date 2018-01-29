<?php

session_start();
include("includes/init.php");
include('./includes/header.html');
include ('./includes/footer.html');

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
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
