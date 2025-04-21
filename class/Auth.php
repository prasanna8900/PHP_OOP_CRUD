<?php
class Auth{
    private $conn;
    private $table='login';


    public $id;
    public $name;
    public $password;

    public function __construct($conn){
        $this->conn=$conn;

    }


    public function register(){

        $check_query=' SELECT * FROM ' . $this->table . ' WHERE name = :name ';
        $stmt=$this->conn->prepare($check_query);
        $stmt->execute([
          ':name' => $this->name
        ]);
        if($stmt->rowCount()>0){
               return false;
        }
        $hashed_pass= password_hash($this->password , PASSWORD_BCRYPT);
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, password = :password';
          $stmt=$this->conn->prepare($query);
          $stmt->execute([
            ':name' => $this->name,
            ':password' => $hashed_pass
          ]);
          return true;
    }
    public function login(){
        $query= 'SELECT * FROM ' . $this->table . ' WHERE name=:name';
        $stmt=$this->conn->prepare($query);
        $result=$stmt->execute([
          ':name' => $this->name,

        ]);
        if($stmt->rowCount()==1 ){
          $user=$stmt->fetch(PDO::FETCH_ASSOC);

          if(password_verify($this->password,$user['password'])){
              $this->id=$user['id'];
            return true;
          }


          return false;
        }

    }

    public function getuserdata(){
      $query=' SELECT * FROM ' . $this->table ;
      $stmt=$this->conn->prepare($query);
      $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

 public function update() {
    $query = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);

$result=$stmt->execute();
return $result && $stmt->rowCount()>0;
}




    public static function isLoggin(){
      return isset($_SESSION['user']);
    }



    public static function logout(){
      session_destroy();
      header('location:./index.php');
      exit();
    }

}


?>