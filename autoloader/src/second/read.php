<?php
namespace second;
class read
{
        static function ReadJSON($fileJSON){
        $mes = json_decode(file_get_contents($fileJSON));
        foreach($mes->AllMessages as $message){
            echo "$message->date       $message->username </p>";
            echo "$message->message </p>";
        }
    }
}