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
}
