<?php
include "Database.php";
$db = new Database();
$id = $_GET['search'];
var_dump($db->user($id));
