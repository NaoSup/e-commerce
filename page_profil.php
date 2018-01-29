<?php require('includes/header.php');
include('./includes/header.html');
include ('./includes/footer.html');



$id = $_SESSION['id'];
$req = $db->query("SELECT * FROM user WHERE id_user = $id");
$user = $req->fetch();
?>





<h1>Mes coordonnées</h1>



</body>
</html>

