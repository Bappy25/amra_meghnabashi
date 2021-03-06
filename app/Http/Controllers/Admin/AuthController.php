<?php

namespace App\Http\Controllers\Admin; 

use Base\Request;
use App\Models\Auth; 
use App\Models\User; 
use App\Http\Controllers\Controller; 

class AuthController extends Controller
{
    private $user; 
    private $auth;
    private $request; 

    public function __construct() {
        $this->auth = new Auth;
        $this->user = new User;
        $this->request = new Request();
    }

    public function signin() 
    {
        $this->guard('CheckGuest');
        $number1 = rand(10,100); $number2 = rand(10,100); $total = $number1 + $number2;
        $captcha = ['number1' => $number1, 'number2' => $number2, 'total' => $total]; 
        $this->request->put('captcha', $captcha);   
        return $this->view('admin.auth.login');
    }

    public function checkCaptcha() 
    {
        if($_POST['check'] == $this->request->show('captcha')['total']){
          $this->auth->signout();
        }
        $this->redirect('admin/signin');
    }

    public function login() 
    {
        $this->auth->setUsername(isset($_POST['username']) ? $_POST['username'] : '');
        $this->auth->setPassword(isset($_POST['password']) ? $_POST['password'] : '');
        $signin = $this->auth->signin();
        if($signin){
            $this->redirect('admin/members/all');
        }
        else{
          $this->redirect('admin/signin');
        }
    }

    public function forgotPassword() 
    {
        $this->guard('CheckGuest'); 
        return $this->view('admin.auth.forgot_pass');
    }

    public function sendResetInfo() 
    {
        $this->guard('CheckGuest'); 
        $this->auth->setUsername($_POST['credential']);
        $this->auth->setEmail($_POST['credential']);
        $user = $this->auth->getUser();
        if($user){
            $token = md5(uniqid());
            $this->auth->setId($user['id']);
            $this->auth->setToken($token);
            $this->auth->storeLink();
            $subject = 'Link For Password Reset!';
            $body = 'Please click the below link to reset your password-';
            $body .= '<br><a href="'.route("admin/password/reset", ["token" => $token]).'" target="_blank">Link to reset password!</a>';
            $this->sendMail([$user['email']], $subject, $body);
        }
        $this->request->setFlash(['success' => "Pleace check your mail! You will get an email if your given credential is found in our database!"]);
        $this->redirect('admin/password/forgot');
    }

    public function resetPassword() 
    {
        $this->guard('CheckGuest'); 
        $this->auth->setToken($_GET['token']);
        $link = $this->auth->getLink(); 
        if($link['validity'] == 1 && ((strtotime($link['created_at'])+ 60*60) > time())){
            return $this->view('admin.auth.reset_pass', compact('link'));
        }
        else{
            $this->request->setFlash(['danger' => "This link is expired!"]);
            $this->redirect('admin/password/forgot');
        }
    }

    public function updatePassword() 
    {
        $this->guard('CheckGuest'); 
        $update = $this->auth->setData($_POST)->validateData()->updatePass(); 
        if($update){
            $this->auth->setToken($_POST['token']);
            $this->auth->updateValidity();
            $this->request->setFlash(['success' => "Your password has been updated!"]);
            $this->redirect('admin/signin');
        }
        $this->redirect(back());
    }

    public function signout() 
    {
        $this->auth->signout();
        $this->redirect('admin/signin');
    }

}