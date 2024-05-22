<?php

namespace app\core;

class Response
{
    public static function send($code=404,$typeOfMessage=false,$data=false){
        http_response_code($code);
        if ($typeOfMessage && $data){
            if ($typeOfMessage=='html'){
                echo $data;
            }
            elseif ($typeOfMessage=='json'){
                echo json_encode($data);
            }
        }
        exit();
    }
}