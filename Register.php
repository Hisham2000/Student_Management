<?php
include "Validation.php";
include "DbAdmin.php";
$validate = new Validation();
$db = new DbAdmin();
if(isset($_POST['submit']))
{   $name = $validate->validationOnText($_POST['name']);
    $id = $validate->validationOnInteger($_POST['ID']);
    $pass = $validate->validationOnPassword($_POST['Password']);
    if($name && $id && $pass) 
    {
        $data = array("name" => $name,"id" => $id, "password" => $pass);
        if($db->insert($data)){
            header('location: Login.php');
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
                    <input type = "text" name="ID" id="ID" required placeholder="Enter Your ID">
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