<?php
session_start();
require('./includes/init.php');
$id = $_SESSION['id'];
$request = $db->query("DELETE FROM user WHERE id_user = $id");
session_destroy();
header('Location: index.php');

