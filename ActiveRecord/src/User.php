<?php

namespace App;

use PDO;

class User
{
    private int $id;
    private string $nickname;
    private string $name;
    private string $surname;
    private int $age;

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=MyBase;host=127.0.0.1','nishi','12345678');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAll($id,$nickname,$name,$surname,$age)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNickname($nickname)
    {
        $this->name = $nickname;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSurname($surname)
    {
        $this->age = $surname;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ARUsers';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $this->connection->query($sql);
        return $result;
    }

    public function findById($findID)
    {
        $sql = "SELECT * FROM ARUsers WHERE db_id=$findID";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result)
        {
            echo "</p> Пользователь найден. Имя ему - {$result['db_name']}  {$result['db_surname']}. </p> 
       Также известный, как {$result['db_nickname']} </p>";
        }
        else
        {
            echo "Пользователь не найден";
        }
    }

    public function findByValue($columnName, $value)
    {
        if (is_string($value))
        {
            $sql = "SELECT * FROM ARUsers WHERE $columnName = '$value'";
        }
        else
        {
            $sql = "SELECT * FROM ARUsers WHERE $columnName = $value";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $this->connection->query($sql);
        return $result;

    }

    public function add()
    {
        $sql = "INSERT INTO ARUsers
        values( $this->id,'$this->nickname', '$this->name', '$this->surname', $this->age)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function update()
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

}
