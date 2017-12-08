<?php

session_start();
include("includes/init.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
<form action="" method="post">
    <input type="text" name="username" id="username" placeholder="username">
    <input type="password" name="password" id="password" placeholder="password">
    <input type="submit" value="Valider">

</form>
</body>
</html>

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