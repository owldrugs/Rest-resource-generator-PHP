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

    public function  insert($data = [],$fields=[]): bool
    {
        $q = str_repeat('?',count($fields));
        $q = str_split($q);

        $sql = "INSERT INTO `$this->table` (".implode(',',$fields).") VALUES (".implode(',',$q).")";
        $querry = $this->conn->prepare($sql);

        if (!empty($data)){
            for ($i = 1; $i < count($fields)+1; $i++) {
                $querry->bindParam($i,$data[$fields[$i-1]]);
            }
            $querry->execute();
            return true;
        }
        else{
            return false;
        }
    }

    public function update($id,$data = [],$fields=[]): bool
    {
        if ($this->checkId($id)){
            $sql = "UPDATE `$this->table` SET ";
            foreach ($fields as $field=>$value){
                if ($field === array_key_last($fields)) {
                    $sql.= "`$value`=? WHERE `id`='$id'";
                }
                else
                {
                    $sql.= "`$value`=?,";
                }
            }
            $querry = $this->conn->prepare($sql);

            if (!empty($data)){
                for ($i = 1; $i < count($fields)+1; $i++) {
                    $querry->bindParam($i,$data[$fields[$i-1]]);
                }
                $querry->execute();
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function delete($id): bool
    {
        if ($this->checkId($id)){
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
        else{
            return false;
        }

    }

    public function checkId($id): bool
    {
        $sql = "SELECT * FROM `$this->table` WHERE `id`='$id'";
        $querry = $this->conn->prepare($sql);
        $querry->execute();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0){
            return true;
        }
        else{
            return false;
        }
    }
}