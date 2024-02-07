<?php

namespace app\models;
use app\database\Database;
use PDO;

class Users
{
    public $id;
    public $name;
    public $username;
    public $password;
    public $email;
    public $date;

    public function registerUser(){
        //DEFINIR A DATA
        $this->date = date('Y-m-d H:i:s');
    
        //INSERIR Usuario NO BANCO
        $UsersDatabase = new Database('Users');
        $this->id = $UsersDatabase->insert([
        'name'  => $this->name,
        'username'  => $this->username,
        'password' => $this->password,
        'email' => $this->email,
        'date'  => $this->date
        ]);
    
        //RETORNAR SUCESSO
        return true;
      }
      public function updateUsers(){
        return (new Database('Users'))->update('id = '.$this->id,[
          'name'  => $this->name,
          'date'  => $this->date
           ]);
      }
      public function deleteUsers(){
        return (new Database('Users'))->delete('id = '.$this->id);
      }

      public static function getUsers($where = null, $order = null, $limit = null){
        return (new Database('Users'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
      }

      public static function getUser($id){
        return (new Database('Users'))->select('id = '.$id)
                                      ->fetchObject(self::class);
      }
      public static function getEmail(string $email){
        return (new Database('Users'))->whereEmail($email)
                                      ->fetchObject(self::class);
      }
 
}
