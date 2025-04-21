<?php
class Database{

    //use accesss modifiers
    private $host, $sname, $pass, $dbname, $conn;

//call the construct to use the $this as a access modifiers

    public function getConnection(){

        list($this->host, $this->sname, $this->pass, $this->dbname)=['localhost','root','','myoop'];
        try{

            $this->conn=new PDO("mysql:host={$this->host}; dbname={$this->dbname}",$this->sname,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e){
            echo('connection failed'. $e->getMessage());
        }
return $this->conn;
    }


}


?>