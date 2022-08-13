<?php
class FilterImages{
    private $imgName;
    private $tmploc;
    
    public function setName($image, $id){
        $this->imgName = $id;
        return $this->validOnExtention($image);
    } 

    private function validOnExtention($image){
        $ext = ["jpg","png","gif","jpeg"];
        $name = explode(".", $image);
        $end = end($name);
        $this->imgName .= ".".$end;
        if(in_array(strtolower(end($name)), $ext)) return true;
        else return false;
    }

    public function setLocation($tmplocation){
        $this->tmploc = $tmplocation;
        return true;
    }

    public function save(){
        move_uploaded_file($this->tmploc, "Upload/Images/".$this->imgName);
    }

    public function getName(){
        return $this->imgName;
    }
}