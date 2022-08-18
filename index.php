<?php
    session_start();
    include "DbStudent.php";
    include  "Validation.php";
    include "FilterImages.php";
    if(empty($_SESSION['name']))
    {
        header("location: Login.php");
        exit;
    }
    $db = new DbStudent();
    $valid = new Validation();
    $filter = new FilterImages();
    $result = $db->select($_SESSION['id']);
    $errors = null;
    if(isset($_POST['Submit'])){
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors['email'] = "pls put a valid email";
        $name = $valid->validationOnText($_POST['name']);
        if($name == false) $errors['name'] = "pls fill this field";
        $ID = filter_var($_POST['id'],FILTER_VALIDATE_INT);
        if($ID == false) $errors['id'] = "Please enter an integer number";
        if(empty($row = mysqli_fetch_assoc($db->user($ID))))
        {
            if($filter->setName($_FILES['img']['name'],$ID)  && $filter->setLocation($_FILES['img']['tmp_name'])){
                $filter->save();
                if($email && $name && $ID)
                {
                    $data = array("name" => $name,"id" => $ID, "email" => $email, "image" => $filter->getName(),"Ad_id"=>$_SESSION['id']);
                    if($db->insert($data)) $result = $db->select($_SESSION['id']);
                }
            }
            else{
                $errors['image'] = "please enter an image pls";
            }
        }
        else{
            $errors['save'] = "Something went wrong pls Change the id or try again";
        }
        
    }
    
    if(isset($_GET['search'])){
        $result = $db->search($_GET['input'], $_SESSION['id']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manager System</title>
        <meta charset="UTF-8">
        <link rel = "stylesheet" href = "Css/Student.css" >
    </head>
    <body>
        <div class = "Parent">
            
            <div class = "Form-Parent">

                <Form method="POST" enctype="multipart/form-data">
                    <img src="images/Logo.jpg">
                    <p style="color: red"><small><?php
                    if(!empty($errors['save']))
                    echo "*".$errors['save'];
                    ?></small></p>
                    <label>ID</label>
                    <input name="id" type="text" maxlength = 9 placeholder = "Enter the ID Here" required>
                    <p style="color: red;position: relative; left: 15%"><small><?php
                    if(!empty($errors['id']))
                    echo "*".$errors['id'];
                    ?></small></p>
                    <label>Name</label>
                    <input name="name" type="text" placeholder = "Enter The Name" required>
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['name']))
                    echo "*".$errors['name'];
                    ?></small></p>
                    <label>Email</label>
                    <input name="email" type = "email" placeholder = "Enter the E-Mail" required>
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['email']))
                    echo "*".$errors['email'];
                    ?></small></p>
                    <label>Picture</label>
                    <input type="file" name="img" required>
                    <p style="color: red; position: relative; left: 15%;"><small><?php
                    if(!empty($errors['image']))
                    echo "*".$errors['image'];
                    ?></small></p>
                    <input type = "submit" value = "Submit" name= "Submit" >
                </Form>
                
            </div>

            <div class = "Table-Parent">
                <div>
                    <a href="logout.php">LogOut</a>
                    <form method="GET">
                        <label for="search">search</label>
                        <input type="search" id="search" name="input" placeholder="Search &#128270;">
                        <input type="submit" value="search" name="search">
                    </form>
                    
                </div>
                <table>
                    <thead>
                        <td>Name</td>
                        <td>ID</td>
                        <td>Email</td>
                        <td>Action</td>
                        <td>Images </td>
                    </thead>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class = "row">
                            <td class="data"><?= $row['Name']?></td>
                            <td class="data"><?= $row['ID']?></td>
                            <td class="data"><?= $row['Email']?></td>
                            <td>
                                <a href="edit.php?id=<?=$row['ID'];?>">Edit |</a>
                                <a href="Delete.php?id=<?=$row['ID'];?>&image=<?=$row['image']?>"> Delete</a>
                            </td>
                            <td><img src="Upload/Images/<?= $row['image'];?>" width="10px" height="10px"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
