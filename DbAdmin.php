<?php
class DbAdmin{
    
    private $conn;

    function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","student");
    }

    function chick($email, $Password){
        $query = "SELECT * FROM `admin` WHERE `Email`='".$email."' AND `Password` = '" .$Password."'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)) return true;
        else return false;
    }

    function insert(array $data){
        $query = "INSERT INTO `admin`(`Name`, `Email`, `password`, `vkey`) VALUES ('".$data['name']."', '".$data['email']."', '".$data['password']."', '".$data['vkey']."');";
        $reslut = mysqli_query($this->conn, $query);
        return $reslut;
    }

    function getUSer($email){
        $query="SELECT `ID`, `Name` FROM `admin` WHERE `Email`='".$email."'";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

}