<?php

namespace App\Repository;

use App\Model\User;
use PDO;

class UserDataMapper
{

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=MyBase;host=127.0.0.1', 'nishi', '12345678');
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ARUsers';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
       $results = $this->connection->query($sql);
        $arr = array();
        foreach ($results as $result){
            //$user = new User($result['db_id'], $result['db_nickname'], $result['db_name'], $result['db_surname'], $result['db_age']);
            $user = new User();
            $user->setall($result['db_id'], $result['db_nickname'], $result['db_name'], $result['db_surname'], $result['db_age']);
            array_push($arr, $user);
        }
        return $arr;
    }

    public function add(User $user)
    {
        $sql = "INSERT INTO ARUsers
values( $this->id,'$this->nickname', '$this->name', '$this->surname', $this->age)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function update(User $user)
    {
        $sql = "UPDATE ARUsers SET db_nickname='$this->nickname', db_name='$this->name',
db_surname='$this->surname', db_age=$this->age WHERE db_id=$this->id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function delete($delID)
    {
        $sql = "DELETE FROM ARUsers WHERE db_id=$delID";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function findByValue($columnName, $value)
    {
        if (is_string($value)) {
            $sql = "SELECT * FROM ARUsers WHERE $columnName = '$value'";
        } else {
            $sql = "SELECT * FROM ARUsers WHERE $columnName = $value";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $this->connection->query($sql);
        return $result;

    }
}