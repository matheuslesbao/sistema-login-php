<?php

namespace app\helpers;

class isValid
{
    public static function getEmail($email):string{
        // O email não deve estar vazio e deve ter um formato válido
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function getUsername($name):string{
        // O Username não deve estar vazio e deve ter pelo menos 2 caracteres, incluindo letras e números
        return !empty($name) && preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{2,}$/', $name);
    }
    public static function getName($name):string{
        // O nome não deve estar vazio e deve conter apenas letras e espaços, com no mínimo 2 caracteres
        return !empty($name) && preg_match('/^[a-zA-Z\s]{2,}$/', $name);
    }

    public static function getPassword($password):string{
        // A senha não deve estar vazia e deve ter pelo menos 4 caracteres, incluindo letras e números
        return !empty($password) && preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/', $password);
    }
}