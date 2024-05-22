<?php

namespace app\resourses;

use app\core\Response;
use app\database\Database;

class Users
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database('users');
    }

    public function getAll($data=[]): void
    {
        $result = $this->db->getAll();
        if ($result){
            Response::send(200,'json',$result);
        }
        else{
            Response::send(404,'html','Нет записей');
        }

    }
    public function get($id,$data=[]): void
    {
        $result = $this->db->get($id);
        if ($result){
            Response::send(200,'json',$result);
        }
        else{
            Response::send(404,'html','Пользователь не найден');
        }
    }
    public function post($data=[]): void
    {
        if ($data){
            $result = $this->db->insert($data,["name","age","login","password"]);
        }

        if ($result){
            Response::send(200,'html','Пользователь добавлен');
        }
        else
        {
            Response::send(404,'html','Нет данных для добавления или пользователь не существует');
        }
    }
    public function put($id,$data=[]): void
    {
        if ($data){
            $result = $this->db->update($id,$data,["name","age","login","password"]);
        }


        if ($result){
            Response::send(200,'html','Пользователь обновлен');
        }
        else
        {
            Response::send(404,'html','Нет данных для добавления или пользователь не существует');
        }
    }
    public function delete($id,$data=[]): void
    {
        $result = $this->db->delete($id);
        if ($result){
            Response::send(200,'html','Пользователь удален');
        }
        else{
            Response::send(404,'html','Пользователь не существует');
        }
    }
}