<?php
    session_start();
    include "Database.php";
    include  "Validation.php";
    include "FilterImages.php";
    if(empty($_SESSION['name']))
    {
        header("location: Login.php");
        exit;
    }
    $db = new Database();
    $valid = new Validation();
    $filter = new FilterImages();
    $result = $db->select();
    
    if(isset($_POST['Submit'])){
        $email = $valid->validationOnEmail($_POST['email']);
        $name = $valid->validationOnText($_POST['name']);
        $ID = $valid->validationOnInteger($_POST['id']);
        if($filter->setName($_FILES['img']['name'],$ID)  && $filter->setLocation($_FILES['img']['tmp_name'])){
            echo "<br>". $filter->getName() ."<br>";
            $filter->save();
        }
        if($email && $name && $ID)
        {
            $chick = $db->insert($_POST);
            $result = $db->select();
        }
    }
    
    if(isset($_GET['search'])){
        $result = $db->search($_GET['input']);
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
                    <?php
                    // duplication code for error because of unique user name 
                    if(isset($_POST['Submit']))
                    {
                        if($chick == false) 
                        {
                            echo "<p>There was an error accoured</p>";
                            echo $chick ."<br>";
                        }
                    }
                    ?>
                    <label>Name</label>
                    <input name="name" type="text" placeholder = "Enter The Name" >
                    <label>ID</label>
                    <input name="id" type="text" maxlength = 9 placeholder = "Enter the ID Here" >
                    <label>Email</label>
                    <input name="email" type = "email" placeholder = "Enter the E-Mail" >
                    <label>Picture</label>
                    <input type="file" name="img">
                    <input type = "submit" value = "Submit" name= "Submit">
                </Form>
                
            </div>

            <div class = "Table-Parent">
                <div>
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
                                <a href="delete.php?id=<?=$row['ID'];?>"> Delete</a>
                            </td>
                            <td><img src="Upload/Images/<?= $row['ID'];?>.png" width="10px" height="10px"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
