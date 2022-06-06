<?php
namespace App\Controller;

use Twig\Environment;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class MesController
{
    private $twig;
    private $log;
    private $mesHandler;

    public function __construct(Environment $twig)
    {
        $FileLOGS = "/var/www/html/MySql/var/logs/MessagesLogs.log";

        $this->twig = $twig;
        $this->log = new Logger('chat');
        $this->mesHandler = new StreamHandler($FileLOGS, Logger::INFO);
        echo $this->twig->render('main.html.twig');
    }

    public function __invokeMes()
    {
        echo $this->twig->render('messages.html.twig');
    }

    function AddMesToJsonAndLogs($SqlBase,$Username, $Message)
    {
        $Date = date("d.m G:i");

        $sql = 'insert into MesHistory (Mes_Date, Mes_Login, message) values (:Date , :Username, :Message)';
        $stmt = $SqlBase->prepare($sql);
        $stmt->bindParam('Date', $Date, PDO::PARAM_STR);
        $stmt->bindParam('Username', $Username, PDO::PARAM_STR);
        $stmt->bindParam('Message', $Message, PDO::PARAM_STR);
        $stmt->execute();

        $this->log->pushHandler($this->mesHandler);
        $this->log->info('New message', ['username' => $Username, 'message' => $Message]);
    }

    function ReadJson($SqlBase)
    {
        $sql = 'SELECT * from MesHistory ORDER BY Mes_Date ASC';
        $stmt = $SqlBase->prepare($sql);
        $stmt->execute();

        $result = $SqlBase->query($sql);
        foreach($result as $row){
            $d = $row["Mes_Date"];
            $u = $row["Mes_Login"];
            $m = $row["message"];
            echo "$d       $u </p>";
            echo "$m </p>";
        }
    }
}