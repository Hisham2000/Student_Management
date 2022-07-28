<?php
include "Database.php";
$db = new Database();
$check = $db->delete($_GET['id']);
header("location: index.php");
exit;