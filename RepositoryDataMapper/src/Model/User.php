<?php

namespace App\Model;

use PDO;

class User
{
    private int $id;
    private string $nickname;
    private string $name;
    private string $surname;
    private int $age;

    public function __construct()
    {
    }

    public function setall($id,$nickname,$name,$surname,$age)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
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
}
