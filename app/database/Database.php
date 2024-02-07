<?php

namespace app\database;

use \PDO;
use \PDOException;

class Database
{
    private static $host = 'mysql';
    private static $dbname = 'login';
    private static $user = 'alphard';
    private static $pass = 'teste';
    private $table;
    private $charset = 'utf8mb4';
    private $connection;

    public function __construct($table = null)
    {
        $this->connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$user, self::$pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Criar tables no banco de dados.
        $showTable = "SHOW TABLES LIKE '$table' ";
        $result = $this->connection->query($showTable);
        if (!$result->rowCount() > 0) {
          $createTableUsers = " CREATE TABLE `Users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
            `username` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
            `password` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
            `email` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
            `date` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`) USING BTREE,
            UNIQUE KEY `email` (`email`)
          )
          COLLATE='utf8_general_ci'
          ENGINE=InnoDB
          AUTO_INCREMENT=1; ";
           $result = $this->connection->query($createTableUsers);
        }


        $this->table = $table;
        $this->setConnection();

    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$user, self::$pass);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $th) {
            die('ERRROR' . $th->getMessage());
        }
    }

    public function execute($query,$params = []){
        try{
          $statement = $this->connection->prepare($query);
          foreach ($params as $key => $value) {
          $statement->bindValue(":$key", $value, PDO::PARAM_STR);
        }
          $statement->execute($params);
          return $statement;
        }catch(PDOException $e){
          die('ERROR: '.$e->getMessage());
        }
      }

      public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds  = array_pad([],count($fields),'?');
    
        //MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
    
        //EXECUTA O INSERT
        $this->execute($query,array_values($values));
    
        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
      }
      public function select($where = null, $order = null, $limit = null, $fields = '*'){
        
        //DADOS DA QUERY
        // $where = $where !== null && strlen($where) > 0 ? 'WHERE ' . $where : '';
        // $order = $order !== null && strlen($order) > 0 ? 'ORDER BY ' . $order : '';
        // $limit = $limit !== null && strlen($limit) > 0 ? 'LIMIT ' . $limit : '';

        $where = !empty($where) ? 'WHERE ' . $where : '';
        $order = !empty($order) ? 'ORDER BY ' . $order : '';
        $limit = !empty($limit) ? 'LIMIT ' . $limit : '';
    
        //MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
        
        //EXECUTA A QUERY
        return $this->execute($query);
      }
      public function whereEmail(string $email){
        
        $query = "SELECT * FROM {$this->table} WHERE email = :email ";
        $params = ['email' => $email];
        
        return $this->execute($query, $params);
      }
      public function update($where,$values){
        //DADOS DA QUERY
        $fields = array_keys($values);
    
        //MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
    
        //EXECUTAR A QUERY
        $this->execute($query,array_values($values));
    
        //RETORNA SUCESSO
        return true;
      }
      public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
    
        //EXECUTA A QUERY
        $this->execute($query);
    
        //RETORNA SUCESSO
        return true;
      }
}
