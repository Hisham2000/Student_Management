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
}
