<?php

namespace app\database;

use PDO;
use PDOException;

require_once __DIR__.'/../db-config.php';
class Database
{
    private string $table;
    public PDO $conn;

    public function __construct($table)
    {
        $this->table=$table;
        try {
            $this->conn = new PDO('mysql:host='.HOST.';dbname='.DB_NAME, USERNAME, PASSWORD);
        }catch (PDOException $e){
            echo 'Не удалось подключиться'.$e->getMessage();
        }
    }

    public function getAll(): bool|array
    {
        $sql = "SELECT * FROM `$this->table` ORDER BY `id`";
        $querry = $this->conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0){
            return $result;
        }
        else{
            return false;
        }
    }
    public function get($id): bool|array
    {
        $sql = "SELECT * FROM `$this->table` WHERE `id`='$id'";
        $querry = $this->conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0){
            return $result;
        }
        else{
            return false;
        }
    }

    public function  insert($arr = []){
        $sql = "INSERT INTO `$this->table` (name, age, login, password) VALUES (?,?,?,?)";
        $querry = $this->conn->prepare($sql);
        $querry->bindParam(1,$arr['name']);
        $querry->bindParam(2,$arr['age']);
        $querry->bindParam(3,$arr['login']);
        $querry->bindParam(4,$arr['password']);
        //todo
    }
    public function update(){
        //todo
    }
    public function delete($id){
        $sql = "SELECT * FROM `$this->table` WHERE `id`='$id'";
        $querry = $this->conn->prepare($sql);
        $querry->execute();
        $querry->rowCount();

        if ($querry->rowCount()>0){
          $sql = "DELETE FROM `$this->table` WHERE `id`='$id'";
          $querry = $this->conn->prepare($sql);
          $querry->execute();
            return true;
        }
        else{
            return false;
        }
    }
}