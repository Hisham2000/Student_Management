<?php
class DbAdmin{
    
    private $conn;

    function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","student");
    }

    function chick($id ,$name, $Password){
        $query = "SELECT * FROM `admin` WHERE `ID`=$id AND `Name` = '".$name."' AND `Password` = '" .$Password."'";
        $result = mysqli_query($this->conn, $query);
        if(!empty($result)) return true;
        else return false;
    }

    function insert(array $data){
        $query = "INSERT INTO `admin`(`Name`, `ID`, `password`) VALUES ('".$data['name']."', ".$data['id'].", '".$data['password']."');";
        $reslut = mysqli_query($this->conn, $query);
        return $reslut;
    }

}