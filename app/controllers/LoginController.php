<?php

namespace app\controllers;


use app\models\Users as UsersRepository;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login', []);
    }
    public function login()
    {
        session_start();

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = strip_tags($_POST['password']);

        $user = UsersRepository::getEmail($email);
        if(!$user){
            throw new Exception($user . 'Não existe este usuario.');
        }
        if (!password_verify($password, $user->password)) {
            throw new Exception("Senha inválida");
        }
        $_SESSION['auth'] = $user; 
        
        header("Location: /dashboard");
        exit();
    }

}