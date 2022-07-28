<?php
include "Database.php";
include "Validation.php";
$db = new Database();
$valid = new Validation();
$data = mysqli_fetch_assoc($db->user($_GET['id']));
if(isset($_POST['submit'])){
    $id = $valid->validationOnInteger($_POST['id']);
    $email = $valid->validationOnEmail($_POST['email']);
    $name = $valid->validationOnText($_POST['name']);
    if($id && $email && $name){
        $db->update($_POST);
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
        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?=$data['Name'];?>">
            <label>ID</label>
            <input type="text" name="id" value="<?=$data['ID'];?>">
            <label>Email</label>
            <input type="email" name="email" value="<?=$data['Email'];?>">
            <input type="submit" value="Edit" name="submit">
        </form>
    </body>
</html>