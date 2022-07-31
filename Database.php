<?php
class Database{
    private $conn;
    function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","student");
    }

    function insert(array $data){
        $query = "INSERT INTO `student`(`Name`, `ID`, `Email`) VALUES ('".$data['name']."', ".$data['id'].", '".$data['email']."');";
        $result = mysqli_query($this->conn , $query);
        return $result;
    }

    function select(){
        $query="SELECT * FROM `student`";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function user($id){
        $query="SELECT `Name`, `ID`, `Email` FROM `student` WHERE `ID`=$id";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function delete($id){
        $query="DELETE FROM `student` WHERE `ID`=$id";
        $result = mysqli_query($this->conn,$query);
        if($result == false) return 0;
        else return 1;
    }

    function update($data)
    {
        $query = "Update `student` SET `Name`='".$data['name']."', `Email`='".$data['email']."' WHERE `ID`=".$data['id'];
        $result = mysqli_query($this->conn , $query);
    }

    function search($id){
        $query="SELECT * FROM `student` WHERE `Name` LIKE '%".$id."%' OR `Email` LIKE '%".$id."%'";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function chick($name, $Password){
        echo $name ."<br>";
        echo $Password . "<br>";
        $query = "SELECT * FROM `admin` WHERE `Name` = '".$name."' AND `Password` = sha1(" .$Password.")";
        $result = mysqli_query($this->conn, $query);
        if(!empty($result)) return true;
        else return false;
    }
}
