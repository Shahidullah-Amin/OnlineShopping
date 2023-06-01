<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->has('UserLogged')){
            return redirect()->to('user/login')->with('failed', 'You must be  logged in!');
        }
        else{
            $user_id = session()->get('UserLogged');
            $model = new UserModel();
            $user = $model->find((int)$user_id);
            if(strval($user['session_id']) != strval(session_id())){
                session()->destroy();
                return redirect()->to('user/login');
            }
            
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}