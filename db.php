<?php

class Database{
    private $dsn = "mysql:host=localhost;dbname=todo_list";
    private $user ="root";
    private $pass = "";
    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO($this->dsn,$this->user,$this->pass);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    public function insert($category,$title,$status){
        $sql = "INSERT INTO todos (category,title,status) VALUES(:category,:title,:status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['category'=>$category,'title'=>$title,'status'=>$status]);


        return true;
    }
        
    public function read(){
        $data = array();
        $sql = "SELECT * FROM todos";
        $stmt = $this ->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[]=$row;
        }
        return $data;
    }
    public function getUserByID($id){
        $sql = "SELECT * FROM todos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id,$category,$title,$status){
        $sql= "UPDATE todos SET category=:category, title=:title, status=:status
        WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['category'=>$category,'title'=>$title,
        'status'=>$status, 'id'=>$id]);
        return true;
    }
    public function delete($id){
        $sql = "DELETE FROM todos WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' =>$id]);
        return true;
    }

    public function totalRowCount(){
        $sql = "SELECT * FROM todos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $t_rows = $stmt->rowCount();
        return $t_rows;
    }
   }


?>