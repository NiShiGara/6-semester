<?php

namespace App\Repository;

use App\Model\User;
use PDO;

class UserRepository
{
    private $AllUsers = array();
    private UserDataMapper $mapper;

    public function __construct()
    {
        $this->mapper = new UserDataMapper();
        $this->AllUsers = $this->mapper->getAll();
    }

    public function RGetAll()
    {
        return $this->AllUsers;
    }

    public function Radd($id,$nickname,$name,$surname,$age)
    {
        $this->mapper->add($id,$nickname,$name,$surname,$age);
    }

    public function Rupdate($id,$nickname,$name,$surname,$age)
    {
        $this->mapper->update($id,$nickname,$name,$surname,$age);
    }

    public function Rdelete($DelId)
    {
        foreach ($this->AllUsers as $user)
        {
            if ($user->getId() == $DelId)
            {
                $this->mapper->delete($DelId);
                return;
            }
        }
        echo "Пользователь не найден</p>";
    }

    public function RfindById($findID)
    {
        foreach ($this->AllUsers as $user)
        {
            if ($user->getId() == $findID)
            {
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
