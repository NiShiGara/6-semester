<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use App\Controller;
use App\User;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$connection = new Controller($twig);
$user = new User();

$connection->__invoke($user->getAll());

$user_id = $_POST['id'];
$user_nickname = $_POST['nickname'];
$user_name = $_POST['name'];
$user_surname = $_POST['surname'];
$user_age = $_POST['age'];
$action = $_POST['action'];

if ($user_id != null && $user_nickname != null && $user_name != null && $user_surname != null && $user_age != null)
{
    $u = new User();
    $u->setAll($user_id,$user_nickname,$user_name,$user_surname,$user_age);
    switch ($action)
    {
        case "add":
            $u->add();
            break;
        case "upd":
            $u->update();
            break;

    }
    header('Refresh: 0;');
}

$action2 = $_POST['action2'];
$user_id2 = $_POST['id2'];
if ($user_id2 != null)
{
    $u2 = new User();
    switch ($action2)
    {
        case "find":
           $u2->findById($user_id2);

            break;
        case "del":
            $u2->delete($user_id2);
            header('Refresh: 0;');
            break;
    }
}

$connection->__FindFormInvoke();
$action3 = $_POST['action3'];
$value = $_POST['value'];
if ($value != null)
{
    $u2 = new User();
    $connection->__FindInvoke($u2->findByValue("$action3", $value),$value);;
}

