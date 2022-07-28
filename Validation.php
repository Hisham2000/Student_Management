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
        if(!empty($text)){
            $verfied_text = htmlentities($text);
            return $verfied_text;
        }
        else return false;
    }

    public function validationOnInteger($num){
        if(is_numeric($num)) return $num;
        else return false;
    }

}