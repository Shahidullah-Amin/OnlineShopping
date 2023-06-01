<?php

namespace App\Controllers;

use App\Libraries\Authenticator;
use App\Models\UserModel;
use App\Libraries\Hash;
use DateTime;
use DateTimeZone;

class Auth extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        if(!empty($this->session->get('UserLogged'))){
            $user_id = $this->session->get('UserLogged');
            $model = new UserModel();
            $user = $model->find((int)$user_id);
            if(strval($user['session_id']) == strval(session_id())){
                $this->updateLastActivity();
            }
            else{
                $this->session->destroy();
                return redirect()->to(site_url('product/all'));
                exit;
            }
        }
    }


    public function user_authenticate(){

        $authenticator = new Authenticator();
        
        $secretKey = $authenticator->createSecret();


        
        $qr_code = $authenticator->getQRCodeGoogleUrl("otosesli",$secretKey , "otosesli.com");

        session()->set('secret', $secretKey);

        $user_code = $authenticator->getCode($secretKey);



        echo $user_code;



        return view('templates/qr_authenticate',['qr_code'=>$qr_code]);
    }



    public function confirm(){

        $user_code = $this->request->getPost('user-authentication-code');

        $verificatioin = new Authenticator();
        $checkResult = $verificatioin->verifyCode(session()->get('secret') , $user_code , 3);


        if($checkResult){
            echo "<center><h1>".$user_code."</h1></center>";
            exit;
        }
        echo "<h1><center>Authentication Failed</center><h1>";
        exit;
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {

        $rules = [
            'username'=>[
                'label'=>'Username',
                'rules'=>'required',
            ],

            'email'=>[
                'label'=>'Email',
                'rules'=>'required|valid_email|is_unique[users.email]',
                'errors'=>[
                    'valid_email'=>'Email field is invalid, please enter a valid email address',
                    'required'=>'Email field required',
                    'is_unique'=>'Email already taken'
                ]

            ],
            'password'=>[
                'label'=>'Password',
                'rules'=>'required|min_length[8]'
            ],
            'password-confirm'=>[
                'label'=>'Password Confirm',
                'rules'=>'required|matches[password]'
            ]
        ];


        $validation = $this->validate($rules);

        if(!$validation){
            return view('auth/register' , ['validation'=>$this->validator]);
        }
        else{

            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $posted_values =[
                'username'=>$username,
                'email'=>$email,
                'password'=>Hash::make_hash($password)
            ];

            $model = new UserModel();
            $inserted = $model->insert($posted_values);

            if(!$inserted){
                return redirect()->back()->with('fail' , 'Something went wrong!');
            }
            return redirect()->to('user/login')->with('success', 'Your account has been created successfully');
            
        }
    }


    public function check()
    {

        $rules = [
            'email'=>[
                'label'=>"Email",
                'rules'=>'required|valid_email|is_not_unique[users.email]',
                'errors'=>[
                    'is_not_unique'=>'User with this email address doesn\'t exist'
                ]
            ],
            'password'=>[
                'label'=>'Password',
                'rules'=>'required'
            ]
        ];

        $validation = $this->validate($rules);

        if(!$validation){
            return view('auth/login', ['validation'=>$this->validator]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('email',$email)->first();

        if(!Hash::check_password($password, $user['password'])){
            session()->setFlashdata('fail', 'Incorrect password!');
            return redirect()->to('user/login')->withInput();
        }

        $date1 = new DateTime();
        $date1->setTimezone(new DateTimeZone('Europe/Istanbul'));
        $date2 = new DateTime((string)$user['last_activity'] , new DateTimeZone('Europe/Istanbul'));

        $diff = $date1->diff($date2);
        $seconds = $diff->s + ($diff->i * 60) + ($diff->h * 3600) + ($diff->days * 86400);

        
        
        
        if($user['is_logged_in']){
            if($seconds>60){

                session()->set('UserLogged',$user['id']);
                $user['is_logged_in'] = true;
                $session_id = session_id();
                $user['session_id'] = $session_id;
                date_default_timezone_set('Europe/Istanbul');
                $user['last_activity'] = date("Y-m-d H:i:s");
                $model->save($user);
                return redirect()->to(site_url('product/all'));
            }
            else{
                return redirect()->back()->with('failed', 'Başarısız giriş!');

            }


        }
        
        else{
            session()->set('UserLogged',$user['id']);
            $user['is_logged_in'] = true;
            $session_id = session_id();
            $user['session_id'] = $session_id;
            date_default_timezone_set('Europe/Istanbul');
            $user['last_activity'] = date("Y-m-d H:i:s");
            $model->save($user);
            return redirect()->to(site_url('product/all'))->with('failed','Session Is working');
        }

    }
    

    // public function remove_login(int $id){
    //     $user_model = New UserModel();
    //     $user = $user_model->find($id);
    //     $user 
    // }

    public function user_permission(){
        return view('getconfirm_permission');
    }



    public function logout(int $id)
    {
        $user_model = new UserModel();

        $user = $user_model->find($id);

        $user['is_logged_in']=false;
        $user['session_id']=null;
        $user_model->update($id , $user);

        if(session()->has('UserLogged')){
            session()->destroy();
            return redirect()->to('user/login')->with('failed', 'You have been logged out'.$id);
        }
    }


}
