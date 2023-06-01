<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = ['username' , 'email' , 'password', 'is_logged_in', 'session_id', 'last_activity'];


}





?>