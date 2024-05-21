<?php

namespace app\resourses;

use app\database\Database;

class Users
{
    private Database $db;
    private $name;
    private $age;
    private $login;
    private $password;
    private $users = [
        ['id'=>1,'name'=>'viktor','age'=>24,'login'=>'ViktorLogin','password'=>'ViktorPass'],
        ['id'=>2,'name'=>'viktor','age'=>24,'login'=>'ViktorLogin','password'=>'ViktorPass'],
        ['id'=>3,'name'=>'viktor','age'=>24,'login'=>'ViktorLogin','password'=>'ViktorPass'],
        ['id'=>4,'name'=>'viktor','age'=>24,'login'=>'ViktorLogin','password'=>'ViktorPass'],
        ['id'=>5,'name'=>'viktor','age'=>24,'login'=>'ViktorLogin','password'=>'ViktorPass'],
    ];
    public function __construct()
    {
        $this->db = new Database('users');
    }

    public function getAll(): void
    {
        $result = $this->db->getAll();
        if ($result){
            http_response_code(200);
            echo json_encode($result);
        }
        else{
            echo 'Нет записей';
            http_response_code(404);
        }

    }
    public function get($id): void
    {
        $result = $this->db->get($id);
        if ($result){
            http_response_code(200);
            echo json_encode($result);
        }
        else{
            echo 'Нет записей';
            http_response_code(404);
        }
    }
    public function post(){
        echo json_encode($this->users);
        $result = $this->db->insert();
    }
    public function put($id){
        echo json_encode($this->users[$id-1]);
        //todo
    }
    public function delete($id){
        $result = $this->db->delete($id);
        if ($result){
            http_response_code(200);
        }
        else{
            echo 'Нет записей';
            http_response_code(404);
        }
    }
}