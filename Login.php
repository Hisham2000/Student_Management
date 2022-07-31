<?php
session_start();
include "Database.php";
include "Validation.php";
$db = new Database();
$valid = new Validation();
if(isset($_POST['submit']))
{
    $name = $valid->validationOnText($_POST['name']);
    $Password = $valid->validationOnPassword($_POST['Password']);
    if($name && $Password){
        $_SESSION['name'] = $name;
        if($db->chick($name, $Password)){
            header("location: index.php");
            exit;
        }
    }
}
?>

<!<DOCTYPE html>
<html>
    <header>
        <meta charset="UTF-8">
        <link href="CSS/Student.css" rel="stylesheet"> 
        <style>
            form{
                width: 100%;
                border: 10px solid #CA955C;;
                border-radius:  50px;
                position: absolute;
                top: 25%;
            }
        </style>
    </header>
    <body>
        <div class="Parent" style="width: 100%;">
                <form method="POST">
                    <label for = "name">Name</label>
                    <input type = "text" name="name" id="name" required placeholder="Enter Your Name">
                    <label for = "pass">PassWord</label>
                    <input type="Password" name="Password" id="Password" required placeholder="Enter Your Password">
                    <input type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
    </body>
</html>