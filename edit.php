<?php
session_start();
include "DbStudent.php";
include "Validation.php";
if(empty($_SESSION['name'])){
    header("location: Login.php");
    exit;
}
$db = new DbStudent();
$valid = new Validation();
$data = mysqli_fetch_assoc($db->user($_GET['id']));
if(isset($_POST['submit'])){
    $email = $valid->validationOnEmail($_POST['email']);
    $name = $valid->validationOnText($_POST['name']);
    if($email && $name){
        $id = $_GET['id'];
        $db->update($_POST,$id);
        header("location: index.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link href="Css/Student.css" rel="stylesheet">
    </head>
    <body>
    <a href="logout.php">LogOut</a>
        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?=$data['Name'];?>">
            <label>Email</label>
            <input type="email" name="email" value="<?=$data['Email'];?>">
            <input type="submit" value="Edit" name="submit">
        </form>
    </body>
</html>