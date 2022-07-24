<?php
    require"Constraints.php";
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['id']))
    {
        $db = new Database();
        $db->insert($_POST);
        $result = $db->select();
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
                <Form method="POST">
                    <img src="images/Logo.jpg">
                    <label>Name</label>
                    <input name="name" type="text" placeholder = "Enter The Name" required>
                    <label>ID</label>
                    <input name="id" type="text" maxlength = 9 placeholder = "Enter the ID Here" required>
                    <label>Email</label>
                    <input name="email" type = "email" placeholder = "Enter the E-Mail" required>
                    <input type = "submit" value = "Submit">
                </Form>
                
            </div>
            <div class = "Table-Parent">
                <table>
                    <thead>
                        <td>Name</td>
                        <td>ID</td>
                        <td>Email</td>
                    </thead>
                    <?php 
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class = "row">
                            <td class="data"><?= $row['Name']?></td>
                            <td class="data"><?= $row['ID']?></td>
                            <td class="data"><?= $row['Email']?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>