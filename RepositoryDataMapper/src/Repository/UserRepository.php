<?php

namespace App\Repository;

use App\Model\User;
use PDO;

class UserRepository
{
    private $AllUsers = array();
    private UserDataMapper $mapper;

    private $connection;

    public function __construct()
    {
        $this->mapper = new UserDataMapper();
        $this->AllUsers = $this->mapper->getAll();
    }

    public function RepGetAll(){
        return $this->AllUsers;
    }

    public function Radd($user) {
        $this->mapper->add($user);
    }

    public function Rupdate($user) {
        $this->mapper->update($user);
    }

    public function Rdelete($DelId) {
        foreach ($this->AllUsers as $user) {
            if ($user->getId() == $DelId) {
                $this->mapper->delete($DelId);
                return;
            }
        }
    }

    public function findById($findID) {
        foreach ($this->AllUsers as $user) {
            if ($user->getId() == $findID) {
                $nickname = $user->getNickname();
                $name = $user->getName();
                $surname = $user->getSurname();

                echo "</p> Пользователь найден. Имя ему - {$name}  {$surname}. </p>
                     Также известный, как {$nickname} </p>";;
                return;
            }
        }
        echo "Пользователь не найден</p>";
    }

    public function RfindByValue($columnName, $value)
    {
        return $this->mapper->findByValue($columnName, $value);
    }
}