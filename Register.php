<?php
include "Validation.php";
include "DbAdmin.php";
$validate = new Validation();
$db = new DbAdmin();
$errors = null;
if(isset($_POST['submit']))
{   $name = $validate->validationOnText($_POST['name']);
    if($name == false) $errors['name'] = "Pls Enter This Field";
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Pls Enter an email";
    $pass = $validate->validationOnPassword($_POST['Password']);
    if($pass == false) $errors['pass'] = "the pasword should more than 7";
    $vkey = md5(time().$name);
    if($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $pass) 
    {
        $data = array("name" => $name,"email" => $email, "password" => $pass, "vkey"=>$vkey);
        if(!empty($row = mysqli_fetch_assoc($db->getUSer($email))))
        {
            $errors['register'] = "The Data You Entered Is invalid pls try again or changer the email you entered ";
        }
        else{
            if($db->insert($data)){
                header('location: Login.php');
                exit;            
            }
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
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['register']))
                    echo "*".$errors['register'];
                    ?></small></p>
                    <label for = "name">Name</label>
                    <input type = "text" name="name" id="name" required placeholder="Enter Your Name">
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['name']))
                    echo "*".$errors['name'];
                    ?></small></p>
                    <label for = "name">Email</label>
                    <input type = "text" name="email" id="email" required placeholder="Enter Your Email">
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['email']))
                    echo "*".$errors['email'];
                    ?></small></p>
                    <label for = "pass">PassWord</label>
                    <input type="Password" name="Password" id="Password" required placeholder="Enter Your Password">
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['pass']))
                    echo "*".$errors['pass'];
                    ?></small></p>
                    <input type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
    </body>
</html>