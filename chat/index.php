
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

date_default_timezone_set('Asia/Vladivostok');

function AddMesToJson($username, $message, $date){
    $mes= json_decode(file_get_contents("MessagesHistory.json"));
    $mes_obj = (object) ['date' => $date, 'username' => $username, 'message' => $message];
    $mes->AllMessages[] = $mes_obj;
    file_put_contents("MessagesHistory.json", json_encode($mes));
}

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

        AddMesToJson($_COOKIE['user'], $message, $date);
        echo "<script> 
       document.getElementById(\"MesForm\").hidden=false; 
       document.getElementById(\"AutForm\").hidden=true; 
       </script>";
}

    $mes = json_decode(file_get_contents("MessagesHistory.json"));
    foreach($mes->AllMessages as $message){
        echo "$message->date       $message->username </p>";
        echo "$message->message </p>";
    }
?>

