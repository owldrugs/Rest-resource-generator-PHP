<?php

namespace app\core;

class UserInput
{
    public static function getInput(): bool|array
    {
        $input = file_get_contents('php://input');
        $inputdc = json_decode($input);
        if (!empty($inputdc)){
            $data = [];
            foreach ($inputdc as $key => $value){
                $data[$key] = $value;
            }
            return $data;
        }
        return false;
    }

    public static function getPost(): bool|array
    {
        $post = $_POST;

        if (!empty($post)){
            $data = [];
            foreach ($_POST as $key => $value){
                $data[$key] = $value;
            }
            return $data;
        }

        return false;
    }

    public static function getAnyData(): bool|array
    {
        $input = self::getInput();
        $post = self::getPost();
        return $input?:($post?:false);
    }
}