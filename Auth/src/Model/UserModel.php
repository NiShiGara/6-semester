<?php

namespace App\Model;

use PDO;

class UserModel
{
    private $login;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=MyBase;host=127.0.0.1', 'nishi', '12345678');
    }

    public function setAll($login,$password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function reg()
    {
        $sql = "INSERT INTO AuthUsers values( '$this->login', '$this->password')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function findUser()
    {
        if ($this->password == '')
        {
            $sql = "SELECT * FROM AuthUsers WHERE AU_login = '$this->login'";
        }
        else
        {
            $sql = "SELECT * FROM AuthUsers WHERE AU_login = '$this->login' 
                          AND AU_password = '$this->password'";
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result =  $stmt->fetchAll();
        if (count($result)>0)
        {
            return(true);
        }
        else
        {
            return(false);
        }
    }
}