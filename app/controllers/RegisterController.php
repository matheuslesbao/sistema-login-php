<?php

namespace app\controllers;

use app\helpers\isValid;
use app\models\Users as UsersRepository;

use Exception;
class RegisterController extends Controller
{
 public function index() {
    $this->view('register', []);
 } 

 public function create() {

   if (!isValid::getEmail($_POST['email'])){
    throw new Exception("Email vazio ou invalido");
    
   }
   if (!isValid::getPassword($_POST['password'])){
    throw new Exception("password vazio ou invalido");
   }else{
      $passwordCrypt = password_hash($_POST['password'], PASSWORD_DEFAULT);;
   }
   if (!isValid::getUsername($_POST['username'])){
    throw new Exception("Username vazio ou invalido, deve ter pelo menos 2 caracteres");
   }
   if (!isValid::getName($_POST['name'])){
    throw new Exception("Nome vazio ou invalido, deve ter pelo menos 2 caracteres");
   }

   $email = strip_tags($_POST["email"]);
   $users = UsersRepository::getUsers();
   foreach ($users as $user){
      if ($user->email == $email ){
         throw new Exception("Ja existe esse email por favor escolha outro ao " . "<a href='/register'>Voltar</a>");
      }
   }
  
      $user = new UsersRepository(); 
      $user ->username = $_POST["username"];
      $user ->name = $_POST["name"];
      $user ->password = $passwordCrypt;
      $user ->email = $email;
      $user->registerUser();
      header("Location: / ");
    

}
}