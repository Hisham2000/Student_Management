<?php
session_start();
include "Database.php";
if(empty($_SESSION['name'])){
    header("location: index.php");
    exit;
}
$db = new Database();
$check = $db->delete($_GET['id']);
header("location: index.php");
exit;