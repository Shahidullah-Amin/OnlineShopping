<?php 

namespace App\Libraries;

class Hash
{
    public static function make_hash($password)
    {
        return password_hash($password , PASSWORD_BCRYPT);
    }

    public static function check_password($password , $db_password){
        if(password_verify($password , $db_password)){
            return true;
        }
        return false;
    }

 
}


?>