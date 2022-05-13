<?php

class write
{
    static function AddMesToJson( $FileJSON,$username, $message, $date){
        $mes= json_decode(file_get_contents($FileJSON));
        $mes_obj = (object) ['date' => $date, 'username' => $username, 'message' => $message];
        $mes->AllMessages[] = $mes_obj;
        file_put_contents($FileJSON, json_encode($mes));
    }
}