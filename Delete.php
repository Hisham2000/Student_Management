<?php
session_start();
include "DbStudent.php";
if(empty($_SESSION['name'])){
    header("location: index.php");
    exit;
}
$db = new DbStudent();
$check = $db->delete($_GET['id']);
header("location: index.php");
exit;