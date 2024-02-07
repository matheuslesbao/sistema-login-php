<?php

namespace app\helpers;
use app\models\Users;
use stdClass;
class Auth
{
  public static function loginAs(Users $user){
    if (!isset($_SESSION['auth'])) {
        $stdClas = new stdClass;
        $stdClas->id = $user->id;
        $stdClas->name = $user->name;
        $stdClas->username = $user->username;
        $stdClas->email = $user->email;
        $_SESSION['auth'] = $stdClas;
      }
    }

    public static function auth(){
        return $_SESSION['auth'] ?? null;
    }

    public static function logout(){
        if (isset($_SESSION['auth'])) {
        unset($_SESSION['auth']);
        }
    }
}