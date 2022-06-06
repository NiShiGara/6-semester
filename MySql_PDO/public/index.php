<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Controller\MesController;

date_default_timezone_set('Asia/Vladivostok');

require_once dirname(__DIR__) . '/vendor/autoload.php';

$FileLOGS = "/var/www/html/MySql/var/logs/MessagesLogs.log";
$SqlBase = new PDO('mysql:dbname=MyBase;host=127.0.0.1','nishi','12345678');

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$mesHandler = new StreamHandler($FileLOGS, Logger::INFO);
$twig = new Environment($loader);
$log = new Logger('chat');
$chat = new MesController($twig);

$log->pushHandler($mesHandler);

$username = $_GET['username'];
$password = $_GET['password'];
$message = $_GET["OneMessage"];
if (isset($username) && isset($password) && ($message == ''))
{
    $sql = 'SELECT * from Users where User_Login=:username';
    $stmt = $SqlBase->prepare($sql);
    $stmt->bindParam('username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $UsersBase = $stmt->fetchAll();
    if ($UsersBase[0]['User_Login'] == $username && $UsersBase[0]['User_Password'] == $password)
    {
        $chat->__invokeMes();
        echo "<script> document.getElementById(\"AutForm\").hidden=true; </script>";
        setcookie('user', $_GET['username']);
    }
    else
    {
        echo "<script>alert(\"Invalid username or password\")</script>";
        $log->error('The user tried to log in. Invalid username or password');
    }
}

if (isset($message) && ($message !== ''))
{
    $chat->AddMesToJsonAndLogs($SqlBase, $_COOKIE['user'], $message);
    echo "<script> document.getElementById(\"AutForm\").hidden=true; </script>";
    $chat->__invokeMes();
}

$chat->ReadJson($SqlBase);
