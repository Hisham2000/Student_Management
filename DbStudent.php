<?php
class DbStudent{
    private $conn;
    function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","student");
    }

    function insert(array $data){
        $query = "INSERT INTO `student`(`Name`, `ID`, `Email`,`image`,`Ad_Id`) VALUES ('".$data['name']."', ".$data['id'].", '".$data['email']."',"." '". $data['image']."', ". $data['Ad_id'] .");";
        $result = mysqli_query($this->conn , $query);
        return $result;
    }

    function select($id){
        $query="SELECT * FROM `student` Where Ad_Id = $id";
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

    function update($data,$id)
    {
        $query = "Update `student` SET `Name`='".$data['name']."', `Email`='".$data['email']."' WHERE `ID`=".$id;
        $result = mysqli_query($this->conn , $query);
    }

    function search($data, $AD_Id){
        if(filter_var($data,FILTER_VALIDATE_INT))
        {
            $query = "SELECT * FROM `student` WHERE `ID`= $data AND `Ad_Id` = $AD_Id ";
        }
        else{
             $query="SELECT * FROM `student` WHERE  (`Name` LIKE '%".$data."%' OR `Email` LIKE '%".$data."%') And `Ad_ID` = $AD_Id";
        }
        $result = mysqli_query($this->conn,$query);
        return $result;
    } 

}
