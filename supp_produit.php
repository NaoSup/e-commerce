<?php
session_start();
require('./includes/init.php');
$id_item = $_GET['id_item'];
$request = $db->query("DELETE FROM item WHERE id_item = $id_item");
header('Location: membre.php');