<?php
session_start();
include "DbAdmin.php";
include "Validation.php";
$db = new DbAdmin();
$valid = new Validation();
$errors = null;
if(isset($_POST['submit']))
{
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors['email'] = "Thit is invalid email" ;
    $hashedPass = $valid->validationOnPassword($_POST['Password']);
    if($hashedPass == false) $errors['pass'] = "The password should be more than 7 char";
    if(filter_var($email,FILTER_VALIDATE_EMAIL) && $hashedPass){
        if($db->chick($email, $hashedPass)){
            $result = $db->getUSer($email);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['name'] = $row['Name'];
            $_SESSION['id'] = $row['ID'];
            if(!empty($_POST['remimber'])){
                setcookie("id",$row['ID'],time()+604800);
                setcookie("name",$row['Name'],time()+604800);
                setcookie("password",$_POST['Password'],time()+604800);
            }
        else{
            $errors['login'] = "You put invalid email or Wrong password pls try again";
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
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['login']))
                    echo "*".$errors['login'];
                    ?></small></p>
                    <label for = "email">Email</label>
                    <input type = "text" name="email" id="email" required placeholder="Enter Your Email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>">
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['email']))
                    echo "*".$errors['email'];
                    ?></small></p>
                    <label for = "pass">PassWord</label>
                    <input type="Password" name="Password" id="Password" required placeholder="Enter Your Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['pass']))
                    echo "*".$errors['pass'];
                    ?></small></p>
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