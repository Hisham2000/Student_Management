<?php

class Validation{

    public function validationOnEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($email)){
            $verfied_email = filter_var($email,FILTER_SANITIZE_EMAIL);
            return $verfied_email;
        }
        else return false;
    }

    public function validationOnText($text){
        if(!empty($text)) return htmlentities($text);
        else return false;
    }

    public function validationOnInteger($num){
        if(is_numeric($num)) return $num;
        else return false;
    }

    public function validationOnPassword($pass){
        if(strlen($pass)>7) return md5($pass);
        else return false;
    }

}