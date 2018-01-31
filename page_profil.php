<?php require('includes/header.php');
include('./includes/header.php');

$id = $_SESSION['id'];
$req = $db->query("SELECT * FROM user WHERE id_user = $id");
$user = $req->fetch();
?>





<h1>Mes coordonnées</h1>



<?php
include ('./includes/footer.html');
?>

</body>
</html>

