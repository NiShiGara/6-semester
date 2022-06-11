<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use App\Controllers\Controller;
use App\Model\User;
use App\Repository\UserRepository;
use App\Repository\UserDataMapper;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$connection = new Controller($twig);
//$user = new User();
$reposy = new UserRepository();
$connection->__invoke($reposy->RepGetAll());


$action = $_POST['action'];

if ($_POST['id'] != null && $_POST['nickname'] != null && $_POST['name'] != null && $_POST['surname'] != null && $_POST['age'] != null) {
    $user_id = (int)$_POST['id'];
    $user_nickname = (string)$_POST['nickname'];
    $user_name = (string)$_POST['name'];
    $user_surname = (string)$_POST['surname'];
    $user_age = (int)$_POST['age'];

    $u = new User();
    $u->setall($user_id, $user_nickname, $user_name, $user_surname, $user_age);

    switch ($action) {
        case "add":
            $reposy->Radd($u);
            break;
//        case "upd":
//            $u->update();
//            break;

    }
    header('Refresh: 0;');
}

$action2 = $_POST['action2'];
$user_id2 = (int)$_POST['id2'];
if ($user_id2 != null) {
    switch ($action2) {
        case "find":
            $reposy->findById($user_id2);
            break;
        case "del":
            $reposy->Rdelete($user_id2);
            header('Refresh: 0;');
            break;
    }
}

$connection->__FindFormInvoke();
$action3 = $_POST['action3'];
$value = $_POST['value'];
if ($value != null) {
    $u2 = new User();
    $connection->__FindInvoke($reposy->RfindByValue("$action3", $value), $value);;
}

