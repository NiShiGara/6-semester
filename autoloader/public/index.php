<form action="/" method="GET">
    <div id = "AutForm">
        <label> Username <input name="username" type="text"> </label>
        <label> Password <input name="password" type="text"> </label>
        <button>Submit</button></br></br>
    </div>
    <div hidden id = "MesForm">
        <label >Message <input name="OneMessage" type="text"> </label>
        <button >Send</button>
    </div>
</form>

<?php
spl_autoload_register(function ($className) {
    $fullPath = dirname(__DIR__ ) . '/' . 'src/' . str_replace("\\", "/", $className) . '.php';
    require_once $fullPath;
});

use write;
use second\read;
$write= new write();
$read= new read();

date_default_timezone_set('Asia/Vladivostok');
$FileJSON = "/var/www/html/autoloader/logs/MessagesHistory.json";
$username = $_GET['username'];
$password = $_GET['password'];
$message = $_GET["OneMessage"];
$date = date("d.m G:i");
if (isset($username )&&isset($password)&&($message == '')) {
    if (($username == 'Polina' && $password == '123')||
        ($username == 'Rei' && $password == '123')||
        ($username == 'admin' && $password == 'password')){
        echo "<script> 
       document.getElementById(\"MesForm\").hidden=false; 
       document.getElementById(\"AutForm\").hidden=true; 
       </script>";
        setcookie('user', $_GET['username']);
    } else {
        echo "<script>alert(\"Invalid username or password\")</script>";
    }
}

if (isset($message)&&($message !== '')) {
    $write->AddMesToJson($FileJSON,$_COOKIE['user'], $message, $date);
    echo "<script> 
       document.getElementById(\"MesForm\").hidden=false; 
       document.getElementById(\"AutForm\").hidden=true; 
       </script>";
}

$read->ReadJSON($FileJSON);
?>
