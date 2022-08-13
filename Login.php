<?php
session_start();
include "DbAdmin.php";
include "Validation.php";
$db = new DbAdmin();
$valid = new Validation();
if(isset($_POST['submit']))
{
    $id = $valid->validationOnInteger($_POST['ID']);
    $name = $valid->validationOnText($_POST['name']);
    $Password = $valid->validationOnPassword($_POST['Password']);
    if($name && $Password && $id){
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        if($db->chick($id, $name, $Password)){
            if(!empty($_POST['remimber'])){
                setcookie("id",$id,time()+604800);
                setcookie("name",$name,time()+604800);
                setcookie("password",$Password,time()+604800);
            }
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
                    <label for = "name">ID</label>
                    <input type = "text" name="ID" id="ID" required placeholder="Enter Your ID" value="<?php if(isset($_COOKIE["id"])) { echo $_COOKIE["id"]; } ?>">
                    <label for = "name">Name</label>
                    <input type = "text" name="name" id="name" required placeholder="Enter Your Name" value="<?php if(isset($_COOKIE["name"])) { echo $_COOKIE["name"]; } ?>">
                    <label for = "pass">PassWord</label>
                    <input type="Password" name="Password" id="Password" required placeholder="Enter Your Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                    <input type="checkbox" id="remimber" name="remimber" value="remimber">
                    <label for="remimber">Remimber Me</label>
                    <input type="submit" name="submit" value="submit">s
                    <br>
                    <a style="position: relative ;left: 45%;" href="Register.php">Create a new account</a>
                </form>
                
            </div>
        </div>
    </body>
</html>