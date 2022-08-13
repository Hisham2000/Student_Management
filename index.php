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
    $result = $db->select();
    
    if(isset($_POST['Submit'])){
        $email = $valid->validationOnEmail($_POST['email']);
        $name = $valid->validationOnText($_POST['name']);
        $ID = $valid->validationOnInteger($_POST['id']);
        if($filter->setName($_FILES['img']['name'],$ID)  && $filter->setLocation($_FILES['img']['tmp_name'])){
            $filter->save();
            if($email && $name && $ID)
            {
                $data = array("name" => $name,"id" => $ID, "email" => $email, "image" => $filter->getName(),"Ad_id"=>$_SESSION['id']);
                $chick = $db->insert($data);
                $result = $db->select();
            }
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
                    <label>ID</label>
                    <input name="id" type="text" maxlength = 9 placeholder = "Enter the ID Here" required>
                    <label>Name</label>
                    <input name="name" type="text" placeholder = "Enter The Name" required>
                    <label>Email</label>
                    <input name="email" type = "email" placeholder = "Enter the E-Mail" required>
                    <label>Picture</label>
                    <input type="file" name="img" required>
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
                                <a href="delete.php?id=<?=$row['ID'];?>"> Delete</a>
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
